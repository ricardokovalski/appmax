<?php
namespace Appmax\Http\Controllers\Api;

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
        $products = $this->model->all();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        try {

            $result = array();

            foreach ($request->all() as $data) {

                $validation = Validator::make($data, [
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
                    return response()->json($errors, 400);
                }

                $faker = \Faker\Factory::create();
                $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'W');
                $prefix = $faker->randomElements($alpha, 3, true);
                $sku = implode($prefix, "") . '-' . $faker->randomNumber(4);

                $data['CreatedAt'] = date('Y-m-d H:i:s');
                $data['MethodInsert'] = 2;
                $data['IsActive'] = 1;
                $data['Sku'] = $sku;

                $product = new Product();
                $product->Name = $data['Name'];
                $product->Description = $data['Description'];
                $product->Amount = $data['Amount'];
                $product->Price = $data['Price'];
                $product->Sku = $data['Sku'];
                $product->CreatedAt = $data['CreatedAt'];
                $product->IsActive = $data['IsActive'];
                $product->save();

                array_push($result, $product);
            }
            return response()->json($result, 201);

        } catch (\Exception $e) {
            return response()->json($result, 404);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function saveRecords($request)
    {

    }


}