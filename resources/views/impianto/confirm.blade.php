@extends('layouts.admin')
@section('content')


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    Vuoi aggiungere un altro sensore? Fai click su 

                    <a href="{{route('installationCRUD.addSensore',[$idImpianto])}}" class="btn btn-info" role="button">Continua</a><br>

                    Altrimenti termina la configurazione dell'impianto cliccando su

                    <a href="{{route('installationCRUD.index')}}" class="btn btn-info" role="button">Termina</a>


               
@endsection

