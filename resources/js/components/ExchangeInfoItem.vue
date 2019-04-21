<template>
    <div>
        <p><strong>{{ pair }}</strong></p>
        <b-table :data="data" :columns="columns"></b-table>
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