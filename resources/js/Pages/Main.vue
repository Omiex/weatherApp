<template>
    <app-layout>
		<div class="max-w-xl mx-auto overflow-hidden p-2 text-gray-700">
			<!-- search & city area -->
			<div class="flex justify-center">
				<select @change="changeCity()" :value="latlon" class="form-select appearance-none border-none bg-transparent">
					<option v-for="city in cities" :value="city.latlon">{{ city.name }}</option>
				</select>
			</div>

			<!-- main icon -->
			<div class="relative bg-white h-60">
				<main-icon :weather="weather.current" :selectedTime="selectedTime" />
				<!-- <div v-for="i in 24">
					<main-icon :weather="weather.hourly[i]" :selectedTime="selectedTime" />
				</div> -->
				<div class="p-2">
					{{ time(selectedTime) }}
				</div>
			</div>

			<!-- day info -->
			<div class="flex justify-between">
				<div class="self-end">
					Sunrise: {{ time(current.sunrise) }}
				</div>
				<div class="self-end">
					Sunset: {{ time(current.sunset) }}
				</div>
			</div>

			<!-- slider -->
			<div class="">

				<div class="">
					<input class="rounded-lg overflow-hidden appearance-none bg-gray-400 h-3 w-full" type="range" :min="older" :max="newer" :step="step" value="selectedTime" v-model="selectedTime" />
				</div>
			</div>
		</div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/Main'
    import MainIcon from '@/Components/MainIcon'

    export default {
        components: {
            AppLayout, MainIcon,
        },

		data() {
			return {
				selectedTime: this.weather.current.dt,
			}
		},

		props: ['weather', 'cities', 'latlon', 'baseUrl'],

		methods: {
			changeCity: function() {
				let el = event.target
				let latlon = el.options[el.selectedIndex].value
				window.location.href = this.baseUrl + '/' + latlon
			},

			time: function(data) {
				let time = data + this.weather.timezone_offset
				if (time < 0)
					time = 0;
				var hrs = ~~(time / 3600 % 24),
					mins = ~~((time % 3600) / 60),
					hrs = '0' + hrs,
					_hrs = hrs.substring(hrs.length - 2, hrs.length),
					mins = '0' + mins,
					_mins = mins.substring(mins.length - 2, mins.length);
				return _hrs + ":" + _mins;
			},
		},

		computed: {
			current: function() {
				return this.weather.current
			},

			older: function() {
				return this.weather.hourly[0].dt
			},

			newer: function() {
				return this.weather.hourly[23].dt
			},

			step: function() {
				return this.weather.hourly[1].dt - this.weather.hourly[0].dt
			}
		}
    }
</script>
