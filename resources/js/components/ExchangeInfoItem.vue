<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent notification is-vertical">
            <div class="tile is-child">
                <b-table :data="data" :columns="columns"></b-table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["exchange", "pair"],
        data() {
            return {
                data: [this.exchange],
                columns: [
                    {
                        field: 'from_currency_code',
                        label: 'From'
                    },
                    {
                        field: 'to_currency_code',
                        label: 'To'
                    },
                    {
                        field: 'rate',
                        label: 'Rate',
                        numeric: true
                    },
                    {
                        field: 'refreshed_at',
                        label: 'Refreshed At'
                    },
                ]
            }
        }
    }
</script>