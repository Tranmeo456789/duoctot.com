<?php

namespace App\Http\Controllers\Shop\BackEnd;
use Illuminate\Http\Request;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\ProductModel;
use App\Model\Shop\OrderProductModel;
use App\Model\Shop\WardModel;
use App\Model\Shop\UsersModel;
use App\Http\Requests;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Model\Shop\AffiliateModel;
use App\Model\Shop\OrderModel as MainModel;
use App\Helpers\MyFunction;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderController extends BackEndController
{
    public function __construct()
    {
        $this->controllerName     = 'order';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Danh sách đơn hàng';
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
        $session->put('params.filter.status_order', $request->has('filter_status_order') ? $request->get('filter_status_order') : ($session->has('params.filter.status_order') ? $session->get('params.filter.status_order') : 'all'));
        $session->put('params.search.field', $request->has('search_field') ? $request->get('search_field') : ($session->has('params.search.field') ? $session->get('params.search.field') : ''));
        $session->put('params.search.value', $request->has('search_value') ? $request->get('search_value') : ($session->has('params.search.value') ? $session->get('params.search.value') : ''));
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        if ($request->has('day_start') && $request->has('day_end')) {
            $this->params['filter_in_day'] = [
                'day_start' => MyFunction::formatDateLikeMySQL($request->get('day_start')),
                'day_end' => MyFunction::formatDateLikeMySQL($request->get('day_end')),
            ];
        }
        $items  = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        if ($items->currentPage() > $items->lastPage()) {
            $lastPage = $items->lastPage();
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $items  = $this->model->listItems($this->params, ['task'  => 'user-list-items']);
        }
        $itemStatusOrderCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-order']);
        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusOrderCount' => $itemStatusOrderCount
        ]);
    }
    public function index_admin(Request $request){
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.pagination.totalItemsPerPage', $this->totalItemsPerPage);
        $this->params     = $session->get('params');
        $pageTitle='Quản lý đơn hàng';$this->params['user_type_id']=3;
        $items=(new UsersModel)->listItems($this->params, ['task'  => 'admin-list-items-of-shop']);
         return view($this->pathViewController .  'admin.index', [
            'items'            => $items,
            'pageTitle'=>$pageTitle
        ]);
    }
    public function detail(Request $request)
    {
        $params['id']= intval($request->id);
        $item= $this->model->getItem($params,['task' => 'get-item']);
        $pageTitle ='Chi tiết đơn hàng';
        $itemsWarehouse = (new WarehouseModel())->listItems(['user_id'=>$item['user_sell']],['task' => 'admin-list-items-in-selectbox']);
        $params['group_id'] = array_keys($item['info_product']);
        $address='';
        if($item->delivery_method ==1){
            $warehouse_id=$item['pharmacy']['warehouse_id'];
            $address=(new WarehouseModel())->getItem(['id'=>$warehouse_id],['task' => 'get-item-of-id'])->address??'';
        }else{
            $ward_detail=(new WardModel())->getItem(['id'=>$item->receive['ward_id']],['task' => 'get-item-full']);
            $ward=$ward_detail['name']??'';
            $district=$ward_detail['district']['name']??'';
            $province=$ward_detail['district']['province']['name']??'';
            $address=$item->receive['address'].' '.$ward.' '.$district.' '.$province;
        }
        $itemsProduct = (new ProductModel())->listItems($params,['task' => 'user-list-items']);
        $infoBuyer=json_decode($item['buyer'], true);
        return view($this->pathViewController .  'detail',
                 compact('item','itemsWarehouse','itemsProduct','address','infoBuyer','pageTitle'));
    }
    public function save(Request $request)
    {
        // if (!$request->ajax()) return view("errors." .  'notfound', []);
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $request->validator->errors()
            ]);
        }
        if ($request->method() == 'POST') {
            $params['id'] = intval($request->id);
            $params['status_order'] = $request->status_order;
            $params['status_control'] = $request->status_control;
            $params['warehouse_id'] = intval($request->warehouse_id);
            $task   = "update-item";
            $notify = "Cập nhật trạng thái đơn hàng thành công!";
            $this->model->saveItem($params, ['task' => $task]);
            (new OrderProductModel)->saveItem(['order_id' => $params['id'],'status_order' => $params['status_order']], ['task' => 'edit-item']);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message' => $notify,
            ]);
        }
    }
    public function list_invoice()
    {
        $pageTitle='Danh sách hóa đơn';
        $moduleName='shop.backend';
        return view('shop.backend.order.list_invoice',compact('pageTitle','moduleName'));
    }
    public function detail_invoice()
    {
        return view('shop.backend.order.detail_invoice');
    }
    public function changeStatusOrder(Request $request)
    {
        $params["currentValue"]  = $request->value;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status-order']);
        $notify = "Cập nhật Trạng thái đơn hàng thành công!";
        $request->session()->put('app_notify', $notify);
        return redirect()->back();
        // return response()->json([
        //     'fail'         => false,
        //     'redirect_url' => route($this->controllerName),
        //     'message'      => $notify
        // ]);
    }
    public function listOrderAdmin(Request $request){
        $session = $request->session();
        if ($session->has('currentController') &&  ($session->get('currentController') != $this->controllerName)) {
            $session->forget('params');
        } else {
            $session->put('currentController', $this->controllerName);
        }
        $session->put('params.filter.status_order', $request->has('filter_status_order') ? $request->get('filter_status_order') : ($session->has('params.filter.status_order') ? $session->get('params.filter.status_order') : 'dangXuLy'));
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
        $itemStatusOrderCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status-order']);
        return view($this->pathViewController .  'admin.list_order', [
            'params'           => $this->params,
            'items'            => $items,
            'itemStatusOrderCount' => $itemStatusOrderCount
        ]);
    }
    public function exportListOrderFileExcel(Request $request)
    {
        $params=[
            'status_order' => 'all'
        ];
        if ($request->has('day_start') && $request->has('day_end')) {
            $params['filter_in_day'] = [
                'day_start' => MyFunction::formatDateLikeMySQL($request->get('day_start')),
                'day_end' => MyFunction::formatDateLikeMySQL($request->get('day_end')),
            ];
        }
        $items = $this->model->listItems($params, ['task' => 'order-list-items-export-file-excel']);
        $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
        unset($statusOrderValue['all']);
        $statusControlOrderValue = array_combine(array_keys(config("myconfig.template.column.status_control")),array_column(config("myconfig.template.column.status_control"),'name'));
        // Tạo một đối tượng Spreadsheet mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Thiết lập tiêu đề cột
        $sheet->setCellValue('A1', 'Mã đơn hàng');
        $sheet->setCellValue('B1', 'Doanh thu');
        $sheet->setCellValue('C1', 'Số lượng sản phẩm');
        $sheet->setCellValue('D1', 'Khách hàng');
        $sheet->setCellValue('E1', 'Số điện thoại');
        $sheet->setCellValue('F1', 'Thời gian đặt hàng');
        $sheet->setCellValue('G1', 'Trạng thái đơn hàng');
        $sheet->setCellValue('H1', 'Trạng thái đối soát');
        $sheet->setCellValue('I1', 'Sản phẩm trong đơn hàng');
        // In đậm chữ cho các ô trên
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $sheet->getStyle('E1')->getFont()->setBold(true);
        $sheet->getStyle('F1')->getFont()->setBold(true);
        $sheet->getStyle('G1')->getFont()->setBold(true);
        $sheet->getStyle('H1')->getFont()->setBold(true);
        $sheet->getStyle('I1')->getFont()->setBold(true);
        $row = 2; // Bắt đầu từ dòng 2 để điền dữ liệu sau tiêu đề
        foreach ($items as $item) {
            $codeOrder = $item->code_order;
            $total = MyFunction::formatNumber($item->total) . ' đ';
            $totalProduct = $item->total_product;
            $buyer = json_decode($item['buyer'],true) ?? '';
            $fullname = $buyer['fullname'] ?? '';
            $phone = $buyer['phone'] ?? '';
            $ngayDatHang = MyFunction::formatDateFrontend($item['created_at']);
            $listsProduct = $item->listProductInOrder;
            $productDetails = '';
            $listsProduct = json_decode($listsProduct, true);
            foreach ($listsProduct as $productOrder) {
                $product = ProductModel::find($productOrder['product_id']);  
                if ($product) {
                    $unit=$product->unitProduct;
                    $productName = $product->name; 
                    $productPrice = MyFunction::formatNumber($product->price) . ' đ';
                    $productUnit = $unit['name']; 
                    $productQuantity = $productOrder['quantity'];  
                    $productQuantity = $productOrder['quantity'];  
                    $productDetails .= "Tên sản phẩm: $productName, Đơn vị: $productUnit, Giá: $productPrice, Số lượng: $productQuantity\n";
                }
            }
            $sheet->setCellValue('A' . $row, $codeOrder); 
            $sheet->setCellValue('B' . $row, $total); 
            $sheet->setCellValue('C' . $row, $totalProduct); 
            $sheet->setCellValue('D' . $row, $fullname);  
            $sheet->setCellValue('E' . $row, $phone);  
            $sheet->setCellValue('F' . $row, $ngayDatHang);
            $sheet->setCellValue('G' . $row, $statusOrderValue[$item['status_order']]);
            $sheet->setCellValue('H' . $row, $statusControlOrderValue[$item['status_control']]);
            $sheet->setCellValue('I' . $row, $productDetails);
            $row++;  

            $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);
        }
        // Tạo writer để xuất file Excel (định dạng xlsx)
        $writer = new Xlsx($spreadsheet);
        // Đặt tên file
        $fileName = 'orders_export_' . date('Y_m_d_H_i_s') . '.xlsx'; // Tên file với thời gian
        // Trả về file Excel cho người dùng tải xuống
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output'); // Lưu file vào output stream
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
}
