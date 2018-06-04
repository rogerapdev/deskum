<htmlpageheader name="page-header">
	<table width="100%">
		<tr>
			<td align="left">
				<span class="fs-16" style="float: right;">{{ env('APP_NAME', 'Escolarisy') }}</span><br/><br/>
				<span style="font-family: serif; font-size: 16pt;">
					<h4>{{ $report_title }}</h4>
				</span>
			</td>
		</tr>
		@if(!empty($report_selections))
		<tr>
			<td>
				<strong>Filtros:</strong> {{ $report_selections }}
			</td>
		</tr>
		@endif
		<tr>
			<td align="right" style="font-family: serif; font-size: 8pt; border-bottom: 1px solid #e6e6e6;">
				<em>Gerado por: {{ Auth::user()->name }} em: {{ date('d/m/Y') }}</em>
			</td>
		</tr>
	</table>
</htmlpageheader>
