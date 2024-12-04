<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\PostModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\CatalogModel;
use App\Model\Shop\UsersModel;
use App\Http\Requests\PostRequest as MainRequest;
use App\Helpers\MyFunction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class PostController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'post';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách tin tức';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function index(Request $request)
    {

        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        if ($request->has('deleteValueSearch') && $request->get('deleteValueSearch') == 1) {
            $session->forget('params.search.value');
        }
        $session->put('params.filter.status_product', $request->has('filter_status_product') ? $request->get('filter_status_product') : ($session->has('params.filter.status_product') ? $session->get('params.filter.status_product') : 'all'));
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');

        $items            = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items              = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        $pathView = $request->ajax() ? 'ajax' : 'index';
        return view($this->pathViewController .  $pathView, [
            'params'           => $this->params,
            'items'            => $items,
         ]);     
    }
    public function save(MainRequest $request)
    {
        // if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params = $request->all();
            $task   = "add-item";
            $notify = "Thêm mới $this->pageTitle thành công!";
            if ($params['id'] != null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
            }
            if ($request->hasFile('new_image_name')) {
                $file = $request->file('new_image_name');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('fileUpload/post'); 
                $file->move($destinationPath, $fileName);
                $params['image'] = '/laravel-filemanager/fileUpload/post/'.$fileName;
            }
            $params['slug'] = !empty($params['slug']) ? $params['slug'] : Str::slug($params['title']);
            $idCat=$params['cat_post_id'];
            $catPost=(new CatalogModel)->getItem(['id'=>$idCat],['task'=>'get-item']);
            $nameCatPost = $catPost['name']??'';
            $params['key_search'] = implode(' ', [
                $params['title'],
                $nameCatPost
            ]);
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
            ]);
        }
    }
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        $itemsCatPost = (new CatalogModel())->listItems( null, ['task' => 'admin-list-items-in-selectbox']);
        return view($this->pathViewController . 'form', compact(
            'item',
            'itemsCatPost'
        ));
    }
    public function getItem(Request $request){
        $params["id"] = intval($request->id);
        $item = $this->model->getItem($params, ['task' => 'get-item-simple']);
        return json_encode($item->toArray());
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('fileUpload/post'); // Hoặc đường dẫn cụ thể đến thư mục bạn muốn lưu

            // Di chuyển file vào thư mục mong muốn
            $file->move($destinationPath, $fileName);
    
            // Tạo URL cho file đã lưu
            $url = asset('/laravel-filemanager/fileUpload/post/' . $fileName); 
            return response()->json(['url' => $url]);
        }
        return response()->json(['error' => 'File không hợp lệ.'], 400);
    }
}
