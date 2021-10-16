<template>
  <router-view/>
  <Menu v-if="checkConnected"/>
</template>
<script>
// @ is an alias to /src


import Menu from "@/components/Menu/Menu";

export default {
  name: 'App',
  components: {Menu},
  computed: {
    checkConnected() {
      return this.$store.state.auth.token;
    }
  },
  mounted() {
    if (!this.checkConnected) {
      this.$router.push('/login');
    }
  }
}
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}


</style>
