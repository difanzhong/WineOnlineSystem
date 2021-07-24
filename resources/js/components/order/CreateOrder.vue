<template>
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="OrderModal" ref="closeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Order</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="create_wine">
                   <form id="create-order" v-on:submit.prevent="onSubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputWine" class="form-label">Wine</label>
                                <select class="form-select form-control" id="inputWine" v-model="fields.wine" @change="onWineSelect()">
                                    <option v-for="wine in this.wines" :key="wine.id" :value="wine" >{{ `${wine.name} (${wine.year})` }}</option>
                                </select>
                                <div class="invalid-feedback d-inline-block" v-if="errors.wine_id != null" >
                                    <div v-for="err in errors.wine_id" v-bind:key=err.id>
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputQuantity">Quantity</label>
                                <div class="input-group">
                                    
                                        <input class="form-control" id="inputQuantity" type="number" v-model="fields.quantity" v-on:keyup="checkStock()">
                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                        <input class="btn-check" type="checkbox" id="box_btn" autocomplete="off"  v-model="fields.box" >
                                        <label class="btn btn-outline-primary" for="box_btn" v-on:click="boxOrBottle()">{{ box_txt }}</label>
                                    </div>
                                    </div>
                                <div class="invalid-feedback d-inline-block" v-if="errors.quantity != null">
                                    <div v-for="err in errors.quantity" :key=err.id>
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                                <div class="invalid-feedback d-inline-block">
                                    <div>{{ stock_warning }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputClientName" class="form-label">Client</label>
                                <select class="form-select form-control" id="inputClient" v-model="fields.client_id">
                                    <option v-for="client in this.clients" :key="client.id" :value="client.id" on>{{ client.name+' '+addr_tostring(client.address) }}</option>
                                </select>
                                <div class="invalid-feedback d-inline-block" v-if="errors.client != null" >
                                    <div v-for="err in errors.client_id" v-bind:key=err.id>
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input" class="form-label">Selling Price</label>
                                <input class="form-control" id="inputPrice" type="number" v-model="fields.price">
                                <div class="invalid-feedback d-inline-block" v-if="errors.price != null" >
                                    <div v-for="err in errors.price" v-bind:key=err.id>
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" id="gridCheck1" type="checkbox" v-model="fields.paid">
                                    <label class="form-check-label" for="gridCheck1">
                                        PAID
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="onCreate" class="btn btn-primary" v-if="!onEdition">Add</button>
                        <button @click.prevent="onUpdate" class="btn btn-primary" v-if="onEdition">Edit</button>
                        <button class="btn btn-danger" v-if="onEdition" v-on:click.prevent="onDelete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            fields: {},
            errors: {},
            onEdition: false,
            headers: {
                headers: {
                    "Content-Type": "application/json",
                    "Accept" : "application/json"
                }
            },
            wines: [],
            wine: {},
            clients: [],
            base_uri: '/api/orders',
            box: true,
            box_txt: 'BOX',
            stock_warning: ''
        }
    },
    mounted() {
        this.loadWines();
        this.loadClients();
        this.$root.$on("loadOrderFields", (order) => {
            return this.loadOrderFields(order);
        });
        $(this.$refs.closeOrderModal).on("hidden.bs.modal", this.closeOrderModal); // set the fields to blank when close the modal
    },
    computed: {
        wine_id() {
            return this.fields.wine_id;
        },
        quantity() {
            return this.fields.quantity;
        }
    },
    watch: {
        wine_id() {
            this.wine = this.wines[this.fields.wine_id-1];
        },
        quantity() {
            this.checkStock();
        }
    },
    methods: {
        closeOrderFields: function () {
            this.fields = {};
            this.onEdition= false;
        } ,
        loadOrderFields: function (order) {
            if (order.id != null) {
                this.fields = order;
                this.onEdition = true;
            }
            else {
                this.fields = null;
                this.onEdition = false;
            }
        },
        boxOrBottle: function () {
            if (this.box) {
                this.box = false;
                this.box_txt = 'BOTTLE';
            }
            else {
                this.box = true;
                this.box_txt = 'BOX';
            }
        },
        checkBoxOrBottle: function () {
            this.box ? this.fields.quantity = parseInt(this.fields.quantity) * 6 : {};
        },
        checkStock: function () {
            var stock = parseInt(this.fields.quantity);
            this.box ? stock *= 6 : stock = stock;
            if (stock > this.wine.stock) {
                this.stock_warning = `only ${this.wine.stock} bottles left  in stock`;
                return false;
            }
            else {
                this.stock_warning = '';
                return true;
            }
                
        },
        onWineSelect: function () {
            this.fields.price = this.fields.wine.price;
            this.fields.wine_id = this.fields.wine.id;
            //this.selected = `${event.taret.value.name} (${event.taret.value.year})`;
        },
        set_wine: function () {
            console.log("hello");
        },
        loadWines: async function () {
            await axios.get('/api/wines', this.fields, this.headers).then(response => {
                console.log(response.data);
                this.wines = response.data.data;
            }).catch(err => {
                this.errors = err.response.data.errors;
                console.log(this.errors);
            }); 
        },
        loadClients: async function () {
            await axios.get('/api/clients', this.fields, this.headers).then(response => {
                console.log(response.data);
                this.clients= response.data.data;
            }).catch(err => {
                this.errors = err.response.data.errors;
                console.log(this.errors);
            }); 
        },
        // to create a client
        onCreate: async function () {
            this.checkBoxOrBottle();
            if (!this.checkStock()) {
                this.box ? this.fields.quantity = parseInt(this.fields.quantity / 6) : {} ;
                return false;
            }
            await axios.post(this.base_uri, this.fields, this.headers).then(response => {
                this.fields = {};
                window.location.reload();
            }).catch(err => {
                
                this.errors = err.response.data.errors;
                console.log(this.errors);
            });
        },

        // to update a single client
        onUpdate: async function () {
            this.checkBoxOrBottle();
            await axios.put(`${this.base_uri}/${this.fields.id}`, this.fields, this.headers).then(response => {
                this.fields = {};
                window.location.reload();
            }).catch(err => {
                this.errors = err.response.data.errors;
                console.log(this.errors);
            });
        },

        // to delete a single wine
        onDelete: async function () {
            await axios.delete(`${this.base_uri}/${this.fields.id}`, this.fields, this.headers).then(response => {
                this.fields = {};
                window.location.reload();
            }).catch(err => {
                this.box ? this.fields.quantity = parseInt(this.fields.quantity / 6) : {} ;
                this.errors = err.response.data.errors;
                console.log(this.errors);
            });
        },

        addr_tostring: function (addr) {
            return `${addr.province} ${addr.city} ${addr.state} ${addr.town} ${addr.village == null ? "" : addr.village} ${addr.street}`;
        }
    }
}
</script>