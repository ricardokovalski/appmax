<?php
namespace Appmax\Http\Controllers\Api;

use Appmax\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Appmax\Services\ServiceProduct;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ServiceProduct $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->apiAll();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $result = $this->service->apiStore($request->all());
        return response()->json($result['result'], $result['status']);
    }

    public function destroy(Request $request)
    {
        $result = $this->service->apiDestroy($request->all());
        return response()->json($result['result'], $result['status']);
    }


}