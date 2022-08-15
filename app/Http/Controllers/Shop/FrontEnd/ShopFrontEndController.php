<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopFrontEndController extends Controller
{
    protected $moduleName = 'shop.frontend';
    protected $pathViewController = '';
    protected $params             = [];
    protected $model;
    protected $totalItemsPerPage = 10;
    protected $controllerName     = 'shopFrontEnd';
    protected $pageTitle          = '';
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     view()->share([
        //         'moduleName'                => $this->moduleName,
        //         'controllerName'            => $this->controllerName,
        //         'pageTitle'                 => $this->pageTitle
        //     ]);
        //     return $next($request);
        // });
        view()->share([
            'moduleName'                => $this->moduleName,
            'controllerName'            => $this->controllerName,
            'pageTitle'                 => $this->pageTitle
        ]);
    }
}
