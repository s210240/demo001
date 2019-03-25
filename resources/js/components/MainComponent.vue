<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tomagochi</div>
                    <div class="card-body">
                        <select v-model="selected">
                            <option selected v-bind:value="{ name: 'dog' }">Dog</option>
                            <option v-bind:value="{ name: 'cat' }">Cat</option>
                            <option v-bind:value="{ name: 'raccoon' }">Raccoon</option>
                            <option v-bind:value="{ name: 'penguin' }">Penguin</option>
                        </select>
                        <p></p>
                        <button class="btn btn-primary" v-on:click="addPet(1)">Add pet</button>
                        <p></p>
                        <h4>List pets</h4>
                        <table id="firstTable" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Hunger</th>
                                <th>Sleep</th>
                                <th>Care</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in items">

                                <td>{{item.id}}</td>
                                <td>{{item.pet_type}}</td>
                                <td>
                                    <button class="btn btn-primary" v-on:click="updatePet(item.id, 1)">{{item.hunger}}
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-primary" v-on:click="updatePet(item.id, 2)"> {{item.sleep}}
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-primary" v-on:click="updatePet(item.id, 3)">{{item.care}}
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainComponent",

        data: function () {
            return {
                selected: {name: 'dog'},
                items: null
            }
        },
        mounted() {
            Echo.private(`pets.1`)
                .listen('.server.created', (e) => {
                    this.items = JSON.parse(e.data);
                });

            axios.get('list_pets')
                .then(resp => (this.items = resp.data))
                .catch(function (resp) {
                    console.log(resp);
                });

            console.log(this.items);
        },
        methods: {
            addPet() {
                console.log(this.selected.name);
                let pet = this.selected.name;
                axios.post('add_pet', {
                    pet: pet
                })
                    .then(function (resp) {
                        console.log(resp);
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });

                axios.get('list_pets')
                    .then(resp => (this.items = resp.data))
                    .catch(function (resp) {
                        console.log(resp);
                    });
            },
            updatePet(id_pet, pet_action) {
                axios.post('update_pet', {
                    id_pet: id_pet,
                    pet_action: pet_action
                })
                    .then(function (resp) {
                        console.log(resp);
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
