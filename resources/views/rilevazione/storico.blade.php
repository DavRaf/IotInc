@extends('layouts.client')

@section('content')
        <a href="{{route('storico.index')}}" class="btn btn-info pull-right">Back</a>
		<h2> Storico Impianto</h2>
		<p><h3>Qui di seguito, puoi selezionare un sensore per visualizzare lo storico relativo a tale sensore</h3></p>
		<form action = "{{route('storico.graphSensore')}}" method = "get">
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
		<p><h3>Qui, invece, puoi visualizzare informazioni generali, sotto forma di grafici, dell'intero impianto</h></p>
        {!! $charts[0]->render() !!}
        {!! $charts[1]->render() !!}
        {!! $charts[2]->render() !!}
        {!! $charts[3]->render() !!}
        {!! $charts[4]->render() !!}

@endsection
