@extends('layouts.client')

@section('content')

                    @if (session('statusOK'))
                        <div class="alert alert-success">
                            {{ session('statusOK') }}
                        </div>
                    @endif
                     @if (session('statusNO'))
                        <div class="alert alert-danger">
                            {{ session('statusNO') }}
                        </div>
                    @endif
                    @if (session('statusErr'))
                        <div class="alert alert-danger">
                            {{ session('statusErr') }}
                        </div>
                    @endif

                    <h2>Simulazione Ricezione Stringa Rilevazione</h2>
                    <h6>Clicca sul pulsante in basso per simulare una rilevazione di un sensore</h6><br>

                    <a href="{{route('simulaRicezioneRilevazione.execute')}}" class="btn btn-info" role="button">Simula</a><br>


@endsection