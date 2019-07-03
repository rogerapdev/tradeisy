@extends('layouts.default')

@section('content')

<div class="row">

    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                Dividendos
            </div>
            <form class="form-horizontal" method="POST" action="{{ $dividend->id ? route('dividends.update', [$dividend->id]) : route('dividends.store') }}">
            {{ csrf_field() }}

            @if($dividend->id)
                <input name="_method" type="hidden" value="PUT">
            @endif

            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Ativo</label>
                            <input class="form-control" name="stock_ticker" value="{{ old('stock_ticker', $dividend->stock_ticker) }}">
                            @if ($errors->has('stock_ticker'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('stock_ticker') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Descrição</label>
                            <input class="form-control" name="description" value="{{ old('description', $dividend->description) }}">
                            @if ($errors->has('description'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('description') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Data</label>
                            <input class="form-control date-mask" name="date" value="{{ old('date', $dividend->present()->date) }}">
                            @if ($errors->has('date'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('date') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Valor</label>
                            <input class="form-control money-mask" name="value" value="{{ old('value', $dividend->present()->value) }}">
                            @if ($errors->has('value'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('value') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Corretora</label>
                            {{ Form::select('broker_id', $brokers, old('broker_id', $dividend->broker_id) , array('class' => 'form-control')) }}
                            @if ($errors->has('broker_id'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('broker_id') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer bg-light text-right">
            	<a href="{{ route('dividends.index') }}" class="btn btn-default" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
        </form>
        </div>
    </div>

</div>

@endsection
