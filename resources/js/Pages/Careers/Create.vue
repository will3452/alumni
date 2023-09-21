<template>
    <div>
        <Card title="Careers">

            <form class="form" @submit.prevent="save">
                <div class=" mt-2 text-danger" style="font-size:10px; " v-for="error, index in form.errors" :key="index">
                    {{ error }}
                </div>

               <form-item label="Course">
                    <input type="text" class="form-control" v-model="form.course" />
               </form-item>
               <form-item label="Description">
                    <input type="text" class="form-control" v-model="form.description" />
               </form-item>
                <button class="btn btn-success w-full" :disabled="form.proccessing">
                    SUBMIT
                </button>
            </form>
        </Card>
    </div>
</template>


<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                description: '',
                course: '',
            })
        }
    },
    methods: {
        save() {
            this.form.post('/careers', {
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.success('Career has been created!');
                    // this.form.reset();
                },
                onError: () => {
                    for(let error in this.form.errors) {
                        this.$toast.error(this.form.errors[error]);
                    }
                    // this.form.reset();
                },
            })
        }
    }
}
</script>
