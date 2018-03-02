@extends('layouts.admin')
@section('content')
                    <a href="{{route('visualizzaMalfunzionamenti')}}" class="btn btn-info ">Mostra malfunzionamenti sensori</a>
                    <a href="{{route('sensoreCRUD.create')}}" class="btn btn-info pull-right">Aggiungi nuovo</a>
                    <h2>Lista Generale Sensori</h2>
                    <h6 style="color: red">Attenzione! L'attivazione/disabilitazione di un sensore permetterà al sensore stesso rispettivamente di rilevare/non rilevare dati.</h6>
                    <h6 style="color: red">Attenzione! La cancellazione definitiva di un sensore provocherà la cancellazione di tutte le rilevazioni effettuate dal sensore. Si chieda prima al cliente l'autorizzazione a eseguire questa azione.</h6>          
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <label for="searchBar">Seleziona il criterio di ricerca desiderato:</label><br>
                    <input type="radio" name="myRadio" id="id" checked>Id
                    <input type="radio" name="myRadio" id="marca" >Marca
                    <input type="radio" name="myRadio" id="tipo" > Tipo
                    <input type="radio" name="myRadio" id="modello" >Modello
                    <input type="radio" name="myRadio" id="codice" >Codice
                    <input type="radio" name="myRadio" id="stato" >Stato
                    <input type="radio" name="myRadio" id="idImpianto" >Id Impianto
                    <br>
                    <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Cerca..">
                    <br>
                    <div style="overflow-x:auto;">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Modello</th>
                            <th>Codice</th>
                            <th>Descrizione</th>
                            <th>Stato</th>
                            <th>Id Impianto</th>
                        </tr>
                        </thead>
                        @foreach ($sensors as $sensor)
                            <tbody>
                            <tr>
                                <td>{{ $sensor->id }}</td>
                                <td>{{ $sensor->marca }}</td>
                                <td>{{ $sensor->tipo }}</td>
                                <td>{{ $sensor->modello }}</td>
                                <td>{{ $sensor->codice }}</td>
                                <td>{{ $sensor->descrizione }}</td>
                                <td>{{ $sensor->stato }}</td>
                                <td>{{ $sensor->idImpianto }}</td>
                                <td><a href="{{route('sensoreCRUD.edit',[$sensor->id])}}" class="btn btn-info" role="button">Modifica</a></td>
                                @if($sensor->stato == 'disabilitato')
                                  <td><a href="{{route('sensoreCRUD.cambiaStato',[$sensor->id,$sensor->stato])}}" class="btn btn-info" role="button">Attiva Sensore</a></td>
                                @else
                                  <td><a href="{{route('sensoreCRUD.cambiaStato',[$sensor->id,$sensor->stato])}}" class="btn btn-info btn-danger" role="button">Disabilita Sensore</a></td>
                                @endif
                                <td><form action = "{{route('sensoreCRUD.destroy',[$sensor->id])}}" method = "post">
                                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger pull-right">Elimina Definitavamente</button>
                                </form></td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>         
                    </div>
@endsection
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  if(document.getElementById("id").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

if(document.getElementById("marca").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

if( document.getElementById("tipo").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

if(document.getElementById("modello").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

if(document.getElementById("codice").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

if(document.getElementById("stato").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

if(document.getElementById("idImpianto").checked){
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

}
</script>
