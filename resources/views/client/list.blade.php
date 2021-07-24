@extends('layouts.app')

@section('content')
<div class="container">
        <div id="card">
        @auth
            @if ( Auth::user()->name == 'admin' )
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#clientModal">
                New Client 
            </button>
            <client-list></client-list>
            @endif
        @endauth
    </div>
</div>
@endsection
