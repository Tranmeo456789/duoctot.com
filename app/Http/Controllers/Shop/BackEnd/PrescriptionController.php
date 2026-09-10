<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Model\Shop\PrescriptionModel as MainModel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Http\Requests\PrescriptionRequest as MainRequest;
use App\Model\Shop\ProductModel;
use Carbon\Carbon;
class PrescriptionController extends BackEndController
{

    public function __construct()
    {
        $this->controllerName     = 'prescription';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'Đơn thuốc';
        $this->model = new MainModel();
        parent::__construct();
    }
    public function save(MainRequest $request)
    {
        if (!Request::ajax()) return view("errors." .  'notfound', []);
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
            if (isset($params['info_product']) && is_array($params['info_product'])) {
                $infoProductRaw = $params['info_product'];
                $infoProductFixed = [];
                if (!empty($infoProductRaw['ma_thuoc'])) {
                    foreach ($infoProductRaw['ma_thuoc'] as $index => $maThuoc) {
                        $tenThuoc = $infoProductRaw['ten_thuoc'][$index] ?? null;
                        // Bỏ qua dòng trống hoàn toàn
                        if (empty($maThuoc) && empty($tenThuoc)) {
                            continue;
                        }
                        $infoProductFixed[] = [
                            'product_id' => !empty($infoProductRaw['product_id'][$index]) ? (int) $infoProductRaw['product_id'][$index] : null,
                            'ma_thuoc'   => $maThuoc,
                            'ten_thuoc'  => $tenThuoc,
                            'hoat_chat'  => $infoProductRaw['hoat_chat'][$index] ?? null,
                            'dvt'        => $infoProductRaw['dvt'][$index] ?? null,
                            'sl'         => $infoProductRaw['sl'][$index] ?? null,
                            'cach_dung'  => $infoProductRaw['cach_dung'][$index] ?? null,
                        ];
                    }
                }
                $params['info_product'] = json_encode($infoProductFixed, JSON_UNESCAPED_UNICODE);
            }
            if (!empty($params['date_birth'])) {
                try {
                    $params['date_birth'] = Carbon::createFromFormat('d/m/Y', $params['date_birth'])->format('Y-m-d');
                    // Nếu cột là DATETIME, đổi thành: ->format('Y-m-d H:i:s')
                } catch (\Exception $e) {
                    $params['date_birth'] = null;
                }
            } else {
                $params['date_birth'] = null;
            }
            if (empty($params['code'])) {
                $params['code'] = 'MDT' . date('YmdHis') . mt_rand(100, 999);
            }
            $this->model->saveItem($params, ['task' => $task]);
            $request->session()->put('app_notify', $notify);
            return response()->json([
                'fail' => false,
                'redirect_url' => route($this->controllerName),
                'message'      => $notify,
            ]);
        }
    }
    public function getListThuocChung(\Illuminate\Http\Request $request)
    {
        $query = ProductModel::select('id', 'code', 'name');
        if ($request->has('ten_thuoc') && $request->input('ten_thuoc') != '') {
            $query->where('name', 'like', '%' . $request->input('ten_thuoc') . '%');
        }
        $items = $query->orderBy('id', 'desc')->paginate(20);
        return view('shop.backend.pages.prescription.child_form.modal_list_thuoc', compact('items'))->render();
    }
}
