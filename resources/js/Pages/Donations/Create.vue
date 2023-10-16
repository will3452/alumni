<template>
    <div>
        <Card title="Donations">

            <form action="" class="form" @submit.prevent="save">
                <div class=" mt-2 text-danger" style="font-size:10px; " v-for="error, index in form.errors" :key="index">
                    {{ error }}
                </div>
               <form-item label="Description">
                    <input type="text" class="form-control" v-model="form.description" />
               </form-item>
                <label for="" class="form-label text-xs text-primary">Mode of payment</label>
                  <div class="input-group input-group-outline mb-3">
                    <select name="mop" id="" class="form-select form-control" v-model="form.mop">
                        <option value="Over-the-Counter">Over-the-Counter</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>
                 <form-item label="Reference No.">
                    <input type="text" class="form-control" v-model="form.reference_no" />
                </form-item>
                <form-item label="Proof of Payment">
                    <input type="file" class="form-control" @input="form.pop = $event.target.files[0]" />
                </form-item>
                <form-item label="Amount (PHP)">
                    <input type="number" class="form-control" v-model="form.amount" />
                </form-item>
                <div class="alert">
                    Your donation must be approved by the coordinator before it becomes public.
                </div>
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
                mop: '',
                pop: '',
                reference_no: '',
                amount: 0,
            })
        }
    },
    methods: {
        save() {
            this.form.post('/donations', {
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.success('Donation has been submitted!');
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
