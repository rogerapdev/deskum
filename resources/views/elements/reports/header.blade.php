<htmlpageheader name="page-header">
	<table width="100%">
		<tr>
			<td align="left">
				@include('elements.logos.svg_print')
			</td>
		</tr>
		<tr>
			<td align="center">
				<span style="font-family: serif; font-size: 16pt; font-weight: normal;">
					{{ $report_title }}
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
			<td align="right" style="font-family: serif; font-size: 7pt; border-bottom: 1px solid #e6e6e6;">
				<em>Gerado por: {{ Auth::user()->name }} em: {{ date('d/m/Y') }}</em>
			</td>
		</tr>
	</table>
</htmlpageheader>
