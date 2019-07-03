@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Dividendos
            </div>

            <div class="card-actions">
                <a href="{{ route('dividends.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ativo</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dividends as $dividend)
                            <tr>
                                <td>{{ $dividend->id }}</td>
                                <td class="text-nowrap">{{ $dividend->stock_ticker }}</td>
                                <td>{{ $dividend->present()->date }}</td>
                                <td>{{ $dividend->present()->value }}</td>
                                <td>
                                    <ul class="list-inline no-margin">
                                        <li class="list-inline-item">
                                            <a href="{{ route('dividends.edit', [$dividend->id]) }}"><i class="far fa-edit fa-1x"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ route('dividends.delete', [$dividend->id]) }}" class="text-danger"><i class="far fa-times-circle fa-1x"></i></a>
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
