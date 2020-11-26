<x-layouts.main>
	<div class="max-w-7xl mx-auto overflow-hidden h-screen p-2">
		{{-- search & city area --}}
		<div class="flex justify-center">
			<select class="form-select appearance-none border-none bg-transparent" onchange="changeCity()">
				@foreach ($cities as $city)
					<option value="{{ $city['latlon'] }}"
						@if (request()->is($city['latlon'])) selected @endif
					>
						{{ $city['name'] }}
					</option>
				@endforeach
			</select>
		</div>

		{{-- main icon --}}
		<div class="bg-white h-3/5 flex justify-center">
			<div class="">
				<img class="content-center" src="http://openweathermap.org/img/wn/{{ $weather->current->weather[0]->icon }}@2x.png" alt="">
			</div>
		</div>

		{{-- slider --}}
		<div class="">

		</div>
	</div>
	<script>
		function changeCity() {
			let el = event.target
			let latlon = el.options[el.selectedIndex].value
			window.location.href = "{{ url('/') }}/" + latlon
		}
	</script>
</x-layouts.main>
