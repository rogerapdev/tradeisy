@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Carteira
            </div>

            <div class="card-actions">
                <a href="{{ route('stocks.quote') }}" class="btn btn-primary">
                    <i class="fa fa-sync"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ativo</th>
                                <th>Qtde.</th>
                                <th>P.M.</th>
                                <th>Compra</th>
                                <th>Cotação</th>
                                <th>Lucro/Prej.</th>
                                <th>%</th>
                                <th>Atual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $stock->stock_ticker }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->present()->average_price }}</td>
                                <td>{{ $stock->present()->invested }}</td>
                                <td>{{ $stock->present()->quote }}</td>
                                @if(round($stock->yield, 2) < round(0, 2))
                                    <td class="text-danger"><strong>{{ $stock->present()->yield }}</strong></td>
                                @else
                                    <td class="text-success"><strong>{{ $stock->present()->yield }}</strong></td>
                                @endif

                                @if(round($stock->gain, 2) < round(0, 2))
                                    <td class="text-danger"><strong>{{ $stock->present()->gain }}%</strong></td>
                                @else
                                    <td class="text-success"><strong>{{ $stock->present()->gain }}%</strong></td>
                                @endif

                                <td>{{ $stock->present()->current_cost }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
