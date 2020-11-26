<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ config('app.name') }}</title>
	</head>
	<body>
		<div>
			<div>
				<label for="sunrise">Sunrise</label>
				<input type="text" id="sunrise" value="{{ date('H:i', $weather->current->sunrise) }}">
			</div>
			<div>
				<label for="sunset">Sunset</label>
				<input type="text" id="sunset" value="{{ date('H:i', $weather->current->sunset) }}">
			</div>
		</div>
		<div>
			<table class="table-auto">
				<caption>Cuaca saat ini</caption>
				<thead>
					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Temperatur</th>
						<th>Cuaca</th>
						<th>Keterangan</th>
						<th>Icon</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ date('j M Y', $weather->current->dt + $weather->timezone_offset) }}</td>
						<td>{{ date('H:i', $weather->current->dt + $weather->timezone_offset) }}</td>
						<td>{{ $weather->current->temp }}</td>
						<td>{{ $weather->current->weather[0]->main }}</td>
						<td>{{ $weather->current->weather[0]->description }}</td>
						<td>{{ $weather->current->weather[0]->icon }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<table class="table-auto">
				<caption>Cuara hari ini</caption>
				<thead>
					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Temperatur</th>
						<th>Cuaca</th>
						<th>Keterangan</th>
						<th>Icon</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($weather->hourly as $cuaca)
						<tr>
							<td>{{ date('j M Y', $cuaca->dt + $weather->timezone_offset) }}</td>
							<td>{{ date('H:i', $cuaca->dt + $weather->timezone_offset) }}</td>
							<td>{{ $cuaca->temp }}</td>
							<td>{{ $cuaca->weather[0]->main }}</td>
							<td>{{ $cuaca->weather[0]->description }}</td>
							<td>{{ $cuaca->weather[0]->icon }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</body>
</html>