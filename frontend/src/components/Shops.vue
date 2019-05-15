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
    import { http } from '../config/index.js';

    export default {
        data () {
            return {
                shops: [],
                errorMessage: null
            }
        },

        async created() {
            try {
                let response = await http('get', `shops?token=${localStorage.getItem('token')}`);

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
                    await http('post', `shops/like?token=${localStorage.getItem('token')}`, {
                        "shopId" : shop.id
                    });

                    this.shops.splice(this.shops.indexOf(shop), 1)

                } catch (error) {
                    this.errorMessage = error.response.data.message
                }
            }
        }
    }
</script>