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
                            <h3 class="text-lg text-gray-900">Create a note</h3>
                            <p class="text-sm text-gray-600">Crear una nueva note</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <span class="mr-2">
                                <SecondaryButton :href="route('notes.index')">
                                    Back
                                </SecondaryButton>
                            </span>
                        <div class="shadow bg-white md:rounded-md p-4">
                            <form @submit.prevent="submit">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-first-name">
                                            Title
                                        </label>
                                        <input v-model="form.title"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-first-name" type="text" placeholder="Jane" />
                                        <div v-if="errors.title" class="text-red-800 mt-3">{{ errors.title }}</div>
                                    </div>

                                    <div class="w-full px-3 my-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-last-name">
                                            Body
                                        </label>
                                        <textarea v-model="form.body"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-last-name" placeholder="..."></textarea>
                                        <div v-if="errors.body" class="text-red-900 mt-3">{{ errors.body }}</div>
                                    </div>

                                    <div class="w-full px-3 mt-5">
                                        <div>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100"
                                                class="w-full">
                                                {{ form.progress.percentage }}%
                                            </progress>
                                        </div>
                                        <!-- button submit -->
                                        <button type="submit" :disabled="form.processing"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import SecondaryButton from '@/Jetstream/SecondaryButton.vue';

export default {
    components: {
        AppLayout,
        SecondaryButton
    },
    props: {
        errors: {
            type: Object,
            default: () => ({}),
        },
    },
    setup() {
        const form = reactive({
            title: '',
            body: '',
            processing: false,
            progress: null,
            errors: {
                title: null,
                body: null,
            },
        });

        const submit = () => {
            form.processing = true
            form.progress = {
                percentage: 0,
            }

            const interval = setInterval(() => {
                form.progress.percentage += 10;

                if (form.progress.percentage >= 100) {
                    clearInterval(interval);
                    form.processing = false
                    form.progress = null
                }
            }, 100);

            //Http request
            Inertia.post('/notes', form);

        }



        return { form, submit }
    }
}

</script>
