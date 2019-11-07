@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron text-center">
                    <h1 class="display-4">Запускаем псевдогенератор!</h1>
                    <p class="lead">Скрести пальцы и жди 2секунды!</p>
                    <hr class="my-4">
                    <p class="lead text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            setTimeout(function() {
                window.location.href = '{{ route('resultPrize') }}';
            }, 2000);

        });
    </script>

@endsection
