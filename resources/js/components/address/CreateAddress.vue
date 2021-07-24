<template>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputProvinceName" class="form-label">省</label>
                <input class="form-control" id="inputProvinceName" type="text" list="provincesList" v-model="province" >
                <datalist id="provincesList">
                    <option v-for="province in this.provinces" :key="province.code" :value=province.name />
                </datalist>
                <div class="invalid-feedback d-inline-block" v-if="errors.province!= null" >
                    <div v-for="err in errors.province" v-bind:key=err.id>
                        <div>{{ err }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputCityName">市</label>
                <input class="form-control" id="inputCityName" type="text" list="citiesList" v-model="city" >
                <datalist id="citiesList">
                    <option v-for="city in this.cities" :key="city.code" :value=city.name />
                </datalist>
                <div class="invalid-feedback d-inline-block" v-if="errors.city!= null">
                    <div v-for="err in errors.city" :key=err.id>
                        <div>{{ err }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputStateName" class="form-label">县/区</label>
                <input class="form-control" id="inputStateName" type="text" list="statesList" v-model="state" >
                <datalist id="statesList">
                    <option v-for="state in this.states" :key="state.code" :value=state.name />
                </datalist>
                <div class="invalid-feedback d-inline-block" v-if="errors.state != null" >
                    <div v-for="err in errors.state" v-bind:key=err.id>
                        <div>{{ err }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="input" class="form-label">镇</label>
                <input class="form-control" id="inputTownName" type="text" list="townsList" v-model="town" >
                <datalist id="townsList">
                    <option v-for="town in this.towns" :key="town.code" :value=town.name />
                </datalist>
                <div class="invalid-feedback d-inline-block" v-if="errors.town!= null" >
                    <div v-for="err in errors.town" v-bind:key=err.id>
                        <div>{{ err }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="input" class="form-label">村</label>
                <input class="form-control" id="inputVillageName" type="text" list="villagesList" v-model="village">
                <datalist id="villagesList">
                    <option v-for="village in this.villages" :key="village.code" :value=village.name />
                </datalist>
                <div class="invalid-feedback d-inline-block" v-if="errors.village != null" >
                    <div v-for="err in errors.village " v-bind:key=err.id>
                        <div>{{ err }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputStreetName">街道、门牌号</label>
                <input class="form-control" id="inputStreetName" type="text" v-model="street">
                <div class="invalid-feedback d-inline-block" v-if="errors.street != null">
                    <div v-for="err in errors.street " :key=err.id>
                        <div>{{ err }}</div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        prop: [
            'addr_fields'
        ],
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
                province:'',
                city:'',
                state:'',
                town:'',
                village:'',
                street:'',
                //-address data-
                provinces: [],
                cities: [],
                states: [],
                towns: [],
                villages: [],
                params: {},
                //-end-

                base_uri: '/api/addresses',
            }
        },
        mounted() {
            this.loadProvinces();
        },
        watch: {
            // fields: () => {
            //     this.province = this.fields.province;
            //     this.city = this.fields.city;
            //     this.state = this.fields.state;
            //     this.town = this.fields.town;
            //     this.village = this.fields.village;
            //     this.street = this.fields.street;
            // },
            province: function () {
                this.find_address(this.province, this.provinces)
                .then( resp => { this.cities = resp.data } )
                .catch( err => {
                   this.errors = err.response.data.errors; 
                });
            },
            city: function () {
                this.find_address(this.city, this.cities)
                .then( resp => { this.states = resp.data } )
                .catch( err => {
                   this.errors = err.response.data.errors; 
                });
            },
            state: function () {
                this.find_address(this.state, this.states)
                .then( resp => { this.towns = resp.data } )
                .catch( err => {
                   this.errors = err.response.data.errors; 
                });
            },
            town: function () {
                this.find_address(this.town, this.towns)
                .then( resp => { this.villages = resp.data } )
                .catch( err => {
                   this.errors = err.response.data.errors; 
                });
            },
        },
        methods: {
            get_fields: function () {
                return {
                    'province': this.province,
                    'city': this.city,
                    'state': this.state,
                    'town': this.town,
                    'village': this.village,
                    'street': this.street,
                };
            },
            loadFieldsErrs: function (err) {
                this.errors = err.response.data.errors; 
            },
            closeModal: function () {
                this.fields = {};
                this.onEdition= false;
            } ,
            loadFields: function (address) {
                if (client.id != null) {
                    this.province = address.province;
                    this.city = address.city;
                    this.state = address.state;
                    this.town = address.town;
                    this.village = address.village;
                    this.street = address.street;
                    this.onEdition = true;
                }
                else {
                    this.fields = null;
                    this.onEdition = false;
                }
            },
            loadProvinces: function () {
                this.find_address()
                .then( resp => { this.provinces = resp.data } )
                .catch( err => {
                   this.errors = err.response.data.errors; 
                });
            },
            onCreate: async function () {
                await axios.post(this.base_uri, this.fields, this.headers).then(response => {
                    this.fields = {};
                    window.location.reload();
                }).catch(err => {
                    this.errors = err.response.data.errors;
                    console.log(this.errors);
                });
            },
            find_address: function (text, addresses) {
                var params = {}; 
                // get address code and level as params 
                // searching whole list by address name
                if (text != null && addresses != null) {
                    for (var i=0; i<addresses.length; i++) {
                        if ( addresses[i].name == text ) {
                            params.pcode = addresses[i].code;
                            params.level = addresses[i].level;
                        }
                    }
                }
                const request = axios.get("/api/find_address", { params: params }, this.headers);
                return request;
            },
        }
    }
</script>