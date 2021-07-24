<template>
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" ref="closeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Wines</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="create_wine">
                    <form id="create-wine" v-on:submit.prevent="onSubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputWineName">Name of Wine</label>
                                <input class="form-control" id="inputWineName" type="text" v-model="fields.name">
                                <div class="invalid-feedback d-inline-block" v-if="errors.name != null">
                                    <div v-for="err in errors.name" :key="err.id">
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputGrapeType">Type of Grapes</label>
                                <input class="form-control" id="inputGrapeType" type="text" v-model="fields.grape">
                                <div class="invalid-feedback d-inline-block" v-if="errors.grape != null">
                                    <div v-for="err in errors.grape" :key="err.id">
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputBrand">Brand</label>
                                <input class="form-control" id="inputBrand" type="text" v-model="fields.brand">
                                <div class="invalid-feedback d-inline-block" v-if="errors.brand != null">
                                    <div v-for="err in errors.brand" :key="err.id">
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputYear">Year</label>
                                <input class="form-control" id="inputYear" type="number" v-model="fields.year">
                                <div class="invalid-feedback d-inline-block" v-if="errors.year != null">
                                    <div v-for="err in errors.year" :key="err.id">
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">

                                <label for="inputPrice">Selling Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" id="inputPrice" type="number" v-model="fields.price">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback d-inline-block" v-if="errors.price != null">
                                        <div v-for="err in errors.price" :key="err.id">
                                            <div>{{ err }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">

                                <label for="inputSellingPrice">Stock Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" id="inputSellingPrice" type="number" v-model="fields.stock_price">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <div class="invalid-feedback d-inline-block" v-if="errors.selling_price != null">
                                        <div v-for="err in errors.price" :key="err.id">
                                            <div>{{ err }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputVolume">Volume</label>
                                    <div class="input-group">
                                    <input class="form-control" id="inputVolume" type="number" v-model="fields.size">
                                    <div class="input-group-append">
                                        <span class="input-group-text">ml</span>
                                    </div>
                                    <div class="invalid-feedback d-inline-block" v-if="errors.size != null">
                                        <div v-for="err in errors.size" :key="err.id">
                                            <div>{{ err }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-10">
                                <label for="inputCap">Type of Cap</label>
                            </div>
                            <br />
                            <div class="form-group col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" id="inputCap" name="inputCap" type="radio" v-model="fields.cap" value="screw">
                                    <label class="form-check-label" for="inputCap">
                                        screw
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" id="inputCap" name="inputCap" type="radio" v-model="fields.cap" value="wooden">
                                    <label class="form-check-label" for="inputCap">
                                        Wooden
                                    </label>
                                </div>
                            </div>
                            <div class="invalid-feedback d-inline-block" v-if="errors.cap != null">
                                <div v-for="err in errors.cap" :key="err.id">
                                    <div>{{ err }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="stock">Stock</label>
                                    <input class="form-control" id="stock" type="number" v-model="fields.stock">
                                    <div class="invalid-feedback d-inline-block" v-if="errors.stock != null">
                                        <div v-for="err in errors.stock" :key="err.id">
                                            <div>{{ err }}</div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" id="gridCheck1" type="checkbox" v-model="fields.rewarded">
                                    <label class="form-check-label" for="gridCheck1">
                                        Rewarded
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
                base_uri: '/api/wines',
            }
        },
        mounted() {
            this.$root.$on("loadFields", (wine) => {
                return this.loadFields(wine);
            });
            $(this.$refs.closeModal).on("hidden.bs.modal", this.closeModal); // set the fields to blank when close the modal
        },
        methods: {
            closeModal: function () {
                this.fields = {};
                this.onEdition= false;
            } ,
            loadFields: function (wine) {
                if (wine.id != null) {
                    this.fields = wine;
                    this.onEdition = true;
                }
                else {
                    this.fields = null;
                    this.onEdition = false;
                }
            },

            // to create a wine
            onCreate: async function () {
                await axios.post(this.base_uri, this.fields, this.headers).then(response => {
                    this.fields = {};
                    window.location.reload();
                }).catch(err => {
                    this.errors = err.response.data.errors;
                    console.log(this.errors);
                });
            },

            // to update a single wine
            onUpdate: async function () {
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
                    this.errors = err.response.data.errors;
                    console.log(this.errors);
                });
            }
        }
    }
</script>
