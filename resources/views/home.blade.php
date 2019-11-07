@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('getPrize') }}" class="btn btn-success btn-lg">Start</a>
            </div>
        </div>
    </div>
</div>
@endsection
