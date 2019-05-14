<template>
    <keep-alive>
        <div class="shop-container">
            <div v-for="shop in preferredShops" class="card shop-card">
                <h4> {{ shop.name }} </h4>
                <img class="card-img-top shop-image" :src="shop.image_url" alt="Shop image">
                <div class="card-body shop-links">
                    <a href="#" class="btn btn-danger" @click.prevent="removeShop(shop)">Remove</a>
                </div>
            </div>
        </div>
    </keep-alive>
</template>

<script>
    import {API_ENDPOINT_BASE} from '../config/index.js';

    export default {
        data () {
            return {
                preferredShops: [],
                errorMessage: null
            }
        },
        async created() {
            try {
                let response = await this.$http.post(`${API_ENDPOINT_BASE}shops/preferred?token=${localStorage.getItem('token')}`,
                    {
                        headers : {
                            'Content-type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

                this.preferredShops = response.data.shops

            } catch (error) {
                if (error.response.data.type == 1) {
                    this.$store.dispatch('logout', {"vm": this})
                }
            }
        },

        methods: {
            async removeShop(shop) {
                try {
                    let response = await this.$http.post(`${API_ENDPOINT_BASE}shops/remove?token=${localStorage.getItem('token')}`,
                        {
                            "shopId" : shop.id
                        },
                        {
                            headers : {
                                'Content-type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );

                    this.preferredShops.splice(this.preferredShops.indexOf(shop), 1)

                } catch (error) {
                    this.errorMessage = error.response.data.message
                }
            }
        }
    }
</script>