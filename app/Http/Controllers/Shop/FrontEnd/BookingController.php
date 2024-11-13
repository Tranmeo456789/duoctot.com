<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\ClinicModel;
use App\Model\Shop\ProvinceModel;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\DoctorModel;
use App\Model\Shop\DrugstoreModel;
use Illuminate\Support\Facades\Session;
class BookingController extends ShopFrontEndController
{
    public function index(Request $request)
    {
        $session = $request->session();
        $params['limit'] = 20;
        $params['cate'] = $request->has('cate')?$request->get('cate'):($session->has('params.cate')?$session->get('params.cate'):'doctor');
        $session->put('params', $params);
        $items = [];
        switch($params['cate']){
            case 'doctor':
                $items = (new DoctorModel)->listItems($params, ['task' => 'list-items-for-search']);
                break;
            case 'clinic':
                $items = (new ClinicModel)->listItems($params, ['task' => 'list-items-for-search']);
                break;
            case 'drugstore':
                $items = (new DrugstoreModel)->listItems($params, ['task' => 'list-items-for-search']);
                break;
            default:
                $items = (new DoctorModel)->listItems($params, ['task' => 'list-items-for-search']);
                break;
        }
        $itemsProvince = (new ProvinceModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        $itemsDistrict= (new DistrictModel())->listItems(null,['task'=>'admin-list-items-in-selectbox']);
        return view('shop.frontend.pages.booking.index', [
            'params' => $params,
            'items' => $items,
            'itemsProvince' => $itemsProvince,
            'itemsDistrict' => $itemsDistrict,
            'itemDoctorCount' => DoctorModel::count(),
            'itemClinicCount' => ClinicModel::count(),
            'itemDrugstoreCount' => DrugstoreModel::count()
        ]);
    }
}
