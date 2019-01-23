@extends('layouts.app')
@section('content')
<div class="container">

    @if (session('status'))
    <div class="alert alert-{{ session('status')['class'] }}">
        {{ session('status')['message'] }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success btn-lg float-right mb-3" href="{{ route('produtos.create') }}" role="button">
                <i class="fas fa-plus"></i> Cadastrar Produto
            </a>
        </div>
    </div>

    <div class="card border-dark mb-12">
        <div class="card-header">Produtos</div>
        <div class="table-responsive">
            <table class="table table-light" style="margin-bottom: 0;">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total</th>
                    <th scope="col">Dar Baixa</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="{{ ($product->Amount < 100) ? 'bg-warning text-white' : '' }}">
                        <td>{{ $product->Name }}</td>
                        <td>{{ $product->Sku }}</td>
                        <td>{{ $product->Amount }}</td>
                        <td>R$ {{ $product->Price }}</td>
                        <td>R$ {{ ($product->Price * $product->Amount) }}</td>
                        <td>
                            <a class="btn btn-dark" href="{{ route('produtos.decrement', $product->ProductID) }}" role="button">
                                <i class="fas fa-angle-down"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('produtos.edit', $product->ProductID) }}" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('produtos.destroy', $product->ProductID) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
