@extends('layouts.admin')
@section('content')


                    <a href="{{route('installationCRUD.index')}}" class="btn btn-info pull-right">Back</a>
                    <h2>Aggiungi nuovo impianto</h2>
                    <h6 style="color: red">* campo obbligatorio</h6>          
                    <form action = "{{route('installationCRUD.store')}}" method = "post">
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
                        <label for="selUser">* Seleziona cliente:</label>
                        <select class="form-control" name="user">
                            @foreach($users as $user)
                            <option value="{{$user->id}}">Codice:{{$user->id}} Nome:{{$user->name}} Cognome:{{$user->lastname}} Email:{{$user->email}}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="sito">* Sito di monitoraggio:</label>
                            <!--<input type="text" class="form-control" placeholder="Enter sito monitoraggio" name="sitoMonitoraggio">-->
                            <input type="text" class="form-control" list="siti" name="sitoMonitoraggio"  placeholder="Seleziona uno dei siti disponibili oppure inserisci un nuovo sito di monitoraggio..." autocomplete="off">
                            <datalist id="siti" name="sitoMonitoraggio">
                                <option value="Serra">Serra</option>
                                <option value="Campo">Campo</option>
                                <option value="Silos">Silos</option>
                                <option value="Edificio">Edificio</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="citta">* Città:</label>
                            <input type="text" class="form-control" placeholder="Inserisci città..." name="citta">
                        </div>
                        <div class="form-group">
                            <label for="indirizzo">* Indirizzo:</label>
                            <input type="text" class="form-control" placeholder="Inserisci indirizzo..." name="indirizzo">
                        </div>
                        <div class="form-group">
                            <label for="descrizione">Descrizione:</label>
                            <br>
                            <textarea rows="5" name="descrizione" placeholder="Inserisci una descrizione..."></textarea>
                        </div>
                        <input type="submit" class="btn btn-success" value ="Avanti">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </form> 
                    

                
@endsection

