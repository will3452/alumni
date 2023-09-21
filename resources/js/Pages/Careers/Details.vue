<template>
    <div class="row">
        <div class="col-md-6">
            <Card title="Career Details">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                        <h6 class="mb-3 text-sm">
                            {{ career.course }}
                        </h6>
                        <span class="mb-2 text-xs">Description: <span class="text-dark font-weight-bold ms-sm-2"> {{
                            career.description }}</span></span>
                        <span class="mb-2 text-xs">Created Date: <span class="text-dark font-weight-bold ms-sm-2"> {{
                            career.created_at }}</span></span>
                    </div>
                    <div class="ms-auto text-end">
                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                class="material-icons text-sm me-2">edit</i>Edit</a>
                    </div>
                </li>
            </Card>
        </div>
        <div class="col-md-6">

            <Card title="Paths">
                <form class="form" @submit.prevent="addItem">
                    <div class=" mt-2 text-danger" style="font-size:10px; " v-for="error, index in form.errors"
                        :key="index">
                        {{ error }}
                    </div>

                    <form-item label="Title">
                        <input type="text" class="form-control" v-model="form.title" />
                    </form-item>
                    <form-item label="Description">
                        <input type="text" class="form-control" v-model="form.description" />
                    </form-item>
                    <form-item label="Level">
                        <input type="number" class="form-control" v-model="form.level" />
                    </form-item>
                    <button class="btn btn-success w-full" :disabled="form.proccessing">
                        ADD NEW PATH
                    </button>
                </form>
            </Card>
        </div>
        <div class="col-md-12">
            <Card title="List of path">

                <table class="table align-items-center my-3">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TITLE</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESCRIPTION</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">LEVEL</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in career.items" :key="item.id">
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ item.title }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ item.description }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ item.level }}</p>
                            </td>
                            <td class="align-middle">
                                <Link :href="'/careers/item/' + item.id" method="POST" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                    data-original-title="Edit user">
                                    Remove
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Card>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'career',
    ],
    methods: {
        addItem() {
            this.form.post('/careers/item', {
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.success('Item has been added!');
                    this.form.reset();
                },
                onError: () => {
                    for(let error in this.form.errors) {
                        this.$toast.error(this.form.errors[error]);
                    }
                    // this.form.reset();
                },
            })
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                career_id: this.career.id,
                description: '',
                title: '',
                level: 1,
            })
        }
    }
}
</script>
