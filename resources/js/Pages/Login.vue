<template>
 <main class="main-content  mt-0">
    <video src="/login.mp4" muted autoplay loop class="video"></video>
    <div class="page-header align-items-start min-vh-100">
      <span class="mask  "></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                </div>
              </div>
              <div class="text-center mt-2 text-danger" style="font-size:10px; " v-for="error, index in form.errors" :key="index">
                {{ error }}
              </div>
              <div class="card-body">
                <form role="form" class="text-start">
                    <label class="form-label">Email</label>
                  <div class="input-group input-group-outline mb-3">
                    <input type="email" class="form-control" v-model="form.email">
                  </div>
                  <label class="form-label">Password</label>
                  <div class="input-group input-group-outline mb-3">

                    <input type="password" class="form-control" v-model="form.password">
                  </div>
                  <div class="text-center">
                    <button type="button" :disabled="form.processing" class="btn bg-gradient-primary w-100 my-4 mb-2" @click="login">LOGIN</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <Link href="/register" class="text-primary text-gradient font-weight-bold">REGISTER</Link>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import GuestLayout from '../Shared/GuestLayout.vue';
export default {
    layout: GuestLayout,
    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: ''
            })
        }
    },
    methods: {
        login () {
            this.form.post('/login', {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset('password')
                },
            })
        }
    }
}
</script>


<style>
.video {
    width: 100vw;
    position: absolute;
    overflow:hidden;
}
</style>
