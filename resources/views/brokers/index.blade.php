@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                Corretoras
            </div>

            <div class="card-actions">
                <a href="{{ route('brokers.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>

                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Nome</th>
                                <th rowspan="2">Corretagem</th>
                                <th align="center">Investido</th>
                                <th align="center">Disponível</th>
                                <th rowspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brokers as $broker)
                            <tr>
                                <td>{{ $broker->id }}</td>
                                <td class="text-nowrap">{{ $broker->name }}</td>
                                <td>{{ $broker->present()->brokerage }}</td>
                                <td>{{ $broker->present()->invested }}</td>
                                <td>{{ $broker->present()->available }}</td>
                                <td>
                                    <ul class="list-inline no-margin">
                                        <li class="list-inline-item">
                                            <a href="{{ route('brokers.edit', [$broker->id]) }}"><i class="far fa-edit fa-1x"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ route('brokers.delete', [$broker->id]) }}" class="text-danger"><i class="far fa-times-circle fa-1x"></i></a>
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
