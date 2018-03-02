<table border="1">
<thead>
	<td>Numero rilevazione:</td>
	<td>Id Sensore:</td>
	<td>Data:</td>
	<td>Ora:</td>
	<td>Valore:</td>
	<td>Codice errore:</td>
	<td>Descrizione:</td>
</thead>
<tbody>
		<td>{{$rilevazione->numero}}</td>
		<td>{{$rilevazione->idSensore}}</td>
		<td>{{$rilevazione->data}}</td>
		<td>{{$rilevazione->ora}}</td>
		<td>{{$rilevazione->valore}}</td>
		<td>{{$rilevazione->codiceErrore}}</td>
		<td>{{$rilevazione->descrizione}}</td>
</tbody>
</table>