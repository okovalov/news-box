<template>
    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent ">
            <div class="tile is-child box is-vertical ">
                <div class="tile is-child">
                    <news-item v-for="(item, index) in newsData" :key="index"
                        :item="item">
                    </news-item>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["news"],
        mounted() {
            console.log('newsTopic mounted ', this.news)
            this.newsData = JSON.parse(this.news)
        },
        data() {
            return {
                newsData: [],
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
                // this.updateExchangeInfo()
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