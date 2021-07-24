<template>
    <table>
        <thead>
            <tr>
                <th class="first">Name</th>
                <th class="">Grape</th>
                <th class="">Brand</th>
                <th class="">Year</th>
                <th class="">Price</th>
                <th class="">Volume</th>
                <th class="">Cap Style</th>
                <th class="">Rewarded</th>
                <th class="">Stock</th>
            </tr>
        </thead>
        <tbody>
            <tr data-toggle="modal" data-placement="bottom" v-for="wine in wines" :key="wine.id" data-target="#exampleModal" v-on:click="loadUpdateModal(wine)">
                <td data-label="Name" class="first">{{ wine.name }}</td>
                <td data-label="Grape" class="">{{ wine.grape }}</td>
                <td data-label="Brand" class="">{{ wine.brand }}</td>
                <td data-label="Year" class="">{{ wine.year }}</td>
                <td data-label="Price" class="">{{ wine.price }}</td>
                <td data-label="Size" class="">{{ wine.size }}</td>
                <td data-label="Cap" class="">{{ wine.cap }}</td>
                <td data-label="Rewarded" class="">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-award" fill="currentColor" xmlns="http://www.w3.org/2000/svg" v-if="wine.rewarded">
                        <path fill-rule="evenodd" d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l-1.51-.229L8 1.126l-1.355.702-1.51.229-.684 1.365-1.086 1.072L3.614 6l-.25 1.506 1.087 1.072.684 1.365 1.51.229L8 10.874l1.356-.702 1.509-.229.684-1.365 1.086-1.072L12.387 6l.248-1.506-1.086-1.072-.684-1.365z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                    </svg>
                </td>
                <td data-label="Stock" class="" >{{ wine.stock }}</td> 
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                wines: []
            }
        },
        created() {
            this.loadWines();
        },
        methods: {
            loadUpdateModal: function (e) {
                this.$root.$emit("loadFields", e);
            },
            loadWines: function() {
                axios.get('/api/wines/')
                    .then((response) => {
                        this.wines = response.data.data;
                    }).catch( function(err) {
                        console.log(err);
                });
            }
        }
    }
</script>

