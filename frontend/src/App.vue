<template>
  <div id="app">
    <div id="nav">
      <template v-if="!isLogged">
        <router-link to="/signup">sign up</router-link> |
        <router-link to="/signin">sign in</router-link>
      </template>
      <template v-else>
        <a href="#" @click.prevent="signOut">sign out</a>
      </template>
    </div>
    <router-view/>
  </div>
</template>

<script>
  export default {
    methods: {
      signOut() {
        this.$store.dispatch('logout', {"vm": this});
      }
    },

    computed: {
      isLogged() {
        return this.$store.state.isLogged
      }
    }
  }
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
