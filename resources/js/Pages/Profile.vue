<template>
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="/user.png" alt="profile_image" class="w-100">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$page.props.user.name}}
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                {{$page.props.user.type}} | {{ $page.props.user.email }} {{ $page.props.user.course ? '| ' +$page.props.user.course : ''}} {{ $page.props.user.school_year ? '| ' +$page.props.user.school_year : ''}}
              </p>
              <p class="mb-0 font-weight-normal text-sm">
                Date Joined: {{$page.props.user.created_at}}
              </p>

        </div>
        <div>
            <h6>Change password</h6>
            <input type="password" v-model="form.password" name="" placeholder="Enter new password" id=""> <Link class="btn btn-primary btn-sm" href="/update-password" :data="{password: form.password}" method="POST">UPDATE</Link>
        </div>
            </div>
          </div>
          <br>
      </div>


    </div>
</template>

<script>
export default {
    props: [
        'objectives'
    ],
    data () {
        return {
            form: this.$inertia.form({
                password: '',
            })
        }
    }
}
</script>
