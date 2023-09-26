<template>
    <div>
        <Card title="Careers" create-link="/careers/create">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">COURSE</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="career in careers.data" :key="career.id">
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ career.course }}</p>
                            </td>
                            <td class="align-middle">
                                <Link :href="'/careers/' + career.id" class="text-secondary font-weight-bold text-xs"
                                    data-toggle="tooltip" data-original-title="Edit user">
                                View
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul class="pagination">
                    <li v-for="link, index in careers.links" :key="index">
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
    props: ['careers'],
}
</script>
