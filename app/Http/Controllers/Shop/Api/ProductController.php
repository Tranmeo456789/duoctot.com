<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\AffiliateProductModel;
use App\Model\Shop\CatProductModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\CommentModel;
use App\Model\Shop\CountryModel;
use App\Model\Shop\ProducerModel;
use App\Model\Shop\ProductModel as MainModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\TrademarkModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class ProductController extends ApiController
{
    protected $limit;

    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    public function getListProduct(Request $request){
        $params=[];
        $params['page']=$request->page ?? 1;
        $params['perPage']=$request->perPage ?? 20;
        $params['keyword']=$request->keywordSearch ?? '';
        $this->res['data'] = null;
        if($params['keyword'] != ''){
            $params['page']=1;
            $params['perPage']=100;
            $this->res['data']  = $this->model->listItems($params,['task'=>'list-items-search-api']);
        }else{
            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-api']);
        }
        return $this->setResponse($this->res);
    }
    public function getListProductInObject(Request $request){
        $params=[];
        $params['page']=$request->page ?? 1;
        $params['perPage']=$request->perPage ?? 20;
        $params['type']=$request->typeProduct ?? 'tre_em';
        $this->res['data'] = null;
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-api']);
        return $this->setResponse($this->res);
    }
    public function getListProductFeaturer(Request $request){
        $params=[];
        $params['type']='noi_bat';
        $this->res['data'] = null;
        //$params['take']=14;
        if($request->header('Tdoctor-Token')){
            $token = $request->header('Tdoctor-Token');
            $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
            if ($data_token['message'] == 'OK') {
                $userLogin = (array)$data_token['payload'];
                $userLogin=UsersModel::where('user_id', $userLogin['user_id'])->first();
                $arrProductIdOfUserLogin = ProductModel::where('user_id', $userLogin['user_id'])->orderBy('id', 'desc')->take(10)->pluck('id')->toArray() ?? [];
                $userShareCodeRef=[];
                $arrProductIdShowLimited =$arrProductIdOfUserLogin;
                if(!empty($userLogin['ref_register'])){
                    $userShareCodeRef=UsersModel::where('codeRef', $userLogin['ref_register'])->first();
                    if(!empty($userShareCodeRef)){
                        $arrProductIdOfUserShareCodeRef = ProductModel::where('user_id', $userShareCodeRef['user_id'])->orderBy('id', 'desc')->take(10)->pluck('id')->toArray() ?? [];
                        $arrProductIdAddShop=collect($userShareCodeRef->listIdProduct)->pluck('product_id')->take(10)->toArray() ?? [];
                        $arrProductIdShow=array_merge($arrProductIdOfUserLogin, $arrProductIdOfUserShareCodeRef, $arrProductIdAddShop);
                        $arrProductIdShowLimited = array_slice($arrProductIdShow, 0, 10);
                    }
                }
                $params['group_id'] = $arrProductIdShowLimited;
                $this->res['data'] = $this->model->listItems($params,['task' => 'frontend-list-items-feature-api-login']);
            }
        }else{
            $this->res['data'] = $this->model->listItems($params,['task' => 'frontend-list-items-feature-api']);
        }
        return $this->setResponse($this->res);
    }
    public function index(Request $request)
    {
        $this->res['data'] = null;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));

        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            $params['cat_product_id'] = intval($request->cat_product_id);

            $request->session()->put('user', $params['user']);
            $params['limit']        = $this->limit;

            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items']);
        }
        return $this->setResponse($this->res);
    }

    public function detail(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parent_id;
        $params['id'] = intval($request->id);
        $listRating = (new CommentModel)->listItems(['product_id'=>$params['id'],'rating'=>true,'parent_id'=>0],['task'=>'list-items-parent-id-0-api']);
        if($listRating){
            foreach($listRating as $key=>$rating0){
                $listRatingChild = (new CommentModel)->listItems(['product_id'=>$params['id'],'rating'=>true,'parent_id'=>$rating0->id],['task'=>'list-items-parent-id-0-api']);
                $listRating[$key]['comment_child']=$listRatingChild;
                $albumImageCurrent=!empty($rating0['albumImageHash']) ? explode('|', $rating0['albumImageHash']) : [];
                $listRating[$key]['albumImage'] = $albumImageCurrent;
                $listRating[$key]['linkPrefix'] = 'https://tdoctor.net/laravel-filemanager/fileUpload/comment/';
            }
        }
        $listComment = (new CommentModel)->listItems(['product_id'=>$params['id'],'parent_id'=>0],['task'=>'list-items-parent-id-0-api']);
        if($listComment){
            foreach($listComment as $key=>$comment0){
                $listCommentChild = (new CommentModel)->listItems(['product_id'=>$params['id'],'parent_id'=>$comment0->id],['task'=>'list-items-parent-id-0-api']);
                $listComment[$key]['comment_child']=$listCommentChild;
                $albumImageCurrent=!empty($comment0['albumImageHash']) ? explode('|', $comment0['albumImageHash']) : [];
                $listRating[$key]['albumImage'] = $albumImageCurrent;
                $listRating[$key]['linkPrefix'] = 'https://tdoctor.net/laravel-filemanager/fileUpload/comment/';
            }
        }
        $itemCurrent=$this->model->getItem($params,['task'=>'frontend-get-item-api']);
        $sellerProduct=UsersModel::where('user_id',$itemCurrent['user_id'])->first();
        $itemCurrent['url'] = route('fe.product.detail', ['slug' => $itemCurrent['slug']]) ?? '';
        $itemCurrent['fullname_sell'] = $sellerProduct['fullname']??'';
        $itemCurrent['list_rating'] = $listRating;
        $itemCurrent['list_comment'] = $listComment;
        $itemCurrent['brand_origin'] = CountryModel::find($itemCurrent['brand_origin_id'])['name'] ?? '';
        $itemCurrent['country'] = CountryModel::find($itemCurrent['country_id'])['name'] ?? '';
        $itemCurrent['trademark'] = TrademarkModel::find($itemCurrent['trademark_id'])['name'] ?? '';
        $itemCurrent['producer'] = ProducerModel::find($itemCurrent['producer_id'])['name'] ?? '';
        $this->res['data']  = $itemCurrent;
        return $this->setResponse($this->res);
    }
    public function getListFeaturer(Request $request)
    {
        $this->res['data'] = null;
        $params['parent_id'] = $request->parent_id;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  json_decode(json_encode($data_token['payload']));
            $params['cat_product_id'] = intval($request->cat_product_id);
            $params['type'] = $request->type;
            $params['limit']        = $this->limit;
            $request->session()->put('user', $params['user']);
            $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-featurer']);
        }

        return $this->setResponse($this->res);
    }
    public function getListFeaturerFrontEnd(Request $request){
        $params['type'] = $request->type ?? 'noi_bat';
        $params['limit']        = $request->limit ?? 'noi_bat';
        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-by-type']);
        return $this->setResponse($this->res);
    }
    public function getListProductByProductID(Request $request){
        $params['id'] = json_decode($request->id);

        $this->res['data']  = $this->model->listItems($params,['task'=>'frontend-list-items-by-id']);
        return $this->setResponse($this->res);
    }
    public function getListProductShowFrontEnd(Request $request){
        $params['limit'] = intval($request->limit)??6;
        $params['user_id'] = intval($request->user_id);

        $productAffifiate = AffiliateProductModel::where('user_id',$params['user_id'])
                                                ->whereNotIn('product_id',[1894,1895])
                                                ->pluck('product_id')->toArray();
        $productShop = MainModel::where('user_id',$params['user_id'])
                                        ->whereNotIn('id',[1894,1895])
                                        ->pluck('id')->toArray();
        $arrProductID= array_unique(array_merge($productAffifiate,$productShop));
        if (count($arrProductID) > 0){
            $data  = $this->model->listItems(['id' => $arrProductID,'limit' => $params['limit']],['task'=>'frontend-list-items-by-id']);
        }
        else{
            $data = $this->model->listItems(['type' => 'new','limit' => $params['limit']],['task'=>'frontend-list-items-by-type']);
        }

        $dataPermanent = $this->model->listItems(['groupID'=>[1894,1895]],['task'=>'frontend-list-items-by-groupID']);

        $this->res['data'] = array_merge($dataPermanent->toArray(),$data->toArray()['data']);
        return $this->setResponse($this->res);
    }
    public function addCommentOrRatingProduct(Request $request){
        $token = $request->header('Tdoctor-Token') ?? 'hhhhh';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        $idUserComment = '';
        if ($data_token['message'] == 'OK') {
            $infoUserComment = (array)$data_token['payload'];
            $idUserComment = $infoUserComment['user_id'];
        }
        $params['user_id']=$idUserComment;
        $params['product_id']=$request->productId ?? 1;
        $params['content']=$request->content ?? 'Unknow';
        $params['fullname']=$request->fullname ?? 'Anonymous';
        $params['phone']=$request->phone ?? '';
        $params['parent_id']=$request->parent_id ?? 0;
        $params['rating']=$request->rating ?? '';
        if($params['parent_id'] == 'null' || $params['parent_id']=='NULL'){
            $params['parent_id'] = 0;
        }
        if($params['parent_id'] != 0){
            $params['rating'] = 0;
        }
        // if($params['rating'] == 'null' || $params['rating'] == 'NULL'){
        //     $params['rating']='';
        // }
        $params['albumImage'] = $request->file('albumImage') ?? null;
        (new CommentModel)->saveItem($params,['task' => 'add-item']);
        $this->res['data'] = [];
        $this->res['message'] = 'Gửi bình luận thành công!';
        return $this->setResponse($this->res);
    }
    public function getListProductAll(Request $request){
        $catTdoctor = CatProductModel::where('id', '!=', 1)->pluck('id')->toArray();
        $catWordpress = range(83, 83 + count($catTdoctor) - 1);
        $params['offset']=$request->offset ?? 0;
        $params['take']=$request->take ?? 0;
        $listProduct = $this->model->listItems($params,['task'=>'get-list-items-add-database-wordpress']);
        $catMap = array_combine($catTdoctor, $catWordpress);

        foreach($listProduct as $key => $val) {
            if (isset($catMap[$val['cat_product_id']])) {
                $listProduct[$key]['cat_product_id'] = $catMap[$val['cat_product_id']];
            }
            $listProduct[$key]['url_image'] = 'https://tdoctor.net'.$val['image'];
            $dangBaoChe=$val['dosage_forms'] ?? '';
            $quyCach=$val['specification'] ?? '';
            $xuatXu=$val->trademarkProduct['name'] ?? '';
            $nhaSanXuat=$val->producerProduct['name'] ?? '';
            $nuocSanXuat=$val->countryProduct['name'] ?? '';
            $hanSuDung=$val['expiration_date'] ?? '';
            $moTaNgan=$val['prescribe'] ?? '';
            $thanhPhan=$val['elements'] ?? '';
            $congDung=$val['benefit'] ?? '';
            $cachDung=$val['dosage'] ?? '';
            $luuY=$val['note'] ?? '';
            $baoQuan=$val['preserve'] ?? '';
            $thuongHieu=$val->brandOriginIdProduct['name'] ?? '';
            $listProduct[$key]['post_content'] = 
            '<strong>Dạng bào chế:</strong> ' . $dangBaoChe . '<br>' .
            '<strong>Quy cách:</strong> ' . $quyCach . '<br>' .
            '<strong>Thương hiệu:</strong> ' . $thuongHieu . '<br>' .
            '<strong>Xuất xứ thương hiệu:</strong> ' . $xuatXu . '<br>' .
            '<strong>Nhà sản xuất:</strong> ' . $nhaSanXuat . '<br>' .
            '<strong>Nước sản xuất:</strong> ' . $nuocSanXuat . '<br>' .
            '<strong>Hạn sử dụng:</strong> ' . $hanSuDung.
            '<h2>Mô tả sản phẩm</h2>'
            .$moTaNgan.
            '<h3>Thành phần</h3>'
            .$thanhPhan.
            '<h3>Công dụng</h3>'
            .$congDung.
            '<h3>Cách dùng</h3>'
            .$cachDung.
            '<h3>Lưu ý</h3>'
            .$luuY.
            '<h3>Bảo quản</h3>'
            . $baoQuan.
            ''
            ;
        }
        $this->res['data'] = $listProduct;
        return $this->setResponse($this->res);
    }
    public function getListProductHanibody(Request $request){
        $catTdoctor = CatProductModel::where('id', '!=', 1)->pluck('id')->toArray();
        $catWordpress = range(83, 83 + count($catTdoctor) - 1);
        $params['offset']=$request->offset ?? 0;
        $params['take']=$request->take ?? 0;
        $listProduct = $this->model->listItems($params,['task'=>'get-list-items-add-database-hanibody']);
        $catMap = array_combine($catTdoctor, $catWordpress);

        foreach($listProduct as $key => $val) {
            if (isset($catMap[$val['cat_product_id']])) {
                $listProduct[$key]['cat_product_id'] = $catMap[$val['cat_product_id']];
            }
            $listProduct[$key]['url_image'] = 'https://tdoctor.net'.$val['image'];
            $dangBaoChe=$val['dosage_forms'] ?? '';
            $quyCach=$val['specification'] ?? '';
            $xuatXu=$val->trademarkProduct['name'] ?? '';
            $nhaSanXuat=$val->producerProduct['name'] ?? '';
            $nuocSanXuat=$val->countryProduct['name'] ?? '';
            $hanSuDung=$val['expiration_date'] ?? '';
            $moTaNgan=$val['prescribe'] ?? '';
            $thanhPhan=$val['elements'] ?? '';
            $congDung=$val['benefit'] ?? '';
            $cachDung=$val['dosage'] ?? '';
            $luuY=$val['note'] ?? '';
            $baoQuan=$val['preserve'] ?? '';
            $thuongHieu=$val->brandOriginIdProduct['name'] ?? '';
            $listProduct[$key]['post_content'] = 
            '<strong>Dạng bào chế:</strong> ' . $dangBaoChe . '<br>' .
            '<strong>Quy cách:</strong> ' . $quyCach . '<br>' .
            '<strong>Thương hiệu:</strong> ' . $thuongHieu . '<br>' .
            '<strong>Xuất xứ thương hiệu:</strong> ' . $xuatXu . '<br>' .
            '<strong>Nhà sản xuất:</strong> ' . $nhaSanXuat . '<br>' .
            '<strong>Nước sản xuất:</strong> ' . $nuocSanXuat . '<br>' .
            '<strong>Hạn sử dụng:</strong> ' . $hanSuDung.
            '<h2>Mô tả sản phẩm</h2>'
            .$moTaNgan.
            '<h3>Thành phần</h3>'
            .$thanhPhan.
            '<h3>Công dụng</h3>'
            .$congDung.
            '<h3>Cách dùng</h3>'
            .$cachDung.
            '<h3>Lưu ý</h3>'
            .$luuY.
            '<h3>Bảo quản</h3>'
            . $baoQuan.
            ''
            ;
        }
        $this->res['data'] = $listProduct;
        return $this->setResponse($this->res);
    }
}
