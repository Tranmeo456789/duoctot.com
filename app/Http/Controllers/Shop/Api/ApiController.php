<?php

namespace App\Http\Controllers\Shop\Api;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $limit = 50;
    protected $page = 1;
    protected $sortBy = 'DESC';
    protected $orderBy = 'id';

    protected $sortByAble = ['ASC', 'DESC'];
    protected $orderByAble = ['updated_at', 'created_at'];

    protected $res = [
        'status' => 200,
        'data' => [],
        'error' => [],
        'success' => true,
        'message' => ''
    ];

    public function __construct()
    {
        $this->page = !is_null(request()->query("page")) ? request()->query("page") : $this->page;
        $this->limit = (!is_null(request()->query("limit"))) ? request()->query("limit") : $this->limit;
        $this->method = request()->getMethod();
        $sortBy = strtoupper(request()->query('sort_by'));
        $orderBy = strtolower(request()->query('order_by'));
        if ($sortBy && in_array($sortBy, $this->sortByAble)) {
            $this->sortBy = strtoupper(trim(strip_tags($sortBy)));
        }
        if ($orderBy && in_array($orderBy, $this->orderByAble)) {
            $this->orderBy = strtolower(trim(strip_tags($orderBy)));
        }
    }

    public function setResponse($data)
    {
        $this->res = array_merge($this->res, $data);
        if (isset($data['data']) && $data['data']) $this->res['data'] = $data['data'];
        if (isset($data['message']) && !empty($data['message'])) $this->res['message'] = $data['message'];
        if (isset($data['status']) && $data['status']) {
            $this->res['status'] = $data['status'];
            if (!in_array($data['status'], [200, 201])) $this->res['success'] = false;
        }
        if (isset($data['error']) && !empty($data['error'])) {
            $this->res['success'] = false;
            if (!isset($data['status'])) $this->res['status'] = 400;
            $this->res['error'] = $data['error'];
        }
        return response()->json($this->res, $this->res['status']);
    }

    public function setResponseValidate($data_error)
    {
        $this->res['error'] = $data_error;
        $this->res['status'] = 422;
        $this->res['success'] = false;
        $err = $data_error->toArray();
        $this->res['message'] = 'Vui lòng kiểm tra lại dữ liệu';
        foreach ($err as $item) {
            if ($item[0]) {
                $this->res['message'] = $item[0];
            }
        }
        return response()->json($this->res, $this->res['status']);
    }

    public function setResponseSuccess($data = [])
    {
        $data['success'] = true;
        $data['status'] = 200;
        return response()->json($data ?? $this->res, $this->res['status']);
    }


    public function setResponseError($data = [])
    {
        $data['success'] = false;
        $data['status'] = 400;
        return response()->json($data ?? $this->res, $data['status'] ?? 400, []);
    }
}
