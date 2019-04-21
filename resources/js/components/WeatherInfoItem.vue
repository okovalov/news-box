<template>
    <div>
        <p><strong>{{ location }}</strong></p>
        <b-table :data="data" :columns="columns"></b-table>
    </div>
</template>

<script>
    export default {
        props: ["weather", "location"],
        data() {
            return {
                data: [this.weather],
                columns: [
                    {
                        field: 'clouds',
                        label: 'Clouds %'
                    },
                    {
                        field: 'description',
                        label: 'Details'
                    },
                    {
                        field: 'wind',
                        label: 'Wind',
                        numeric: true,
                    },
                    {
                        field: 'updated_at',
                        label: 'Updated at',
                    }

                ]
            }
        }
    }
</script>