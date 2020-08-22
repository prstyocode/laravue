@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Listings') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <crypto-listings></crypto-listings>
          <!-- @foreach($listings as $listing)
          <pre>{{$listing->name}} ({{$listing->symbol}}) @idr($listing->quote->IDR->price)</pre>
          @endforeach -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection