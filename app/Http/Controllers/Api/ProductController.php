<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $data = ['data' => $this->product->all()];

        return response()->json($data);
    }

    public function show($id)
    {
        $product = $this->product->find($id);

        if(!$product) return response()->json(['data' => ['msg' => 'Produto não encontrado!']],404);

        $data = ['data' => $product];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        try{
            $productData = $request->all();

            $this->product->create($productData);

            $data = ['data' => ['msg' => 'Produto criado com sucesso!']];
            return response()->json([$data],201);

        }catch (\Exception $e){

            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(),1010),500);
            }

            return response()->json(ApiError::errorMsg('Houve erro ao realizar operação de salvar',1010),500);
        }

    }

    public function update(Request $request, $id)
    {
        try{
            $productData = $request->all();
            $product = $this->product->find($id);
            $product->update($productData);

            $data = ['data' => ['msg' => 'Produto atualizado com sucesso!']];
            return response()->json([$data],201);

        }catch (\Exception $e){

            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(),1011),500);
            }

            return response()->json(ApiError::errorMsg('Houve erro ao realizar operação de atualizar',1011),500);
        }

    }


    public function delete(Product $id)
    {
        try{

            $id->delete();

            $data = ['data' => ['msg' => 'Produto : '. $id->name .' removido com sucesso!']];
            return response()->json([$data],200);

        }catch (\Exception $e){

            if(config('app.debug')){
                return response()->json(ApiError::errorMsg($e->getMessage(),1012),500);
            }

            return response()->json(ApiError::errorMsg('Houve erro ao realizar operação de remover',1012),500);
        }
    }

}
