<?php
namespace Appmax\Http\Controllers\Admin;

use Appmax\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Appmax\Services\ServiceProduct;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ServiceProduct $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->index();
        return view('admin.produtos.index', ['products' => $products]);
    }

    public function create()
    {
        return view('admin.produtos.create');
    }

    public function store(Request $request)
    {
        $result = $this->service->store($request->all());
        if (count($result['errors'])) {
            return Redirect::back()->withInput()->withErrors($result['errors']);
        }
        return Redirect()->route('produtos.index')->with('status', $result);
    }

    public function edit($id)
    {
        $product = $this->service->find($id);
        return view('admin.produtos.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $result = $this->service->update($request->all(), $id);
        if (count($result['errors'])) {
            return Redirect::back()->withInput()->withErrors($result['errors']);
        }
        return Redirect()->route('produtos.index')->with('status', $result);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return Redirect()->route('produtos.index')->with('status', $result);
    }

    public function decrement($id)
    {
        $result = $this->service->decrement($id);
        return Redirect()->route('produtos.index')->with('status', $result);
    }
}