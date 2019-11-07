@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron text-center">
                    <h1 class="display-4">Приз!</h1>
                    <p class="lead">Вы получаете: {{ __('entities.prize_type_' . $prize->type)  }} - {{ $prize->value }}</p>
                    <hr class="my-4">
                    <p class="lead text-center">

                    </p>
                </div>

            </div>
        </div>
    </div>

@endsection
