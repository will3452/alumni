<template>
    <div>
        <Card title="Donations" create-link="/donations/create">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">REFERENCE</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DONATOR</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">USER TYPE
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATE
                            </th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="donation in donations.data" :key="donation.id">
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ donation.reference_no }}</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <i class="material-icons opacity-10  me-3 border-radius-lg">person</i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ donation.user.name }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ donation.user.email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ donation.user.type }}</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm"
                                    :class="{ 'bg-gradient-secondary': donation.status != 'APPROVED', 'bg-gradient-success': donation.status == 'APPROVED' }"
                                    v-text="donation.status"></span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ donation.created_at.split('T')[0]
                                }}</span>
                            </td>
                            <td class="align-middle">
                                <Link :href="'/donations/' + donation.id" class="btn btn-primary"
                                    data-toggle="tooltip" data-original-title="Edit user">
                                VIEW
                                </Link>
                                <Link class="btn btn-success" v-if="['Administrator', 'Coordinator'].includes($page.props.user.type)" :href="'donations/' + donation.id" :data="{status: 'APPROVED'}" method="put">
                                    <i class="material-icons opacity-10">done</i>
                                </Link>
                                <Link class="btn btn-danger" v-if="['Administrator', 'Coordinator'].includes($page.props.user.type)" :href="'donations/' + donation.id" :data="{status: 'REJECTED'}" method="put">
                                    <i class="material-icons opacity-10">close</i>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul class="pagination">
                    <li v-for="link, index in donations.links" :key="index">
                        <Link class="page-link " :class="{ 'active': link.active, 'disabled': link.url == null }"
                            :href="`${link.url}`" v-html="link.label">
                        </Link>
                    </li>
                </ul>
            </div>
        </Card>
</div></template>

<script>
export default {
    props: ['donations'],
}
</script>
