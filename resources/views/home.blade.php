@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{--  when using v-bind: the name after colon in html should be in hyphen --}}
                    <wine-redirect :status-info="'{{ __('You are logged in!') }}'" :go-link="'{{ route('wine-list') }}'" :waiting-time="6"></wine-redirect>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
