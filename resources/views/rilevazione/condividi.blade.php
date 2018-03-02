@extends('layouts.client')
@section('content')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Invia per Email la Rilevazione</h2>
                    <h6>Inserisci nella casella di testo seguente l'email del destinatario</h6><br>

                    <form action = "{{route('condividiRilevazione.sendEmail',[$id])}}" method = "post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label for="email">Email:</label><br>
                        <input type="email" class="form-control" name="email" placeholder="Inserisci Email Destinatario...">
                        <br>
                        <input type="submit" class="btn btn-info" value="Invia">
                    </div>
                    </form>

 
@endsection