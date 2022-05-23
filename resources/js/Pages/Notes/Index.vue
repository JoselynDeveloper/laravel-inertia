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
                            <h3 class="text-lg text-gray-900">Listado de notas</h3>
                            <p class="text-sm text-gray-600">Toma el registro correcto y ejecuta cualquier funcion ()
                            </p>
                        </div>
                    </div>
                    <div class="md:col-span-2 md:mt-0">
                        <!-- Show message update   -->
                        <div v-if="$page.props.flash.success"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success! </strong>
                            <span class="block sm:inline">{{ $page.props.flash.message }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </span>
                        </div>
                        <div class="shadow bg-white md:rounded-md p-4">
                            <div class="mb-5 flex justify-between">
                                <input type="text" v-model="q" class="w-96 rounded-md" placeholder="Buscar...">

                                <inertia-link :href="route('notes.create')"
                                    class="bg-blue-500 text-white px-8 py-2 rounded-md ">
                                    Create
                                </inertia-link>
                            </div>
                            <table>
                                <tr v-for="note in notes">
                                    <td class="border px-4 py-2">
                                        {{ note.id }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ note.title }}
                                    </td>

                                    <td class="px-4 py-2 text-blue-500">
                                        <inertia-link :href="route('notes.show', note.id)">
                                            Show
                                        </inertia-link>
                                    </td>

                                    <td class="px-4 py-2 text-orange-300">
                                        <inertia-link :href="route('notes.edit', note.id)">
                                            Editar
                                        </inertia-link>
                                    </td>

                                    <td class="px-4 py-2 text-red-500">
                                        <inertia-link @click.prevent="destroy(note.id)">
                                            Eliminar
                                        </inertia-link>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3'

// create method destroy
const destroy = (id) => {
    // delete note
    if (confirm('Seguro que desea eliminar la nota?')) {
        Inertia.delete('/notes/' + id);
    }
};

export default {
    components: {
        AppLayout,
        Link,
    },
    props: {
        notes: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            q: '',
            success: '',
        };
    },
    methods: {
        destroy,
    },
    watch: {
        q() {
            Inertia.get(this.route('notes.index'), {
                q: this.q,
            }, {
                preserveState: true,
            });
        },
    },
};

</script>