@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron text-center">
                    <h1 class="display-4">Играй еще!</h1>
                    <hr class="my-4">
                    <p class="lead text-center">
                        <a href="{{ route('getPrize') }}" class="btn btn-success btn-lg">Играть</a>
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
