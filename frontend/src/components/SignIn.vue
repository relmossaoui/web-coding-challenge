<template>
    <div class="col-md-4 offset-4">
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
        }
    }
</script>