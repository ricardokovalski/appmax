<?php
namespace Appmax\Services;

use Appmax\Models\Product;
use Illuminate\Support\Facades\Validator;

class ServiceProduct
{
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->where('IsActive', 1)->get();
    }

    public function store($data)
    {
        try {

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
                return ['message' => '', 'class' => '', 'errors' => $errors];
            }

            $data['CreatedAt'] = date('Y-m-d H:i:s');
            $data['MethodInsert'] = 1;
            $data['IsActive'] = 1;
            $data['Sku'] = $this->generateSkuUnique();


            $this->model = new Product();
            $this->model->Name = $data['Name'];
            $this->model->Description = $data['Description'];
            $this->model->Amount = $data['Amount'];
            $this->model->Price = $data['Price'];
            $this->model->Sku = $data['Sku'];
            $this->model->CreatedAt = $data['CreatedAt'];
            $this->model->MethodInsert = $data['MethodInsert'];
            $this->model->IsActive = $data['IsActive'];
            $this->model->save();

            $message = 'Produto inserido com sucesso';
            return ['message' => $message, 'class' => 'success', 'errors' => array()];
        } catch (\Exception $e) {
            $message = 'Erro ao enviar os dados, tente novamente.';
            return ['message' => $message, 'class' => 'danger', 'errors' => array()];
        }
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($data, $id)
    {
        try {

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
                return ['message' => '', 'class' => '', 'errors' => $errors];
            }

            $data['UpdatedAt'] = date('Y-m-d H:i:s');

            $this->model = $this->find($id);
            $this->model->Name = $data['Name'];
            $this->model->Description = $data['Description'];
            $this->model->Amount = $data['Amount'];
            $this->model->Price = $data['Price'];
            $this->model->save();

            $message = 'Produto alterado com sucesso';
            return ['message' => $message, 'class' => 'success', 'errors' => array()];
        } catch (\Exception $e) {
            $message = 'Erro ao enviar os dados, tente novamente.';
            return ['message' => $message, 'class' => 'success', 'errors' => array()];
        }
    }

    public function destroy($id)
    {
        try {
            $this->model = $this->find($id);
            $this->model->delete();

            $message = "Produto excluido com sucesso.";
            return ['message' => $message, 'class' => 'success'];
        } catch (\Exception $e) {
            $message = 'Erro ao excluir o produto, tente novamente.';
            return ['message' => $message, 'class' => 'danger'];
        }
    }

    public function decrement($id)
    {
        try {
            $this->model = $this->find($id);
            $this->model->Amount -= 1;
            $this->model->UpdatedAt = date('Y-m-d H:i:s');

            if ($this->model->Amount <= 1) {
                $message = "Não pode dar baixa no produto {$this->model->Sku}.";
                return ['message' => $message, 'class' => 'warning'];
            }

            $this->model->save();

            $message = "Produto {$this->model->Sku} deu baixa com sucesso.";
            return ['message' => $message, 'class' => 'success'];
        } catch (\Exception $e) {
            $message = 'Erro ao fazer o processamento, tente novamente.';
            return ['message' => $message, 'class' => 'danger'];
        }
    }

    /**
     * @return string
     */
    protected function generateSkuUnique()
    {
        $faker = \Faker\Factory::create();
        $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'W');
        $prefix = $faker->randomElements($alpha, 3, true);
        $sku = implode($prefix, "") . '-' . $faker->randomNumber(4);
        return $sku;
    }

    public function apiAll()
    {
        return $this->model->withTrashed()->get();
    }

    public function apiStore($arrayData)
    {
        try {

            $result = array();

            foreach ($arrayData as $data) {

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
                    return ['status' => 400, 'result' => $errors];
                }

                $data['CreatedAt'] = date('Y-m-d H:i:s');
                $data['MethodInsert'] = 2;
                $data['IsActive'] = 1;
                $data['Sku'] = $this->generateSkuUnique();

                $this->model = new Product();
                $this->model->Name = $data['Name'];
                $this->model->Description = $data['Description'];
                $this->model->Amount = $data['Amount'];
                $this->model->Price = $data['Price'];
                $this->model->Sku = $data['Sku'];
                $this->model->CreatedAt = $data['CreatedAt'];
                $this->model->MethodInsert = $data['MethodInsert'];
                $this->model->IsActive = $data['IsActive'];
                $this->model->save();

                array_push($result, $this->model);
            }
            return ['status' => 201, 'result' => $result];
        } catch (\Exception $e) {
            return ['status' => 404, 'result' => $result];
        }
    }
}