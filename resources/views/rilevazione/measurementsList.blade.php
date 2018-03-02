@extends('layouts.client')
@section('content')

                    <a href="{{route('esportaTutto')}}" class="btn btn-info pull-right" role="button">Esporta Tutto in formato .csv</a>
                    <h2>Lista Rilevazioni</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <label for="searchBar">Seleziona il criterio di ricerca desiderato:</label><br>
                    <input type="radio" name="myRadio" id="numero" checked> Numero
                    <input type="radio" name="myRadio" id="idSensore" > Id Sensore
                    <input type="radio" name="myRadio" id="data" > Data Rilevazione
                    <input type="radio" name="myRadio" id="ora" > Ora Rilevazione
                    <input type="radio" name="myRadio" id="valore" > Valore Rilevazione
                    <br>
                    <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Cerca..">
                    <br>
                    <div style="overflow-x:auto;">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Id Sensore</th>
                            <th>Data Rilevazione</th>
                            <th>Ora Rilevazione</th>
                            <th>Valore Rilevazione</th>
                            <th>Codice Errore</th>
                        </tr>
                        </thead>
                        @foreach ($measurements as $measurement)
                            <tbody>
                            <tr>
                                <td>{{ $measurement->numero }}</td>
                                <td>{{ $measurement->idSensore }}</td>
                                <td>{{ $measurement->data }}</td>
                                <td>{{ $measurement->ora }}</td>
                                <td>{{ $measurement->valore }}</td>
                                <td>{{ $measurement->codiceErrore }}</td>
                                <td><a href="{{route('visualizzaRilevazioni.show',[$measurement->numero])}}" class="btn btn-info" role="button">Visualizza</a></td>
                                <td><a href="{{route('condividiRilevazione.index',[$measurement->numero])}}" class="btn btn-info" role="button">Condividi</a></td>
                                <td><a href="{{route('esporta',[$measurement->numero])}}" class="btn btn-info" role="button">Esporta in formato .csv</a></td>
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

  if(document.getElementById("numero").checked){
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

if(document.getElementById("idSensore").checked){
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

if( document.getElementById("data").checked){
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

if(document.getElementById("ora").checked){
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

if(document.getElementById("valore").checked){
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

}
</script>
