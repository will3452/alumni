<template>
    <div class="card">
        <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Messages</th>

                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATE
                            </th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="not in notifications" :key="not.id">
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ not.data['message'] }}</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ not.created_at.split('T')[0]
                                }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
    </div>
</template>


<script>
export default {
    props: ['notifications'],
    data () {
        return {
            data: [],
        }
    }
}
</script>