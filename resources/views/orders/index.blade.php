@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Ordens
            </div>

            <div class="card-actions">
                <a href="{{ route('orders.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Ativo</th>
                                <th>Tipo</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Total</th>
                                <th>Despesa</th>
                                <th>Equilíbrio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->present()->date }}</td>
                                <td class="text-nowrap">{{ $order->stock_ticker }}</td>
                                <td>{{ $order->type }}</td>
                                <td>{{ $order->present()->quantity }}</td>
                                <td>{{ $order->present()->unit_price }}</td>
                                <td>{{ $order->present()->cost }}</td>
                                <td>{{ $order->present()->expense }}</td>
                                <td>{{ $order->present()->equilibrium_price }}</td>
                                <td>
                                    <ul class="list-inline no-margin">
                                        <li class="list-inline-item">
                                            <a href="{{ route('orders.edit', [$order->id]) }}"><i class="far fa-edit fa-1x"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ route('orders.delete', [$order->id]) }}" class="text-danger"><i class="far fa-times-circle fa-1x"></i></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                            @if($links)
                            <tr>
                                <td colspan="2">
                                    {!! $links !!}
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
