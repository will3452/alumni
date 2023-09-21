<template>
    <li class="nav-item">
                <Link class="nav-link text-white " :href="href" :class="{'active': href == $page.url, 'bg-gradient-primary': href == $page.url, }">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">{{ icon }}</i>
                    </div>
                    <span class="nav-link-text ms-1">{{label}}</span>
                </Link>
        </li>
</template>


<script>
export default {
    props: ['href', 'label', 'icon']
}
</script>
