<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { defineProps } from 'vue';

const props = defineProps({
    students: Array
});

// Change Status
const changeStatus = (studentId) => {
    router.post(route('students.changeStatus', studentId), {
        onSuccess: () => {

            console.log('Status changed successfully');
        },
        onError: (errors) => {

            console.error('Error changing status:', errors);
        }
    });
}

// Function to delete student
const deleteStudent = (studentId) => {
    if (confirm('Are you sure you want to delete this student?')) {
        router.delete(route('students.destroy', studentId), {
            onSuccess: () => {

                console.log('Student deleted successfully');
            },
            onError: (errors) => {

                console.error('Error deleting student:', errors);
            }
        });
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #default>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="my-4">Dashboard</h1>
                        <p>Welcome to your dashboard!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Student Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student, index) in students" :key="student.id" class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ student.id }}</td>
                                    <td>{{ student.name }}</td>
                                    <td><img :src="`/storage/${student.image}`" alt="Student Image" width="60px"></td>
                                    <td>
                                        <span v-if="student.status == 0" class="badge bg-success">Active</span>
                                        <span v-else class="badge bg-warning">Inactive</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-success" :href="route('students.edit', student.id)"><i class="bi bi-pen-fill"></i></a>
                                        |
                                        <a class="btn btn-primary" href="#" @click.prevent="changeStatus(student.id)"><i class="bi bi-patch-plus-fill"></i></a>
                                        |
                                        <a class="btn btn-danger" href="#" @click.prevent="deleteStudent(student.id)"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
