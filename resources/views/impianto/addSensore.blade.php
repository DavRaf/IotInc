@extends('layouts.admin')
@section('content')


                    <h2>Registrazione sensori</h2>
                    <h6 style="color: red">* campo obbligatorio</h6>          
                    <form action = "{{route('installationCRUD.storeSensore',[$id])}}" method = "post">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{$error}}
                            @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="marca">* Marca:</label>
                            <!--<input type="text" class="form-control" placeholder="Enter marca" name="marca">-->
                            <input type="text" class="form-control" list="marche" name="marca" autocomplete="off" placeholder="Seleziona una delle marche disponibili oppure inserisci una nuova marca...">
                            <datalist name="marca" id="marche">
                                <option value="Acer">Acer</option>
                                <option value="Apple">Apple</option>
                                <option value="Arduino">Arduino</option>
                                <option value="Asus">Asus</option>
                                <option value="Bosch">Bosch</option>
                                <option value="Dyson">Dyson</option>
                                <option value="Electrolux">Electrolux</option>
                                <option value="Epcos">Epcos </option>
                                <option value="Epson">Epson</option>
                                <option value="Fitbit">Fitbit</option>
                                <option value="Fujitsu">Fujitsu</option>
                                <option value="GoPro">GoPro</option>
                                <option value="Heraeus">Heraeus</option>
                                <option value="Hitachi">Hitachi</option>
                                <option value="Honeywell">Honeywell </option>
                                <option value="Hp">Hp</option>
                                <option value="Hotpoint">Hotpoint</option>
                                <option value="Huawei">Huawei</option>
                                <option value="IBM">IBM</option>
                                <option value="Iduino">Iduino</option>
                                <option value="Infineon Technologies">Infineon Technologies</option>
                                <option value="Isnatch">Isnatch</option>
                                <option value="Lenovo">Lenovo</option>
                                <option value="Lg">Lg</option>
                                <option value="Logitech">Logitech</option>
                                <option value="Panasonic">Panasonic</option>
                                <option value="Robot">Robot</option>
                                <option value="Maxim Integrated">Maxim Integrated</option>
                                <option value="Microsoft">Microsoft</option>
                                <option value="Murata">Murata </option>
                                <option value="Nikon">Nikon</option>
                                <option value="Philips">Philips</option>
                                <option value="Rowenta">Rowenta</option>
                                <option value="Rose LM">Rose LM</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Sensirion">Sensirion </option>
                                <option value="Sony">Sony</option>
                                <option value="Tewa Electronics">Tewa Electronics</option>
                                <option value="Tesla">Tesla</option>
                                <option value="Toshiba">Toshiba</option>
                                <option value="TRU COMPONENTS">TRU COMPONENTS</option>
                                <option value="Vodafone">Vodafone</option>
                                <option value="Unitronic">Unitronic</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="tipo">* Tipo:</label>
                            <!--<input type="text" class="form-control" placeholder="Enter tipo" name="tipo">-->
                            <input type="text" class="form-control" list="tipo" name="tipo" autocomplete="off" placeholder="Seleziona uno dei tipi disponibili oppure inserisci un nuovo tipo...">
                            <datalist id="tipo" name="tipo">
                                <option value="Luce">Luce(o ottico)</option>
                                <option value="Infrarossi">Infrarossi</option>
                                <option value="Suono">Suono</option>
                                <option value="Accelerazione">Accelerazione</option>
                                <option value="Temperatura">Temperatura</option>
                                <option value="Calore">Calore</option>
                                <option value="Radiazione">Radiazione</option>
                                <option value="Resistenza elettrica">Resistenza elettrica </option>
                                <option value="Corrente elettrica">Corrente elettrica</option>
                                <option value="Tensione elettrica">Tensione elettrica</option>
                                <option value="Potenza elettrica">Potenza elettrica</option>
                                <option value="Magnetismo">Magnetismo</option>
                                <option value="Pressione">Pressione</option>
                                <option value="Gas">Gas</option>
                                <option value="Movimento">Movimento </option>
                                <option value="Forza">Forza</option>
                                <option value="Prossimità">Prossimità</option>
                                <option value="Distanza">Distanza</option>
                                <option value="Umidità">Umidità</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="modello">* Modello:</label>
                            <input type="text" class="form-control" placeholder="Inserisci modello..." name="modello" >
                        </div>
                        <div class="form-group">
                            <label for="codice">* Codice:</label>
                            <input type="text" class="form-control" placeholder="Inserisci codice..." name="codice" >
                        </div>
                        <!--<div class="form-group">
                            <label for="unitaMisura">Unità di misura:</label>
                            <input type="text" class="form-control" placeholder="Enter unità di misura" name="unitaMisura">
                        </div>-->
                        <div class="form-group">
                            <label for="descrizione">Descrizione:</label>
                            <br>
                            <textarea rows="5" name="descrizione" placeholder="Inserisci descrizione..."></textarea>
                        </div>
                        <div class="form-group">
                        <label for="impianto">* Impianto:</label>
                            <input type="text" class="form-control" name="impianto" value={{$id}} disabled>
                        </div>
                        <input type="submit" class="btn btn-success" value = "Aggiungi">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </form> 
                    

               
@endsection

