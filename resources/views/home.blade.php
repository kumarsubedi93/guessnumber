@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="loading">
                    <img id="loading-image" src="{{ asset('images/loader.gif') }}" alt="Loading..."/>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Guess A Number') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Guess Number') }}</label>

                            <div class="col-md-6">
                                <input type="number" min="0" max="100"
                                       class="guess_number form-control @error('guess_number') is-invalid @enderror"
                                       name="guess_number"
                                       value="{{ old('guess_number') }}" placeholder="Guess the number" required>

                                @error('guess_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" id="guessNumber" class="btn btn-primary">
                                    {{ __('Guess') }}
                                </button>
                            </div>
                        </div>
                        <div id="result-box"></div>
                        <a style="float: right" href="{{ route('guess-history') }}"> Go to Guess History</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        #loading {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
        }

        #loading-image {
            position: absolute;
            top: 100px;
            left: 240px;
            z-index: 100;
        }

        .result-text {
            font-size: 16px;
            margin-top: 10px;
            color: green;
        }
    </style>
@endsection

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script>
        var csrf = "{{ csrf_token() }}";
        var reqUrl = "{{ route('guess-store-result') }}";
        $(function () {
            $(document).on('click', '#guessNumber', function (event) {
                event.preventDefault();
                var guessNumber = $(".guess_number");
                var loading = $('#loading');
                var resultbox = $('#result-box');
                if (guessNumber.val()) {
                    loading.css({display: 'block'});
                    makeHttpRequest({guess_number: guessNumber.val()})
                        .then(function (response) {
                            loading.css({display: 'none'});
                            resultbox.html('')
                            resultbox.append(
                                '<p class="result-text"> The Result is :  ' + response.computer_answer + '</p>'
                            )
                        }).catch(function (err) {
                        loading.css({display: 'none'});
                    });
                    guessNumber.val('')
                }
            })
        });

        function makeHttpRequest(payload) {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    type: 'POST',
                    url: reqUrl,
                    data: {
                        _token: csrf,
                        guess_number: payload.guess_number
                    },
                    success: function (response) {
                        resolve(response)
                    },
                    error: function (error) {
                        reject(error)
                    }
                })
            })
        }
    </script>
@endsection
