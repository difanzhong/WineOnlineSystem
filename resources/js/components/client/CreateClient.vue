<template>
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="clientModal" ref="closeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Client</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="create_wine">
                    <form id="create-client" v-on:submit.prevent="onSubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputClientName">Name</label>
                                <input class="form-control" id="inputClientName" type="text" v-model="fields.name">
                                <div class="invalid-feedback d-inline-block" v-if="errors.name != null">
                                    <div v-for="err in errors.name" :key=err.id>
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputWechatName">WeChat</label>
                                <input class="form-control" id="inputWechat" type="text" v-model="fields.wechat">
                                <div class="invalid-feedback d-inline-block" v-if="errors.wechat!= null">
                                    <div v-for="err in errors.wechat" :key=err.id>
                                        <div>{{ err }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- address input form -->
                        <create-address ref="addr"></create-address>
                        <!-- end address input form -->
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
import CreateAddress from '../address/CreateAddress.vue';

export default {
    components: { CreateAddress },
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
            base_uri: '/api/clients',
        }
    },
    created() {
        this.$root.$on("loadClientFields", (client) => {
            this.loadClientFields(client);
            this.$refs.addr.province = client.address.province;
            this.$refs.addr.city = client.address.city;
            this.$refs.addr.state = client.address.state;
            this.$refs.addr.town = client.address.town;
            this.$refs.addr.village = client.address.village;
            this.$refs.addr.street = client.address.street;
        });
        $(this.$refs.closeClientModal).on("hidden.bs.modal", this.closeClientModal); // set the fields to blank when close the modal
    },
    methods: {
        closeClientModal: function () {
            this.fields = {};
            this.onEdition= false;
        } ,
        loadClientFields: function (client) {
            if (client.id != null) {
                this.fields = client;
                this.onEdition = true;
            }
            else {
                this.fields = null;
                this.onEdition = false;
            }
        },

        // to create a client
        onCreate: async function () {
            this.fields = Object.assign({},this.fields,this.$refs.addr.get_fields());
            //console.log(this.fields);
            await axios.post(this.base_uri, this.fields, this.headers).then(response => {
                this.fields = {};
                window.location.reload();
            }).catch(err => {
                this.$refs.addr.loadFieldsErrs(err);
                this.errors = err.response.data.errors;
                console.log(this.errors);
            });
        },

        // to update a single client
        onUpdate: async function () {
            this.fields = Object.assign({},this.fields,this.$refs.addr.get_fields());
            
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