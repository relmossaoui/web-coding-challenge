<template>
    <div class="shop-container">
        <div v-for="shop in shops" class="card shop-card">
            <h4> {{ shop.name }} </h4>
            <img class="card-img-top shop-image" :src="shop.image_url" alt="Shop image">
            <div class="card-body shop-links">
                <a href="#" class="btn btn-success btn-sm"  @click.prevent="likeShop(shop)">Like</a>
                <a href="#" class="btn btn-danger">Dislike</a>
            </div>
        </div>
    </div>
</template>

<script>
    import {API_ENDPOINT_BASE} from '../config/index.js';

    export default {
        data () {
            return {
                shops: [],
                errorMessage: null
            }
        },
        async created() {
            try {
                let response = await this.$http.post(`${API_ENDPOINT_BASE}shops?token=${localStorage.getItem('token')}`,
                    {
                        headers : {
                            'Content-type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

                this.shops = response.data.shops

            } catch (error) {
                if (error.response.data.type == 1) {
                    this.$store.dispatch('logout', {"vm": this})
                }
            }
        },

        methods: {
            async likeShop(shop) {
                try {
                    let response = await this.$http.post(`${API_ENDPOINT_BASE}shops/like?token=${localStorage.getItem('token')}`,
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

                    this.shops.splice(this.shops.indexOf(shop), 1)

                } catch (error) {
                    this.errorMessage = error.response.data.message
                }
            }
        }
    }
</script>