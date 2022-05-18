<script setup>

const props = defineProps({
    href: String,
});

</script>

<template>
    <inertia-link :href="href" class="bg-sky-500/100 py-2 px-6 text-white">
        <slot />
    </inertia-link>
</template>
