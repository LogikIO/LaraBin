@extends('layout.master')

@section('title')
    @parent
    :: {{ $user->username }}'s Profile
@stop

@section('customcssfiles')
    {!! HTML::style('css/profile.css') !!}
@stop

@section('customcss')

@stop

@section('customjsfiles')

@stop

@section('customjs')

@stop

@section('content')
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ $user->avatar(190) }}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $user->name }}
                    </div>
                    <div class="profile-usertitle-job">
                        {{ $user->username }}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
{{--                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-success btn-sm">Follow</button>
                    <button type="button" class="btn btn-danger btn-sm">Message</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->--}}
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        @if($user->website)
                            <li>
                                <a href="{{ $user->website }}">
                                    <i class="fa fa-globe"></i>
                                    Website</a>
                            </li>
                        @endif
                        @if($user->github_username)
                            <li>
                                <a href="https://github.com/{{ $user->github_username }}">
                                    <i class="fa fa-github"></i>
                                    GitHub Profile</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                @if($bins->count())
                    @foreach($bins as $bin)
                        <div class="bin-details panel panel-default">
                            <div class="panel-heading">
                                <small>{!! $bin->versions_label() !!}</small><a href="{{ $bin->url() }}">{{ $bin->title }}</a>
                            </div>
                            @if($bin->description)
                                <div class="panel-body" style="padding:15px;">
                                    {{ $bin->description }}
                                </div>
                            @endif
                            <div class="panel-footer">
                            <span class="details">
                                <small>
                                    <span><i class="fa fa-file-text-o"></i> {{ $bin->snippets->count() }}</span>
                                    <span title="Created"><i class="fa fa-clock-o"></i> {{ $bin->created_at->diffForHumans() }}</span>
                                    @if($bin->modified())
                                        <span title="Updated"><i class="fa fa-pencil"></i> {{ $bin->updated_at->diffForHumans() }}</span>
                                    @endif
                                </small>
                            </span>
                            </div>
                        </div>
                    @endforeach
                    {!! $bins->render() !!}
                @else
                    <div class="alert alert-info">
                        This user has no public bins.
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop