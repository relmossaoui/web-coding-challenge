<template>
    <keep-alive>
        <div class="shop-container">
            <div v-for="shop in preferredShops" class="card shop-card" :key="shop.id">
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
    import { http } from '../config/index.js';

    export default {
        data () {
            return {
                preferredShops: []
            }
        },
        async created() {
            try {
                let response = await http('get', `shops/preferred?token=${localStorage.getItem('token')}`);

                if (response.status) {
                    this.preferredShops = response.data.shops
                } else {
                    if (response.data.type == 1) {
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
            async removeShop(shop) {
                try {
                    let response = await http('post', `shops/remove?token=${localStorage.getItem('token')}`, {
                        "shopId" : shop.id
                    });

                    if (response.status) {
                        this.preferredShops.splice(this.preferredShops.indexOf(shop), 1)

                        this.$store.commit('SET_MESSAGE', response.data)

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