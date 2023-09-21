<template>
    <div class="my-3">
        <label for="" class="form-label text-primary text-xs">{{ label }}</label>
        <div class="input-group input-group-outline ">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'label',
    ]
}
</script>
