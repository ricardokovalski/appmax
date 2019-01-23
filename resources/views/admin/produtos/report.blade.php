@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card border-dark mb-12">
        <div class="card-header">Relatório diário de produtos - {{ $date }}</div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                <thead>
                <tr>
                    <th scope="col">Produtos</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Descrição</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td style="vertical-align: middle;">
                            @if ($report->get('products')->count() > 1)
                                <ul>
                                @foreach($report->get('products') as $product)
                                    <li>{{ $product->Name }} - {{ $product->Sku }}</li>
                                @endforeach
                                </ul>
                            @else
                                Sem produtos
                            @endif
                        </td>
                        <td style="vertical-align: middle;" align="center">{{ $report->get('total') }}</td>
                        <td style="vertical-align: middle;">{{ $report->get('description') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection