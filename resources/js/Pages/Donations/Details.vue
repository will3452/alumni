<template>
    <Card title="Donation Details">
        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="d-flex flex-column">
                <h6 class="mb-3 text-sm">
                    <span >
                        {{ donation.reference_no }}
                    </span>
                </h6>
                <span class="mb-2 text-xs">Description: <span class="text-dark font-weight-bold ms-sm-2" v-if="!edit"> {{ donation.description }}</span> <input type="text" v-model="donation.description" v-else></span>
                <span class="mb-2 text-xs">Amount: <span
                        class="text-dark ms-sm-2 font-weight-bold" v-if="!edit">{{ donation.amount }}</span> <input type="number" v-model="donation.amount" v-else></span>
                <span class="text-xs mb-2">Donator: <span class="text-dark ms-sm-2 font-weight-bold">{{donation.user.name}}</span> </span>
                <span class="text-xs mb-2">Proof Of Payment: <a class="text-dark ms-sm-2 font-weight-bold" :href="donation.pop">Click here to view image. </a> </span>

                <span class="mb-2 text-xs">Mode of payment: <span
                        class="text-dark ms-sm-2 font-weight-bold">{{ donation.mop }}</span></span>
            </div>
            <div class="ms-auto text-end" v-if="['Administrator', 'Coordinator'].includes($page.props.user.type) || donation.user_id == $page.props.user.id">
                <span class="badge badge-sm" :class="{'bg-gradient-secondary': donation.status != 'APPROVED', 'bg-gradient-success': donation.status == 'APPROVED'}" v-text="donation.status"></span>
                <a @click="edit = true" v-if="!edit" class="btn btn-link text-dark px-3 mb-0" href="javascript:;" ><i
                        class="material-icons text-sm me-2">edit</i>Edit</a>
                    <a v-else @click="save" class="btn btn-link text-dark px-3 mb-0" href="javascript:;" ><i
                        class="material-icons text-sm me-2">save</i>Save</a>
            </div>
        </li>
</Card></template>
<script>
    export default {
        props: [
            'donation',
        ],
        data () {
            return {
                edit: false,
            }
        },
        methods: {
            save() {
                this.edit = false;
                this.$inertia.put('/donations/' + this.donation.id, { ... this.donation}, {
                    onSuccess: () => {
                        this.$toast.success('Success!');
                    }
                })
            }
        }
    }
</script>
