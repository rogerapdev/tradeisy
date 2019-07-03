@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Depósitos
            </div>

            <div class="card-actions">
                <a href="{{ route('deposits.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Corretora</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $deposit)
                            <tr>
                                <td>{{ $deposit->id }}</td>
                                <td class="text-nowrap">{{ $deposit->broker->name }}</td>
                                <td>{{ $deposit->present()->date }}</td>
                                <td>{{ $deposit->present()->value }}</td>
                                <td>
                                    <ul class="list-inline no-margin">
                                        <li class="list-inline-item">
                                            <a href="{{ route('deposits.edit', [$deposit->id]) }}"><i class="far fa-edit fa-1x"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ route('deposits.delete', [$deposit->id]) }}" class="text-danger"><i class="far fa-times-circle fa-1x"></i></a>
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
