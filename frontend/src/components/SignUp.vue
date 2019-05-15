<template>
    <div class="col-md-4 offset-4">
        <div class="alert alert-danger" role="alert" v-if="errorMessage">
            {{ errorMessage}}
        </div>
        <form>
            <div class="form-group">
                <input type="email" class="form-control" id="emailId" aria-describedby="emailHelp" v-model="email" placeholder="Enter email" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="passwordId" placeholder="Password" v-model="password" />
            </div>

            <button class="btn btn-primary" @click.prevent="signUp">Submit</button>
        </form>
    </div>
</template>

<script>
    import { http } from '../config/index.js';

    export default {
        data () {
            return {
                email: '',
                password: '',
                errorMessage: ''
            }
        },

        methods: {
            async signUp () {
                try {
                    let response = await http('post', `signup`, {
                        "email" : this.email,
                        "password": this.password
                    });

                    this.$store.commit('SET_MESSAGE', response.data)

                    this.$router.push({name: 'signin'})

                } catch (error) {
                    this.$store.commit('SET_MESSAGE', error.response.data)
                }
            }
        }
    }
</script>