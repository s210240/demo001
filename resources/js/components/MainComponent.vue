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
                        <p v-for="item in items" :key="item.id">{{ item.pet_type }}</p>
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
                    console.log(e);
                });

            axios.get('list_pets')
                .then(response => (this.items = response.data))
                .catch(function (resp) {
                    console.log(resp);
                });
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
                        alert("Pet already present!");
                    });
            }
        }
    }
</script>

<style scoped>

</style>
