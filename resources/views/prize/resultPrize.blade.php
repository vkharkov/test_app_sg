@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron text-center">
                    <p class="lead">Ваш приз!</p>
                    <h1>{{ __('entities.prize_type_' . $prize->type)  }} - {{ $prize->type === 1 ? $gift->name : $prize->value . ' рублей!' }}</h1>
                    <hr class="my-4">
                    <p class="lead text-center">

                    <div class="btn-group">
                        <button type="button" name="decline" class="btn btn-lg btn-outline-primary">Отказаться</button>
                        <button type="button" name="collect" class="btn btn-lg btn-success">Получить</button>
                        @if ($prize->type === 3)
                        <button type="button" name="convert" class="btn btn-lg btn-warning">Конверитровать в бонусы</button>
                        @endif
                    </div>

                    </p>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            let PRIZE_ID = {{ $prize->id }};

            $('button[name=decline]').on('click', function () {
                $.post(
                    '{{ route('declinePrize') }}',
                    {
                        'prizeId': PRIZE_ID,
                        '_token': $('meta[name=csrf-token]').attr("content")
                    },
                    function (data) {
                        if (data.status == true) {
                            $(location).attr('href', '{{ route('gameOver') }}');
                        }
                    }
                );
            });

            $('button[name=collect]').on('click', function () {
                $.post(
                    '{{ route('collectPrize') }}',
                    {
                        'prizeId': PRIZE_ID,
                        '_token': $('meta[name=csrf-token]').attr("content")
                    },
                    function (data) {
                        if (data.status == true) {
                            $(location).attr('href', '{{ route('gameOver') }}');
                        }
                    }
                );
            });

            $('button[name=convert]').on('click', function () {
                $.post(
                    '{{ route('convertToBonus') }}',
                    {
                        'prizeId': PRIZE_ID,
                        '_token': $('meta[name=csrf-token]').attr("content")
                    },
                    function (data) {
                        if (data.status == true) {
                            $(location).attr('href', '{{ route('gameOver') }}');
                        }
                    }
                );
            });

        });
    </script>

@endsection
