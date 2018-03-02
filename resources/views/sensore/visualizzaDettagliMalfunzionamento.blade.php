@extends('layouts.admin')
@section('content')
                    <a href="{{route('visualizzaMalfunzionamenti')}}" class="btn btn-info pull-right">Back</a>
                    <h2>Lista Errori Rilevati Dal Sensore</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Descrizione</th>
                            <th>Causa</th>
                        </tr>
                        </thead>
                        @foreach ($errors as $error)
                            <tbody>
                            <tr>
                                <td>{{ $error->codice }}</td>
                                <td>{{ $error->descrizione }}</td>
                                <td>{{ $error->causa }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>         
                    </div>
@endsection
