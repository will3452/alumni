<template>
    <div class="row">
        <div class="col-md-6">
            DATE FROM
            <input v-model="form.from" type="date" class="p-2 px-4 w-100">
        </div>
        <div class="col-md-6">
            DATE TO
            <input v-model="form.to" type="date" class="p-2 px-4 w-100">
        </div>
        <div class="col-md-6">
            MODEL
            <select name=""v-model="form.model"  id="" class="p-2 px-4 w-100">
                <option value="User">Users</option>
                <option value="Donation">Donations</option>
                <option value="Post">Posts</option>
            </select>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary mt-4" @click="generate">
                Download Report
            </button>

            <vue-excel-xlsx ref="excel"
                v-show="false"
                :data="data"
                :columns="columns"
                :file-name="`${form.from}-${form.to}-${form.model}`"
                :file-type="'xlsx'"
                :sheet-name="'sheetname'"
                >
            </vue-excel-xlsx>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            form: this.$inertia.form({
                from: '',
                to: '',
                model: '',
            }),
            data: [{
                demo: 'william',
            }],
            columns: [{
                label: 'demo',
                field: 'demo',
            }],
        }
    },
    methods: {
         async generate() {
            let response = await window.axios.post('/reports', this.form)
            if (response.data.length) {
                this.columns = Object.keys(response.data[0]).map( e=> ({label: e, field: e}));
                this.data = response.data;
                this.$refs['excel'].exportExcel();
            }
        }
    }
}
</script>
