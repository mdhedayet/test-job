<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps(['reader']);
const form = useForm({
  name: props.reader.name,
});

const submitForm = async () => {
   form.put(route('readers.update', { reader: props.reader.id }));
};

</script>



<template>
    <Head title="Book" />

    <AuthenticatedLayout>
        <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reader</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div>
            <h1 class="text-2xl font-semibold mb-4">Edit Reader</h1>
            <form @submit.prevent="submitForm">
              <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">name:</label>
                <input v-model="form.name" required class="mt-1 p-2 w-full border rounded-md" />
              </div>
              <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </AuthenticatedLayout>
</template>
