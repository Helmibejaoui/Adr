<template>
  <div>
    <h1>LOGIN</h1>
    <form @submit.prevent="handleLogin">
      <input v-model="user.username" placeholder="username"/>
      <br/>
      <br/>
      <input v-model="user.password" placeholder="password" type="password"/>
      <br/>
      <br/>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>


export default {
  name: "Login",
  data: () => {
    return {
      user: {
        username: "",
        password: "",
      }

    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  created() {
    if (this.loggedIn) {
      this.$router.push("/");
    }
  },
  methods: {
    handleLogin() {
      this.loading = true;

      this.$store.dispatch("auth/login", this.user).then(
          () => {
            this.$router.push("/");
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
  }
}
</script>

<style scoped>

</style>