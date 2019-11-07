@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron text-center">
                    <h1 class="display-4">Выиграй гарантированный приз!</h1>
                    <p class="lead">Это простая магия - жми на кнопку и получай гарантированный приз.</p>
                    <hr class="my-4">
                    <p>Выиграй деньги, бонусы или подарок</p>
                    <p class="lead text-center">
                        <a class="btn btn-success btn-lg" href="{{ route('genPrize') }}" role="button">Получить</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
