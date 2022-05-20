<script setup>

const props = defineProps({
    href: String,
    class: String,
});

</script>

<template>
    <inertia-link :href="href" class="py-2 px-6 text-white" :class="class">
        <slot />
    </inertia-link>
</template>
