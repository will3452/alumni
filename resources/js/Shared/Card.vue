<template>
    <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-2">
                    <h6 class="text-white text-capitalize ps-3">{{ title }}</h6>
                    <Link class="btn btn-success" v-if="createLink" :href="createLink">
                        <i class="material-icons opacity-10">edit</i>
                        CREATE
                    </Link>
                </div>
            </div>
            <div class="card-body  pb-2">
              <slot/>
            </div>
    </div>
</template>

<script>
export default {
    props: ['title', 'createLink'],
    data () {
        return {

        }
    }
}
</script>
