@extends('layouts.admin')
@section('content')


                    <a href="{{route('installationCRUD.index')}}" class="btn btn-info pull-right">Back</a>
                    <h2>Visualizzazione Impianto</h2>

                    
                    @foreach($installations as $installation)
                    <div class="form-group">
                    <label for="sitoMonitoraggio">Sito di Monitoraggio:</label><br>
                        <input type="text" name="sitoMonitoraggio" value="{{$installation->sitoMonitoraggio}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="citta">Città:</label><br>
                            <input type="text" name="citta" value="{{$installation->citta}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="indirizzo">Indirizzo:</label><br>
                            <input type="text" name="indirizzo" value="{{$installation->indirizzo}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="descrizione">Descrizione:</label>
                        <br>
                        <textarea rows="5" name="descrizione" disabled>{{$installation->descrizione}}</textarea>
                    </div>
                    @endforeach
                    <label for="cliente">Cliente:</label>
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nome</td>
                            <td>Cognome</td>
                            <td>Email</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @foreach($users as $user)
                                <td>{{ $user->id}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                        <br>
                        <label for="sensori">Elenco sensori:</label>
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>Id</td>
                            <td>Marca</td>
                            <td>Tipo</td>
                            <td>Modello</td>
                            <td>Codice</td>
                            <td>Descrizione</td> 
                        </tr>
                        </thead>
                        @foreach ($sensors as $sensor)
                            <tbody>
                            <tr>
                                <td>{{ $sensor->id }}</td>
                                <td>{{ $sensor->marca }}</td>
                                <td>{{ $sensor->tipo }}</td>
                                <td>{{ $sensor->modello }}</td>
                                <td>{{ $sensor->codice }}</td>
                                <td>{{ $sensor->descrizione }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
               

@endsection
