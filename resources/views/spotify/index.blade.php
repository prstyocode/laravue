@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Spotify') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          @if($users)
          <div class="col-md-12 mb-3">
            <img src="{{$users->images[0]->url}}" alt="{{$users->display_name}}" height="64px" width="64px" />
            <span>{{$users->display_name}}</span>
          </div>
          <div class="col-md-12 d-flex justify-content-end">
            <a href="spotify/logout" class="btn btn-danger btn-sm">Log Out</a>
          </div>
          @else
          <a href="spotify/connect" class="btn btn-success">Sign In with Spotify</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection