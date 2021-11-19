@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('List of all move history') }}
                        <a href="{{ route('home') }}"> Go to Guess Number </a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table id="guessHistory" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Game Id</th>
                                <th>Move Number</th>
                                <th>Guess Value</th>
                                <th>Generate Value</th>
                                <th>Computer Answer</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet"/>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $('#guessHistory').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('guess-history') }}',
            columns: [
                {data: 'game_id', name: 'game_id'},
                {data: 'move_number', name: 'move_number'},
                {data: 'guess_value', name: 'guess_value'},
                {data: 'generated_value', name: 'generated_value'},
                {data: 'computer_answer', name: 'computer_answer'}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    console.log(column.footer())
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });
    </script>
@endsection
