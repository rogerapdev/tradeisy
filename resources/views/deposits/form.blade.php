@extends('layouts.default')

@section('content')

<div class="row">

    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                Depósitos
            </div>
            <form class="form-horizontal" method="POST" action="{{ $deposit->id ? route('deposits.update', [$deposit->id]) : route('deposits.store') }}">
            {{ csrf_field() }}

            @if($deposit->id)
                <input name="_method" type="hidden" value="PUT">
            @endif

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Corretora</label>
                            {{ Form::select('broker_id', $brokers, old('broker_id', $deposit->broker_id) , array('class' => 'form-control')) }}
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
                            <input class="form-control date-mask" name="date" value="{{ old('date', $deposit->present()->date) }}">
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
                            <input class="form-control money-mask" name="value" value="{{ old('value', $deposit->present()->value) }}">
                            @if ($errors->has('value'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('value') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer bg-light text-right">
            	<a href="{{ route('deposits.index') }}" class="btn btn-default" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
        </form>
        </div>
    </div>

</div>

@endsection
