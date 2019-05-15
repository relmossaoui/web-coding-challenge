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

            <button class="btn btn-primary" @click.prevent="signIn">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                email: '',
                password: '',
            }
        },

        methods: {
            async signIn () {
                this.$store.dispatch('login', { "credentials" : {
                    "email" : this.email,
                    "password": this.password
                }})
            }
        },

        computed: {
            errorMessage() {
                return this.$store.state.loginErrorMessage;
            }
        }
    }
</script>