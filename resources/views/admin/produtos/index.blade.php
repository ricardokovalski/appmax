@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Tabela de Produtos</div>
            <table class="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>SKU</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->Name }}</td>
                        <td>{{ $product->Amount }}</td>
                        <td>{{ $product->Price }}</td>
                        <td>{{ $product->Sku }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection