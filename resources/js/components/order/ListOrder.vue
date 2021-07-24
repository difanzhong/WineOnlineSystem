<template>
<div>
    <div class="container"> 
        <div class="row">
            <!-- Button to Trigger modal for adding new item -->
            <button class="btn btn-primary mb-3 mr-5" data-toggle="modal" data-target="#OrderModal">
                    New Order
            </button>
            <!-- Button -->
            <div id="total-profit" class="mb-3">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">TOTAL PROFIT</li>
                    <li class="list-group-item">{{ this.total_profit }}</li>
                    <li class="list-group-item">VIRTUAL TOTAL</li>
                    <li class="list-group-item">{{ this.virtual_total_profit }}</li>
                </ul>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th class="first">Order ID</th>
                <th class="first">Client</th>
                <th class="first">Product</th>
                <th class="first">Quantity (box)</th>
                <th class="last">Selling Price</th>
                <th class="last">Profit</th>
                <th class="last">PAID</th>
                <th class="last">Time</th>
            </tr>
        </thead>
        <tbody>
            <tr data-toggle="modal" data-placement="bottom" v-for="order in orders" :key="order.id" data-target="#OrderModal" v-on:click="loadUpdateModal(order)">
                <td data-label="Order ID" class="first">{{ order.id}}</td>
                <td data-label="Client" class="first">{{ order.client.name}}</td>
                <td data-label="Product" class="first">{{ order.wine.name}}</td>
                <td data-label="Quantity" class="first">
                    {{ parseInt( order.quantity / 6 ) }} {{ order.quantity % 6 == 0 ? "" : ` ( ${order.quantity % 6} bottles )`}}
                </td>
                <td data-label="Selling Price" class="last">{{ order.price }}</td>
                <td data-label="Profit" class="last">{{ order.profit }}</td>
                <td data-label="PAID" class="last">{{ order.paid ? "Yes" : "No" }}</td>
                <td data-label="Time" class="last">{{ order.time }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
    export default {
        data() {
            return {
                orders : [],
                total_profit: 0,
                virtual_total_profit: 0 
            }
        },
        created() {
            this.loadOrders();
        },
        methods: {
            loadUpdateModal: function (e) {
                this.$root.$emit("loadOrderFields", e);
            },
            loadOrders: function() {
                axios.get('/api/orders/')
                    .then((response) => {
                        this.orders = response.data.data;
                        this.calculate_total();
                    }).catch( function(err) {
                        console.log(err);
                });
            },
            calculate_total: function () {
                let total_profit = 0, virtual_total_profit = 0;
                if (this.orders.length != 0) {
                    for (var i=0; i<this.orders.length; i++) {
                        if (this.orders[i].paid) {
                            total_profit += parseFloat(this.orders[i].profit);
                        }
                        virtual_total_profit += parseFloat(this.orders[i].profit);
                    }
                }
                this.total_profit = total_profit;
                this.virtual_total_profit = virtual_total_profit;
            }
        }
    }
</script>