<template>
  <div class="home child">
    <img alt="Vue logo" src="../../assets/logo.png">
    <div>Welcome {{ user.lastname }} {{ user.firstname }}</div>
  </div>
</template>

<script>
// @ is an alias to /src

import AuthService from "../../service/auth/auth.service";

export default {
  name: 'Home',
  data: () => {
    return {
      user: {}
    }
  },
  methods: {
    getCurrentUser() {
      AuthService.getCurrentUser().then(
          (response) => {
            this.user = response.data;
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
    this.getCurrentUser();
  }
}
</script>
