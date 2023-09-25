<template>
    <div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">volunteer_activism</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Donations</p>
                                <h4 class="mb-0">PHP {{ shortNumber((statistic.total_donations)) }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+
                                    {{ statistic.rate_last_week }}% </span>than last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Users</p>
                                <h4 class="mb-0">{{ statistic.total_users }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span
                                    class="text-success text-sm font-weight-bolder">+{{ statistic.total_user_last_week.toFixed(2) }}%
                                </span>than last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">work</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Careers</p>
                                <h4 class="mb-0">{{ statistic.total_careers }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span
                                    class="text-success text-sm font-weight-bolder">+{{ statistic.total_careers_last_week }}%</span>
                                than last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">announcement</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Announcements</p>
                                <h4 class="mb-0">$103,430</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 mt-4">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Career Trajectory</h6>
                        </div>
                        <div class="card-body p-3" v-if="!objectives.length">
                            <div>
                                <label for="">Select Course</label>
                                <div>
                                    <select name="" id="" v-model="form.career_id">
                                        <option :value="career.id" v-for="career in $page.props.careers" :key="career.id">
                                            {{ career.course }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div v-if="form.career_id" class="mt-4 mb-4">
                                Description: {{ $page.props.careers.find(e => e.id == form.career_id).description }}
                            </div>
                            <div>
                                <label for="">Remarks</label>
                                <div>
                                    <textarea style="border:2px solid #ddd; " name="" id="" class="form-control p-2"
                                        v-model="form.description"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg mt-4" @click="saveGoal">
                                <i class="material-icons">check</i> SET GOAL NOW
                            </button>
                        </div>
                        <div class="card-body p-3" v-if="objectives.length">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="timeline timeline-one-side">
                                        <div class="timeline-block mb-3"
                                            v-for="item in objectives[0].career.items.sort((a, b) => a.id < b.id)"
                                            :key="item.id">
                                            <span class="timeline-step">
                                                <i class="material-icons text-success text-gradient">{{ $page.props.user.done_items.findIndex((e) => e.id == item.id) == -1 ? 'lock': 'check' }}</i>
                                            </span>
                                            <div class="timeline-content">
                                                <h6 class="text-dark  font-weight-bold mb-0 d-flex "
                                                    style="justify-content: space-between; align-items: center;">
                                                    <span>{{ item.title }}</span>
                                                    <Link v-if="$page.props.user.done_items.findIndex((e) => e.id == item.id) == -1" class="btn btn-primary " method="POST" href="/mark-as-done" :data="{item_id: item.id}" preserve-scroll>
                                                        <i class="material-icons">star</i> UNLOCK
                                                    </Link>
                                                    <div v-else style="color:#aaa;">
                                                        DONE
                                                    </div>
                                                </h6>
                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                    {{ item.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="display:grid;place-items: center;">
                                    <div style="width:100%;">
                                        <h3 class="text-center">
                                        <i class="material-icons " style="font-size:64px;">{{ ( $page.props.user.done_items.length /  objectives[0].career.items.length ) * 100 == 100 ? 'check' : 'more_time' }}</i>
                                    </h3>
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">{{( $page.props.user.done_items.length /  objectives[0].career.items.length ) * 100}}%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info" :style="{width: ($page.props.user.done_items.length /  objectives[0].career.items.length) * 100 + '%'}" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import shortNumber from 'short-number';
import MainLayout from '../Shared/MainLayout.vue';
export default {
    layout: MainLayout,
    props: [
        'statistic',
        'objectives'
    ],
    methods: {
        shortNumber,
        saveGoal() {
            this.form.post('/add-objectives')
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                career_id: null,
                description: ''
            }),
        }
    }
}
</script>
