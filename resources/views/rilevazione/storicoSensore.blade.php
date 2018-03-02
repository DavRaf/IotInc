@extends('layouts.client')

@section('content')
        <a href="{{route('storico.index')}}" class="btn btn-info pull-right">Torna alla pagina di selezione dell'impianto</a>
        {!! $charts[0]->render() !!}
       

@endsection