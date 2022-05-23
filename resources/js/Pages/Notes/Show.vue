<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modulo de notas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px4 sm:px0">
                            <h3 class="text-lg text-gray-900">Detail note</h3>
                            <p class="text-sm text-gray-600">{{ note.title }}</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 md:mt-0">
                        <!-- Show message update   -->
                        <div v-if="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success! </strong>
                            <span class="block sm:inline">{{ success }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </span>
                        </div>
                        <div class="shadow bg-white md:rounded-md p-4">
                            <div class="text-gray-700">
                                <p>{{ note.body }}</p>
                            </div>

                            <span class="mt-3 py-5 border-t-2 block">
                                <span class="mr-2">
                                    <SecondaryButton :href="route('notes.index')">
                                        Back
                                    </SecondaryButton>
                                </span>

                                <span class="mr-2">
                                    <WarningButton :href="route('notes.edit', note.id)">
                                        Edit
                                    </WarningButton>
                                </span>
                                <span>
                                    <inertia-link @click.prevent="destroy(note.id)" class="text-red-900 hover:text-white border border-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-600 dark:text-red-400 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-800">
                                            Eliminar
                                        </inertia-link>
                                </span>
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import SecondaryButton from '@/Jetstream/SecondaryButton.vue';
import WarningButton from '@/JetStream/WarningButton.vue';
defineProps({
    note: Object,
    success: String,
});

// create method destroy
const destroy = (id) => {
    // delete note
    if(confirm('Seguro que desea eliminar la nota?')) {
        Inertia.delete('/notes/' + id);
    }
};

</script>
