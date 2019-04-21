<template>
    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent notification">
                <div class="tile is-child  has-text-centered">
                    <b-field>
                        <exchange-info-item v-if="isExchangeLoaded" :exchange="exchange" :pair="pair"></exchange-info-item>
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
        props: ["pair"],
        mounted() {
            this.fetchData()
        },
        data() {
            return {
                isFullPage: false,
                isExchangeLoaded: true,
                exchange: {},
            }
        },
        methods: {
            fetchData() {
                const loadingComponent = this.$loading.open({
                    container: this.isFullPage ? null : this.$refs.element.$el
                })
                this.isExchangeLoaded = false;

                setTimeout(() => loadingComponent.close(), 3 * 1000)
                this.updateExchangeInfo()
            },
            updateExchangeInfo() {
                const from = this.pair.split(' ').slice(0,1).join()
                const to = this.pair.split(' ').slice(1).join()

                const payload = {
                    from,
                    to
                }

                axios
                    .post("/api/exchange/", payload)
                    .then(response => {
                        this.isExchangeLoaded = true
                        this.exchange = {...this.exchange, ...response.data.data};
                    });
                }
        }
    }
</script>