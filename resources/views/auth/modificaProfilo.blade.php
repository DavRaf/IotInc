@extends('layouts.client')

@section('content')


                    <h2>Modifica credenziali</h2>
                    <h6 style="color: red">* campo obbligatorio</h6>          
                    <form action = "{{route('modificaProfilo.edit',[Auth::user()->id])}}" method = "post">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{$error}}
                            @endforeach
                            </div>
                        @endif

                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email">* Email:</label>
                            <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" placeholder="Inserire nuova email..." >
                        </div>
                        <div class="form-group">
                            <label for="password">* Password:</label>
                            <input type="password" class="form-control" placeholder="Inserisci la nuova password..." name="password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">* Conferma Password:</label>
                                <input id="password-confirm" type="password" class="form-control" placeholder="Ripeti la nuova password..." name="password_confirmation" required>
                        </div>
                        <input type="submit" class="btn btn-success" value = "Salva">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </form> 

               
@endsection
