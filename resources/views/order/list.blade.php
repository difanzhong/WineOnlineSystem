@extends('layouts.app')

@section('content')
<div class="container">
    <div id="card">
        @auth
            @if ( Auth::user()->name == 'admin' )
            
            <order-create></order-create>
            @endif
        @endauth
        <order-list></order-list>
    </div>
</div>
@endsection
