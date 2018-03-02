@extends('layouts.client')
@section('content')


                    <h2>Visualizzazione Rilevazione</h2>

                    <div class="form-group">
                        <label for="idSensore">Sensore:</label><br>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Modello</th>
                            <th>Codice</th>
                            <th>Stato</th>
                            <th>Descrizione</th>
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
                                <td>{{ $sensor->stato }}</td>
                                <td>{{ $sensor->descrizione }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>         
                    </div>
                    @foreach($measurements as $measurement)
                    <div class="form-group">
                    <label for="numero">Numero di Rilevazione:</label><br>
                        <input type="text" name="numero" value="{{$measurement->numero}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="stringaRilevazione">Stringa di Rilevazione:</label><br>
                            <input type="text" name="stringaRilevazione" value="{{$measurement->stringaRilevazione}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="data">Data Rilevazione:</label><br>
                            <input type="text" name="data" value="{{$measurement->data}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ora">Ora Rilevazione:</label><br>
                            <input type="text" name="ora" value="{{$measurement->ora}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="valore">Valore Rilevazione:</label><br>
                            <input type="text" name="valore" value="{{$measurement->valore}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="errore">Codice errore:</label><br>
                            <input type="text" name="errore" value="{{$measurement->codiceErrore}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="descrizione">Descrizione:</label>
                        <br>
                        <textarea rows="5" name="descrizione" disabled>{{$measurement->descrizione}}</textarea>
                    </div>
                    @endforeach
                    
    

@endsection
