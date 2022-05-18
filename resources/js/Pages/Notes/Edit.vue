<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ButtonBack from '@/Components/ButtonBack.vue';
defineProps({
    note: Object,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit note
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px4 sm:px0">
                            <h3 class="text-lg text-gray-900">Detail note</h3>
                            <p class="text-sm text-gray-600">{{ note.excerpt }}</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 md:mt-0">
                        <div class="shadow bg-white md:rounded-md p-4">
                            <div class="text-gray-700">
                                <p>{{ note.body }}</p>
                            </div>

                            <span class="mt-3 py-5 border-t-2 block">
                                <ButtonBack :href="route('notes.index')">
                                    Back
                                </ButtonBack>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
