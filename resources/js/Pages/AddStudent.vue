<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    storeRoute: String,
});

const form = useForm({
    name: '',
    image: null,
    age: '',

});

const handleSubmit = () => {
    form.post(props.storeRoute, {
        onSuccess: () => {
            console.log('Form submitted successfully!');
        },
        onError: (errors) => {
            console.log('Form submission failed:', errors);
        }
    });
};
</script>

<template>
    <Head title="Add Student" />

    <AuthenticatedLayout>
        <template #default>
            <div class="container mx-auto p-4">
                <div class="bg-white shadow rounded-lg p-6">
                    <h5 class="text-xl font-semibold mb-4">Add New Student</h5>
                    <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input
                                type="text"
                                id="name"
                                v-model="form.name"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Enter name"
                            />
                            <span v-if="form.errors.name" class="text-red-600 text-sm">{{ form.errors.name }}</span>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input
                                type="file"
                                id="image"
                                @change="e => form.image = e.target.files[0]"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                            <span v-if="form.errors.image" class="text-red-600 text-sm">{{ form.errors.image }}</span>
                        </div>

                        <div class="mb-4">
                            <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                            <input
                                type="number"
                                id="age"
                                v-model="form.age"
                                class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Enter age"
                            />
                            <span v-if="form.errors.age" class="text-red-600 text-sm">{{ form.errors.age }}</span>
                        </div>


                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                        >
                            Add Student
                        </button>
                    </form>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
