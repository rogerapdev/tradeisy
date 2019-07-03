@extends('layouts.default')

@section('content')

<div class="row">

    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                Corretoras
            </div>
            <form class="form-horizontal" method="POST" action="{{ $broker->id ? route('brokers.update', [$broker->id]) : route('brokers.store') }}">
            {{ csrf_field() }}

            @if($broker->id)
                <input name="_method" type="hidden" value="PUT">
            @endif

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Nome</label>
                            <input class="form-control" name="name" value="{{ old('name', $broker->name) }}">
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Corretagem</label>
                            <input class="form-control money-mask" name="brokerage" value="{{ old('brokerage', $broker->present()->brokerage) }}">
                            @if ($errors->has('brokerage'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('brokerage') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-md-4 mb-4">
                        <div>Emolumentos</div>
                        <div class="text-muted small">Taxa de negociação e liquidação que incide na compra e venda direta de ações cobrados pela Bovespa</div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Normal</label>
                                    <input class="form-control decimal-four-mask" name="emolument_normal" value="{{ old('emolument_normal', $broker->present()->emolument_normal) }}">
                                    @if ($errors->has('emolument_normal'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('emolument_normal') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">DayTrade</label>
                                    <input class="form-control decimal-four-mask" name="emolument_daytrade" value="{{ old('emolument_daytrade', $broker->present()->emolument_daytrade) }}">
                                    @if ($errors->has('emolument_daytrade'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('emolument_daytrade') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4 mb-4">
                        <div>Stop</div>
                        <div class="text-muted small">Stop indica sua intenção de interromper a perda (loss) ou o ganho (gain) em uma posição aberta.</div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Loss</label>
                                    <input class="form-control decimal-mask" name="percentage_stop_loss" value="{{ old('percentage_stop_loss', $broker->present()->percentage_stop_loss) }}">
                                    @if ($errors->has('percentage_stop_loss'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('percentage_stop_loss') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Gain</label>
                                    <input class="form-control decimal-mask" name="percentage_stop_gain" value="{{ old('percentage_stop_gain', $broker->present()->percentage_stop_gain) }}">
                                    @if ($errors->has('percentage_stop_gain'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('percentage_stop_gain') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer bg-light text-right">
            	<a href="{{ route('brokers.index') }}" class="btn btn-default" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary" role="button"><i class="far fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
        </form>
        </div>
    </div>

</div>

@endsection
