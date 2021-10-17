<template>
  <Menu v-if="checkConnected"/>
  <router-view/>
</template>
<script>
// @ is an alias to /src


import Menu from "@/components/Menu/Menu";
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

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
  color: #2c3e50;
}

.child {
  margin: 0 auto;
  text-align: center;
}


</style>
