@extends('layouts.client')

@section('content')
                    <a href="{{route('home')}}" class="btn btn-info pull-right">Back</a>
                    <br>
                    <form action = "{{route('visualizzaRilevazioni.selectSensore')}}" method = "get">
                    <div class="form-group">
                        <label for="selImpianto">Seleziona Impianto:</label>
                        <select class="form-control" name="impianto">
                            @foreach($installations as $installation)
                            <option value="{{$installation->id}}">Id:{{$installation->id}} SitoMonitoraggio:{{$installation->sitoMonitoraggio}} Città:{{$installation->citta}} Indirizzo:{{$installation->indirizzo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="btn btn-success" value ="Seleziona">
                    </form>


 
@endsection
