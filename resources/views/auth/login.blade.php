@extends('layouts.auth')

@section('content')

<div class="col-md-5">
    <div class="card p-4">
        <div class="card-header text-center text-uppercase h4 font-weight-light">
            Login
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="card-body py-5">
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="form-control-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="form-control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary px-5">Login</button>
                    </div>

                    <div class="col-6">
                        {{-- <a href="#" class="btn btn-link">Forgot password?</a> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
