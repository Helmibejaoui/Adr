<template>
  <div id="nav">
    <router-link :to="item.path" v-for="(item,index) in menu" :key="index">{{ item.alias }} |</router-link>

    <button class="btn btn-danger" @click="logout()">Logout</button>
  </div>
</template>

<script>
import AuthService from "@/service/auth/auth.service";

export default {
  name: "Menu",
  data: () => {
    return {
      menu: []
    }
  },
  methods: {
    logout() {
      this.$store.dispatch("auth/logout").then(
          () => {
            this.$router.push("/login");
          },
          (error) => {
            this.loading = false;
            this.message =
                (error.response &&
                    error.response.data &&
                    error.response.data.message) ||
                error.message ||
                error.toString();
          }
      );
    },
    getMenu() {
      AuthService.getMenu().then(
          (response) => {
            this.menu = response.data;
          },
          (error) => {
            this.content =
                (error.response &&
                    error.response.data &&
                    error.response.data.message) ||
                error.message ||
                error.toString();
          });
    }
  },
  mounted() {
    this.getMenu();
  }
}
</script>

<style scoped>
#nav {
  text-align: center;
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