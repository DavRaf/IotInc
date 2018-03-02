@extends('layouts.admin')
@section('content')
                    <a href="{{route('addUtente')}}" class="btn btn-info pull-right">Aggiungi Nuovo</a>
                    <h2>Visualizzazione clienti</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <label for="searchBar">Seleziona il criterio di ricerca desiderato:</label>
                    <input type="radio" name="myRadio" id="id" checked>Id
                    <input type="radio" name="myRadio" id="nome" > Nome
                    <input type="radio" name="myRadio" id="cognome" > Cognome
                    <input type="radio" name="myRadio" id="email" >Email
                    <br>
                    <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Cerca..">
                    <br>
                    <div style="overflow-x:auto;">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        @foreach ($users as $user)
                            <tbody>
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{route('sendMsg',[$user->email])}}" class="btn btn-info" role="button">Invia messaggio via email</a></td>
                                <td><a href="{{route('delete',[$user->id])}}" class="btn btn-info btn-danger" role="button">Elimina</a></td>
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

if(document.getElementById("nome").checked){
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

if( document.getElementById("cognome").checked){
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

if(document.getElementById("email").checked){
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
