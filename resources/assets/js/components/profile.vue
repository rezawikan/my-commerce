<template>
  <form class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-fn">Name</label>
        <input class="form-control" type="text" id="account-fn" v-model="name" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-email">E-mail Address</label>
        <input class="form-control" type="email" id="account-email" v-model="email" :disabled="true">
      </div>
    </div>
    <!-- <div class="col-md-6">
      <div class="form-group">
        <label for="account-phone">Phone Number</label>
        <input class="form-control" type="number" id="phone-number" v-mask="['###-####-####', '####-####-####']" v-model="phoneNumber" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-phone">Gender</label>
        <select class="form-control" id="gender" v-model="gender">
          <option value="">Choose Gender</option>
          <option value="men">Men</option>
          <option value="women">Women</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-phone">Date Birth</label>
        <input class="form-control" type="date" v-model="dateBirth" required>
      </div>
    </div> -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-pass">New Password</label>
        <input class="form-control" type="password" id="account-pass" autocomplete="off">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-confirm-pass">Confirm Password</label>
        <input class="form-control" type="password" id="account-confirm-pass" autocomplete="off">
      </div>
    </div>
    <div class="col-12">
      <p class="font-italic text-right">Last edited at {{ this.updated_at }}</p>
    </div>
    <div class="col-12">
      <hr class="mt-2 mb-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center">
        <label class="custom-control custom-checkbox d-block">
          <input class="custom-control-input" type="checkbox" checked><span class="custom-control-indicator"></span><span class="custom-control-description">Subscribe me to Newsletter</span>
        </label>
        <button @click.prevent="updateProfile()" class="btn btn-primary margin-right-none" type="button" data-toast data-toast-position="topRight" data-toast-type="success" data-toast-icon="icon-circle-check" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">Update Profile</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data: function() {
    return {
      id : '',
      name: '',
      email: '',
      updated_at: ''
    }
  },
  mounted() {
    this.getProfile();
  },
  methods : {
    getProfile() {
      axios.get('/profile/edit')
        .then( response => {
          this.id = response.data.id;
          this.name = response.data.name;
          this.email = response.data.email;
          this.updated_at = response.data.updated_at;
        })
        .catch(response => console.log('error'));
    },
    updateProfile() {
      axios.put('/profile/'+this.id)
        .then(response => {
          console.log('brhasil melakukan POST');
        })
        .catch(response => console.log('false'));
    }
  }
}
</script>
