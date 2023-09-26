<template>
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <!-- <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;"> -->
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('/register.png'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">REGISTER</h4>
                  <p class="mb-0">Enter your details.</p>
                </div>
                <div class="text-center mt-2 text-danger" style="font-size:10px; " v-for="error, index in form.errors" :key="index">
                    {{ error }}
                </div>
                <div class="card-body">
                  <form role="form">
                    <div class="input-group input-group-outline mb-3">
                      <select name="type" id="" class="form-select form-control" v-model="form.type">
                        <option value="Alumni">Alumni</option>
                        <option value="Student">Student</option>
                      </select>
                    </div>
                    <label class="form-label">Name</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" v-model="form.name" class="form-control" :class="{'is-invalid': form.errors.name}" >
                    </div>
                    <label class="form-label">Email</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="email"  v-model="form.email" class="form-control" :class="{'is-invalid': form.errors.email}">
                    </div>
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" v-model="form.password" class="form-control" :class="{'is-invalid': form.errors.password}">
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" v-model="agree" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <button @click="register" type="button" :disabled="! agree || form.processing" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">SUBMIT</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <Link href="/login" class="text-primary text-gradient font-weight-bold">LOGIN</Link>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>


<script>
import GuestLayout from '../Shared/GuestLayout.vue'
export default {
    layout: GuestLayout,
    data() {
        return {
            agree: false,
            form: this.$inertia.form({
                name:'',
                email:'',
                password:'',
                type: '',
            }),
        }
    },
    methods: {
        register() {
            this.form.post('/register', {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                    this.$toast.success('Registered Successfully')
                }
            })
        }
    }
}
</script>
