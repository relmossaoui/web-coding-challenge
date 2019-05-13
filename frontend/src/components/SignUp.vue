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
    import {API_ENDPOINT_BASE} from '../config/index.js';

    export default {
        data () {
            return {
                email: '',
                password: '',
                errorMessage: ''
            }
        },

        methods: {
            async signIn () {
                try {
                    let response = await this.$http.post(`${API_ENDPOINT_BASE}signup`,
                        {
                            "email" : this.email,
                            "password": this.password
                        },
                        {
                            headers : {
                                'Content-type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );


                    //TO DO : redirect signIn page


                } catch (error) {
                    this.errorMessage = error.response.data.message
                }
            }
        }
    }
</script>