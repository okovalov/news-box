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
        props: ["weather", "location"],
        data() {
            return {
                data: [this.weather],
                columns: [
                    {
                        field: 'location',
                        label: 'Location'
                    },
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