<template>
    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent is-vertical">
                <div class="tile is-parent box is-vertical">
                    <div class="tile is-parent ">
                        <div class="tile is-child ">
                            <p class="subtitle has-text-primary has-text-weight-semibold">{{item.title}}</p>
                        </div>
                    </div>
                    <div class="tile is-parent ">
                        <div class="tile is-child is-3 has-text-centered" v-if="item.url_to_image">
                            <figure class="image is-128x128">
                                <img v-bind:src="item.url_to_image" />
                            </figure>
                        </div>
                        <div class="tile is-child is-3" v-if="!item.url_to_image" >
                            <figure class="image is-128x128">
                                <img src="https://bulma.io/images/placeholders/128x128.png">
                            </figure>
                        </div>
                        <div class="tile is-child has-text-justified ">
                            <article class="">{{item.content}}</article>
                        </div>
                    </div>
                    <div class="tile is-parent  ">
                        <div class="tile is-child has-text-right">
                            <p class="has-text-primary is-italic">{{item.author}}</p>
                        </div>
                        <div class="tile is-child is-2 has-text-centered">
                            <p class="has-text-primary is-italic">{{item.published_at.split(' ').slice(0,1).join()}}</p>
                        </div>
                        <div class="tile is-child is-2 has-text-centered">
                            <a class="is-italic has-text-info" target="_blank" v-bind:href="item.url" >&nbsp;>> Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: ["item"],
        mounted() {
            console.log('news Item mounted ', this.item)

            // this.fetchData()
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