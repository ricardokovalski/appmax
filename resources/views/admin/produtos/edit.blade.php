@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('produtos.update', $product->ProductID) }}" role="form">
            {!! csrf_field() !!}
            {{ method_field('PUT') }}
            <div class="controls">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="Name">Nome *</label>
                            <input id="Name" type="text" name="Name" class="form-control {{ ($errors->first('Name')) ? 'is-invalid' : '' }}" placeholder="Informe o nome do produto" value="{{ $product->Name }}">
                            <div class="invalid-feedback">{{ $errors->first('Name') }}</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Description">Descrição *</label>
                            <textarea id="Description" name="Description" class="form-control {{ ($errors->first('Description')) ? 'is-invalid' : '' }}" placeholder="Informe a descrição do produto" rows="4">{{ $product->Description }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('Description') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="Amount">Quantidade *</label>
                            <input id="Amount" type="number" name="Amount" class="form-control {{ ($errors->first('Amount')) ? 'is-invalid' : '' }}" placeholder="Informe quantidade do produto" min="0" max="500" maxlength="3" value="{{ $product->Amount }}">
                            <div class="invalid-feedback">{{ $errors->first('Amount') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="Price">Preço</label>
                            <input id="Price" type="text" name="Price" class="form-control {{ ($errors->first('Price')) ? 'is-invalid' : '' }}" placeholder="Informe o preço por unidade" value="{{ $product->Price }}">
                            <div class="invalid-feedback">{{ $errors->first('Price') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-warning btn-send" value="Enviar">
                </div>
            </div>
        </form>
    </div>
@endsection