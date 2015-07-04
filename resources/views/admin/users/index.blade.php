@extends('layout.master')

@section('title')
    @parent
    :: All Users
@stop

@section('customcssfiles')

@stop

@section('customcss')
form.activate {
    float: left;
    margin-right: 6px;
}
@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="{{ (!$user->verified()) ? 'danger' : '' }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{!! ($user->usingGithub()) ? '<i class="fa fa-github"></i>' : '' !!}<a href="{{ $user->url() }}">{{ $user->username }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!$user->verified())
                                {!! Form::open(['route' => 'admin.users.activate', 'class' => 'activate']) !!}
                                    {!! Form::hidden('id', $user->id) !!}
                                    <button type="submit" class="btn btn-xs btn-info">Activate</button>
                                {!! Form::close() !!}
                            @endif
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-xs btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->render() !!}
    </div>
</div>
@stop