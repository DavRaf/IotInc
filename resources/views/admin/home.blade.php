@extends('layouts.admin')
@section('content')

	<h2>Benvenuto nel Pannello di Amministrazione</h2>
	<p>Puoi navigare utilizzando la barra di navigazione posta sopra :</p>                  
  <ul >
    <li>Vai su Gestione Clienti per registrare un nuovo cliente oppure per visualizzare i clienti già presenti nel sistema. E' possibile inviare una email a un determinato cliente oppure eliminare un cliente già esistente.</a></li>
    <li>Vai su Gestione Impianti per aggiungere un nuovo impianto (e i relativi sensori) oppure visualizzare, modificare o eliminare un impianto già esistente (con la possibilità di modificare anche informazioni riguardanti i sensori).</a></li>
    <li>Vai su Gestione Sensori per aggiungere un nuovo sensore a un impianto esistente oppure per visualizzare, modificare o attivare/disabilitare un sensore già registrato. E' possibile, inoltre, visualizzare gli eventuali malfunzionamenti che un sensore può aver presentato.</a></li>
  </ul>
@endsection
