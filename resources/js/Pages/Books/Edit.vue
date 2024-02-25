<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps(['book']);
const form = useForm({
  title: props.book.title,
  image: null,
});

const submitForm = async () => {
   form.put(route('books.update', { book: props.book.id }));
};

const onImageChange = (event) => {
  form.image = event.target.files[0];
};
</script>



<template>
    <Head title="Book" />

    <AuthenticatedLayout>
        <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Book</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div>
            <h1 class="text-2xl font-semibold mb-4">Edit Book</h1>
            <form @submit.prevent="submitForm">
              <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Title:</label>
                <input v-model="form.title" required class="mt-1 p-2 w-full border rounded-md" />
              </div>

              <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-600">Image:</label>
                <input type="file" accept="image/*" @change="onImageChange" class="mt-1 p-2 w-full border rounded-md" />
              </div>

              <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </AuthenticatedLayout>
</template>
