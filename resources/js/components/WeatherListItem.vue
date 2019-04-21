<template>
    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent notification">
                <div class="tile is-child  has-text-centered">
                    <b-field>
                        <weather-info-item v-if="isWeatherLoaded" :weather="weather" :location="location"></weather-info-item>
                    </b-field>
                </div>
                <div class="tile is-child is-2 has-text-centered">
                    <b-notification ref="element" :closable="false">
                        <button class="button is-primary is-medium is-rounded" @click="fetchData">
                            Refresh
                        </button>
                    </b-notification>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["location"],
        mounted() {
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
                        this.isWeatherLoaded = true

                        this.weather = {...this.weather, ...response.data.data};
                    });
                }
        }
    }
</script>