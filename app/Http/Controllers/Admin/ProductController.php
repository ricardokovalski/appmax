<?php
namespace Appmax\Http\Controllers\Admin;

use Appmax\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Appmax\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $model;
    protected $faker;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $products = $this->model->where('IsActive', 1)->get();
        return view('admin.produtos.index', ['products' => $products]);
    }

    public function create()
    {
        return view('admin.produtos.create');
    }

    public function store(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'Name' => 'required',
                'Description' => 'required',
                'Amount' => 'required',
                'Price' => 'required'
            ]);

            $validation->setAttributeNames([
                'Name' => 'Nome do produto',
                'Description' => 'Descrição do produto',
                'Amount' => 'Quantidade',
                'Price' => 'Preço por unidade'
            ]);

            if (!$validation->passes()) {
                $errors = $validation->errors()->toArray();
                return Redirect::back()->withInput()->withErrors($errors);
            }

            $faker = \Faker\Factory::create();

            $request->request->add([
                'CreatedAt' => date('Y-m-d H:i:s'),
                'IsActive' => 1,
                'Sku' => 'MTH-'.$faker->randomNumber(4)
            ]);

            $product = new Product();
            $product->Name = $request->get('Name');
            $product->Description = $request->get('Description');
            $product->Amount = $request->get('Amount');
            $product->Price = $request->get('Price');
            $product->Sku = $request->get('Sku');
            $product->CreatedAt = $request->get('CreatedAt');
            $product->IsActive = $request->get('IsActive');
            $product->save();

            $message = 'Produto inserido com sucesso';
            $return = ['message' => $message, 'class' => 'success'];
            return Redirect()->route('produtos.index')->with('status', $return);
        } catch (\Exception $e) {
            $message = 'Erro ao enviar os dados, tente novamente.';
            $return = ['message' => $message, 'class' => 'danger'];
            return Redirect()->route('produtos.index')->with('status', $return);
        }
    }

    public function edit($id)
    {
        $product = $this->model->findOrFail($id);
        return view('admin.produtos.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        try {

            $validation = Validator::make($request->all(), [
                'Name' => 'required',
                'Description' => 'required|email',
                'Amount' => 'required',
                'Price' => 'required'
            ]);

            $validation->setAttributeNames([
                'Name' => 'Nome do produto',
                'Description' => 'Descrição do produto',
                'Amount' => 'Quantidade',
                'Price' => 'Preço por unidade'
            ]);

            if (!$validation->passes()) {
                $errors = $validation->errors()->toArray();
                return Redirect::back()->withInput()->withErrors($errors);
            }

            $product = new Product();
            $product->Name = $request->get('Name');
            $product->Description = $request->get('Description');
            $product->Amount = $request->get('Amount');
            $product->Price = $request->get('Price');
            $product->save();

            $message = 'Produto alterado com sucesso';
            return Redirect()->route('produtos.index');
        } catch (\Exception $e) {

            $message = 'Erro ao enviar os dados, tente novamente.';
            return Redirect()->route('produtos.index');
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->destroy($id);
            $message = "Produto excluido com sucesso.";
            return Redirect()->route('produtos.index');
        } catch (\Exception $e) {
            $message = 'Erro ao excluir o produto, tente novamente.';
            return Redirect()->route('produtos.index');
        }
    }
}