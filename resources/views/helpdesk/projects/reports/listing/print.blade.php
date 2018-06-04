@include('elements.reports.header')

<table class="print">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Marca/Modelo</th>
			<th>Placa</th>
		</tr>
	</thead>
	<tbody>

	@forelse($report_data as $vehicle)
	<tr>
		<td>
			{{ $vehicle->name }}
		</td>
		<td>
			{{ $vehicle->brand }} / {{ $vehicle->model }} ({{ $vehicle->year }})
		</td>
		<td>
			{{ $vehicle->plate }}
		</td>

	</tr>
	@empty
	<tr>
		<td>Nenhum registro foi encontrado</td>
	</tr>
	@endforelse
	</tbody>

</table>

@include('elements.reports.footer')
