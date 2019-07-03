@extends('layouts.default')

@section('content')

<div class="row">

    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                Ordens
            </div>
            <form class="form-horizontal" method="POST" action="{{ $order->id ? route('orders.update', [$order->id]) : route('orders.store') }}">
            {{ csrf_field() }}

            @if($order->id)
                <input name="_method" type="hidden" value="PUT">
            @endif

            <div class="card-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="radio-inline mr-3">
                                    <input checked="checked" id="type" name="type" type="radio" value="C">&nbsp;&nbsp;Compra
                                </label>
                                <label class="radio-inline">
                                    <input id="type" name="type" type="radio" value="V">&nbsp;&nbsp;Venda
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Corretora</label>
                            {{ Form::select('broker_id', $brokers, old('broker_id', $order->broker_id) , array('class' => 'form-control')) }}
                            @if ($errors->has('broker_id'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('broker_id') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Data</label>
                            <input class="form-control date-mask" name="date" value="{{ old('date', $order->present()->date) }}">
                            @if ($errors->has('date'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('date') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Ativo</label>
                            <input class="form-control" name="stock_ticker" value="{{ old('stock_ticker', $order->stock_ticker) }}">
                            @if ($errors->has('stock_ticker'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('stock_ticker') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Quantidade</label>
                            <input class="form-control integer-mask" name="quantity" value="{{ old('quantity', $order->present()->quantity) }}">
                            @if ($errors->has('quantity'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('quantity') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Preço</label>
                            <input class="form-control money-mask" name="unit_price" value="{{ old('unit_price', $order->present()->unit_price) }}">
                            @if ($errors->has('unit_price'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('unit_price') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer bg-light text-right">
            	<a href="{{ route('orders.index') }}" class="btn btn-default" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
        </form>
        </div>
    </div>

</div>

@endsection
