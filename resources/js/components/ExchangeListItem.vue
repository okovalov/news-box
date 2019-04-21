<template>
    <div>
        <b-field>
            <exchange-info-item v-if="isExchangeLoaded" :exchange="exchange" :pair="pair"></exchange-info-item>
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