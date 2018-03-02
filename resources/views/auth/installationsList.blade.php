@extends('layouts.client')
@section('content')



                    <h2>Lista Generale Impianti</h2>
                    
                     <label for="searchBar">Seleziona il criterio di ricerca desiderato:</label>
                    <input type="radio" name="myRadio" id="id" checked>Id
                    <input type="radio" name="myRadio" id="sitoMonitoraggio" >Sito Monitoraggio
                    <input type="radio" name="myRadio" id="citta" > Città
                    <input type="radio" name="myRadio" id="indirizzo" >Indirizzo
                    <br>
                    <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Cerca..">
                    <br>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Sito Monitoraggio</th>
                            <th>Città</th>
                            <th>Indirizzo</th>
                            <th>Descrizione</th>
                        </tr>
                        </thead>
                        @foreach ($installations as $installation)
                            <tbody>
                            <tr>
                                <td>{{ $installation->id }}</td>
                                <td>{{ $installation->sitoMonitoraggio }}</td>
                                <td>{{ $installation->citta }}</td>
                                <td>{{ $installation->indirizzo }}</td>
                                <td>{{ $installation->descrizione }}</td>
                                <td><a href="{{route('visualizzaImpianti.show',[$installation->id])}}" class="btn btn-info" role="button">Visualizza</a></td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>         
 

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

if(document.getElementById("sitoMonitoraggio").checked){
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

if( document.getElementById("citta").checked){
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

if(document.getElementById("indirizzo").checked){
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

}
</script>
