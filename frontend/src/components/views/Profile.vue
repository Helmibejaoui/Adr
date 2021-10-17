<template>
  <div class="col-md-8 mx-auto">
    <div class="card card-container p-3">
      <div class="form-group">
        <label for="username" class="col-form-label">Username</label>
        <input id="username" name="username" type="text" class="form-control" v-model="user.username"/>
      </div>
      <div class="form-group">
        <label for="firstname">Firstname</label>
        <input id="firstname" name="firstname" type="text" class="form-control" v-model="user.firstname"/>
      </div>
      <div class="form-group">
        <label for="lastname">Lastname</label>
        <input id="lastname" name="lastname" type="text" class="form-control" v-model="user.lastname"/>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="text" class="form-control" v-model="user.email"/>
      </div>
      <div class="form-group d-flex justify-content-center">
        <button class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>
</template>
<script>
// @ is an alias to /src
import AuthService from "@/service/auth/auth.service";

export default {
  name: 'Profile',
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