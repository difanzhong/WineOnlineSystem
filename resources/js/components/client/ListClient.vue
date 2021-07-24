<template>
    <table>
        <thead>
            <tr>
                <th class="first">Name</th>
                <th class="first">Wechat</th>
                <th class="first">Address</th>
            </tr>
        </thead>
        <tbody>
            <tr data-toggle="modal" data-placement="bottom" v-for="client in clients" :key="client.id" data-target="#clientModal" v-on:click="loadUpdateModal(client)">
                <td data-label="Name" class="first">{{ client.name }}</td>
                <td data-label="Wechat" class="first">{{ client.wechat }}</td>
                <td data-label="Address" class="first">{{ addr_tostring(client.address) }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                clients: []
            }
        },
        created() {
            this.loadClients();
        },
        methods: {
            loadUpdateModal: function (e) {
                this.$root.$emit("loadClientFields", e);
            },
            loadClients: function() {
                axios.get('/api/clients/')
                    .then((response) => {
                        this.clients = response.data.data;
                    }).catch( function(err) {
                        console.log(err);
                });
            },
            addr_tostring: function (addr) {
                return `${addr.province} ${addr.city} ${addr.state} ${addr.town} ${addr.village == null ? "" : addr.village} ${addr.street}`;
            }
        }
    }
</script>

