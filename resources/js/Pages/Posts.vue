<template>
    <div>
        <Card title="Write new">
            <div class="alert alert-warning" v-for="error in $page.props.errors" :key="error">
                {{ error }}
            </div>
            <form @submit.prevent="form.post('/posts', {onSuccess: () => {
                $toast.success('Submitted successfully!')
            }}); form.reset()">
                <div>
                    <div>
                        <label for="">Title</label>
                    </div>
                    <input type="text" v-model.trim="form.title" class="w-100 p-2" placeholder="Aa">
                </div>
                <div>
                    <div>
                        <label for="">Body</label>
                    </div>
                    <textarea type="text" v-model.trim="form.body" class="w-100 p-2" placeholder="Aa"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    SUBMIT
                </button>
            </form>
        </Card>
        <br>
        <Card title="Latest Feeds">
            <div class="card mb-2" v-for="post in posts.data" :key="post.id">
                <div class="card-body">
                    <div class="d-flex" style="justify-content: space-between;">
                        <h6>{{ post.title }}</h6>  <div>{{ post.created_at }}</div>
                    </div>
                    <div>
                        {{post.body}}
                    </div>
                    <small>
                        - {{ post.user.name }}
                    </small>
                </div>
            </div>
        </Card>
        <ul class="pagination">
            <li v-for="link, index in posts.links" :key="index">
                <Link class="page-link " :class="{ 'active': link.active, 'disabled': link.url == null }"
                    :href="`${link.url}`" v-html="link.label">
                </Link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['posts'],
    data() {
        return {
            form: this.$inertia.form({
                title: '',
                body: '',
            })
        }
    }
}
</script>
