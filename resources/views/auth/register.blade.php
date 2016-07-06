@extends('layouts.app')

@section('content')
    <?php
    $crud = true;
    $url = url('/user');
    if (!isset($user)) {
        $user = new \App\User();

        $crud = false;
        $url = url('/register');
    }

    $edit = ($user->id > 0);

    $user->name = (old('name') ? : $user->name);
    $user->email = (old('email') ? : $user->email);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ !$edit ? 'Register' : 'Edit user - ' . $user->name }}</div>
                    <div class="panel-body">
                        @if (!$edit)
                            <form class="form-horizontal" role="form" method="POST" action="{{ $url }}"
                                  autocomplete="off">
                                {{ csrf_field() }}

                                @else
                                    {{ Form::model($user, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => array('user.update', $user->id))) }}
                                @endif

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ $user->name }}" autocomplete="off">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ $user->email }}" autocomplete="off" {{ $edit ? 'readonly="true"' : '' }}>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password"
                                               autocomplete="off">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                @if (!$crud)
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm
                                            Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" autocomplete="off">

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Register
                                        </button>

                                        @if ($crud)
                                            <a class="btn btn-default" href="{!! route('user.index') !!}">Back</a>
                                            <input id="id" name="id" type="hidden" value="{{ $user->id }}"/>
                                        @endif
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
