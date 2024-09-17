@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
{{--                    <form action="{{route('mailbox.downloadAttachment')}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <input type="checkbox" name="id[]" value="5" checked>--}}
{{--                        <input type="checkbox" name="id[]" value="2" checked>--}}
{{--                        <input type="checkbox" name="id[]" value="3" checked>--}}
{{--                        <input type="checkbox" name="id[]" value="14" checked>--}}
{{--                        <button type="submit">Download</button>--}}
{{--                    </form>--}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
