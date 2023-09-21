<template>
    <Card title="Donation Details">
        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="d-flex flex-column">
                <h6 class="mb-3 text-sm">
                    {{ donation.reference_no }}
                </h6>
                <span class="mb-2 text-xs">Description: <span class="text-dark font-weight-bold ms-sm-2"> {{ donation.description }}</span></span>
                <span class="mb-2 text-xs">Amount: <span
                        class="text-dark ms-sm-2 font-weight-bold">{{ donation.amount }}</span></span>
                <span class="text-xs mb-2">Donator: <span class="text-dark ms-sm-2 font-weight-bold">{{donation.user.name}}</span></span>
                <span class="mb-2 text-xs">Mode of payment: <span
                        class="text-dark ms-sm-2 font-weight-bold">{{ donation.mop }}</span></span>
            </div>
            <div class="ms-auto text-end">
                <span class="badge badge-sm" :class="{'bg-gradient-secondary': donation.status != 'APPROVED', 'bg-gradient-success': donation.status == 'APPROVED'}" v-text="donation.status"></span>
                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                        class="material-icons text-sm me-2">edit</i>Edit</a>
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

            }
        }
    }
</script>
