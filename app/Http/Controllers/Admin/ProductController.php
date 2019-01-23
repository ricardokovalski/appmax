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
            $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','W');
            $prefix = $faker->randomElements($alpha, 3, true);
            $sku = implode($prefix, "").'-'.$faker->randomNumber(4);

            $request->request->add([
                'CreatedAt' => date('Y-m-d H:i:s'),
                'MethodInsert' => 1,
                'IsActive' => 1,
                'Sku' => $sku
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

            $request->request->add([
                'UpdatedAt' => date('Y-m-d H:i:s')
            ]);

            $product = $this->model->findOrFail($id);
            $product->Name = $request->get('Name');
            $product->Description = $request->get('Description');
            $product->Amount = $request->get('Amount');
            $product->Price = $request->get('Price');
            $product->save();

            $message = 'Produto alterado com sucesso';
            $return = ['message' => $message, 'class' => 'success'];
            return Redirect()->route('produtos.index')->with('status', $return);
        } catch (\Exception $e) {
            $message = 'Erro ao enviar os dados, tente novamente.';
            $return = ['message' => $message, 'class' => 'danger'];
            return Redirect()->route('produtos.index')->with('status', $return);
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->model->findOrFail($id);
            $product->delete();

            $message = "Produto excluido com sucesso.";
            $return = ['message' => $message, 'class' => 'success'];
            return Redirect()->route('produtos.index')->with('status', $return);
        } catch (\Exception $e) {
            $message = 'Erro ao excluir o produto, tente novamente.';
            $return = ['message' => $message, 'class' => 'danger'];
            return Redirect()->route('produtos.index')->with('status', $return);
        }
    }

    public function decrement($id)
    {
        try {
            $product = $this->model->findOrFail($id);
            $product->Amount -= 1;
            $product->UpdatedAt = date('Y-m-d H:i:s');

            if ($product->Amount <= 1) {
                $message = "Não pode dar baixa no produto {$product->Sku}.";
                $return = ['message' => $message, 'class' => 'warning'];
                return Redirect()->route('produtos.index')->with('status', $return);
            }

            $product->save();

            $message = "Produto {$product->Sku} deu baixa com sucesso.";
            $return = ['message' => $message, 'class' => 'success'];
            return Redirect()->route('produtos.index')->with('status', $return);
        } catch (\Exception $e) {
            $message = 'Erro ao fazer o processamento, tente novamente.';
            $return = ['message' => $message, 'class' => 'danger'];
            return Redirect()->route('produtos.index')->with('status', $return);
        }

        return view('admin.produtos.edit', ['product' => $product]);
    }
}