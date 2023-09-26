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
                {{$page.props.user.type}} | {{ $page.props.user.email }}
              </p>
              <p class="mb-0 font-weight-normal text-sm">
                Date Joined: {{$page.props.user.created_at}}
              </p>
            </div>
          </div>
        </div>
        <div  v-if="objectives.length">
            <div class="row">
                <div class="col-md-12">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3"
                            v-for="item in objectives[0].career.items.sort((a, b) => a.id < b.id)"
                            :key="item.id">
                            <span class="timeline-step">
                                <i class="material-icons text-success text-gradient">{{ $page.props.user.done_items.findIndex((e) => e.id == item.id) == -1 ? 'lock': 'check' }}</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark  font-weight-bold mb-0 d-flex "
                                    style="justify-content: space-between; align-items: center;">
                                    <span>{{ item.title }}</span>
                                    <Link v-if="$page.props.user.done_items.findIndex((e) => e.id == item.id) == -1" class="btn btn-primary " method="POST" href="/mark-as-done" :data="{item_id: item.id}" preserve-scroll>
                                        <i class="material-icons">star</i> UNLOCK
                                    </Link>
                                    <div v-else style="color:#aaa;">
                                        DONE
                                    </div>
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    {{ item.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>


    </div>
</template>

<script>
export default {
    props: [
        'objectives'
    ]
}
</script>
