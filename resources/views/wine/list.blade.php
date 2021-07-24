@extends('layouts.app')

@section('content')
<div class="container">
        <div id="card">  
        @auth
            @if ( Auth::user()->name == 'admin' )
                <!-- Button to Trigger modal for adding new item -->
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                    Add New One
                </button>
                <!-- End Button -->
                <!-- Modal -->
                <wine-create></wine-create>
                <!-- End Modal -->
            @endif
            <wine-list></wine-list>
        @endauth
        
    </div>
</div>
@endsection
