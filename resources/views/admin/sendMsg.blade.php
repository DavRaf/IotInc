@extends('layouts.admin')
@section('content')
            <h2>Invio mail a : {{ $email }}</h2>
            <form action = "{{route('sendMsgExecute',[$email])}}" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label for="msg">Messaggio:</label>
                <br>
                <textarea rows="5" name="msg" placeholder="Scrivi Messaggio..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                Invia
            </button>
            </form>
@endsection
