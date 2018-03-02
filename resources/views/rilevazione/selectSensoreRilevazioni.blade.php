@extends('layouts.client')

@section('content')
                    <a href="{{route('visualizzaRilevazioni.selectImpianto')}}" class="btn btn-info pull-right">Back</a>
                    <br>
                    <form action = "{{route('visualizzaRilevazioni.list')}}" method = "get">
                    <div class="form-group">
                        <label for="selSensore">Seleziona Sensore:</label>
                        <select class="form-control" name="sensore">
                            @foreach($sensors as $sensor)
                            <option value="{{$sensor->id}}">Id:{{$sensor->id}} Marca:{{$sensor->marca}} Tipo:{{$sensor->tipo}} Modello:{{$sensor->modello}} Codice:{{$sensor->codice}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="btn btn-success" value ="Seleziona">
                    </form>


 
@endsection