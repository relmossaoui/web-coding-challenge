<template>
    <div class="shop-container">
        <div v-for="shop in shops" class="card shop-card" :key="shop.id">
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

    const INVALID_TOKEN = 1;

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

                if (response.status) {
                    this.shops = response.data.shops
                } else {
                    if (response.data.type == INVALID_TOKEN) {
                        this.$store.dispatch('logout')
                    } else {
                        this.$store.commit('SET_MESSAGE', response.data)
                    }
                }

            } catch (error) {
                this.$store.commit('SET_MESSAGE')
            }
        },

        methods: {
            async likeShop(shop) {
                try {
                    let response = await http('post', `shops/like?token=${localStorage.getItem('token')}`, {
                        "shopId" : shop.id
                    });

                    if (response.status) {
                        this.$store.commit('SET_MESSAGE', response.data)

                        this.shops.splice(this.shops.indexOf(shop), 1)
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