<template>
	<div class="absolute inset-0 flex flex-col items-center justify-center">
		<div class="p-2">
			<img class="content-center" :src="getImage(currentWeather.icon)" alt="">
		</div>
		<div class="p-2">
			<p>{{ currentWeather.description }}</p>
		</div>
	</div>
</template>
<script>
    export default {
        components: {

        },

		data() {
			return {

			}
		},

		props: ['weather'],

		methods: {
			getImage: function(icon) {
				return "http://openweathermap.org/img/wn/" + icon + "@2x.png"
			},
		},

		computed: {
			currentWeather: function() {
				return this.weather.weather[0]
			}
		}
    }
</script>
