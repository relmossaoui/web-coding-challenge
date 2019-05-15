<template>
    <div class="col-md-4 offset-4">
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
                password: ''
            }
        },

        methods: {
            async signUp () {
                try {
                    let response = await http('post', `signup`, {
                        "email" : this.email,
                        "password": this.password
                    });

                    if (response.data.status) {
                        this.$store.commit('SET_MESSAGE', response.data)

                        this.$router.push({name: 'signin'})
                    } else {
                        this.$store.commit('SET_MESSAGE', response.data)
                    }
                } catch (error) {
                    this.$store.commit('SET_MESSAGE')
                }
            }
        }
    }
</script>