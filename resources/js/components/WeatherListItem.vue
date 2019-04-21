<template>
    <div>
        <b-field>
            <weather-info-item v-if="isWeatherLoaded" :weather="weather" :location="location"></weather-info-item>
        </b-field>
        <b-notification ref="element" :closable="false">
            <button class="button is-primary is-medium" @click="fetchData">
                Refresh
            </button>
        </b-notification>
    </div>
</template>

<script>
    export default {
        props: ["location"],
        mounted() {
            console.log('Component mounted.', this.location)
            this.fetchData()
        },
        data() {
            return {
                isFullPage: false,
                isWeatherLoaded: true,
                weather: {},
            }
        },
        methods: {
            fetchData() {
                const loadingComponent = this.$loading.open({
                    container: this.isFullPage ? null : this.$refs.element.$el
                })
                this.isWeatherLoaded = false;

                setTimeout(() => loadingComponent.close(), 3 * 1000)
                this.updateWeatherInfo()
            },
            updateWeatherInfo() {
                const payload = {
                    location: this.location
                }
                axios
                    .post("/api/weather/", payload)
                    .then(response => {
                        console.log('response', response.data)
                        this.isWeatherLoaded = true

                        this.weather = {...this.weather, ...response.data.data};
                    });
                }
        }
    }
</script>