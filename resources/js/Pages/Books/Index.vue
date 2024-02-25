<script setup>
import { ref,watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,useForm} from '@inertiajs/vue3';

const props = defineProps(['books','user']);
const books = ref(props.books);
const user = ref(props.user);
const form = useForm({
    ok:true,
});

let headers = [];
if(user.is_admin == 0){
    headers = [
                    { text: "Title", value: "title" },
                    { text: "Image", value: "image" },
                ];
}else{
    headers = [
                    { text: "Title", value: "title" },
                    { text: "Image", value: "image" },
                    { text: "Action", value: "action",width: 200 },
                ];
}

const confirmDelete = async (bookId) => {
  if (confirm('Are you sure you want to delete this book?')) {
    form.delete(route('books.destroy', bookId));
    window.location.reload();
  }
};

const rowsPerPage = ref(10);
const items = ref(props.books.data)
const serverOptions = ref({
    page: books.value.current_page,
    rowsPerPage: books.value.per_page,
});



const loadFromServer = async () => {
    form.get(route('books.index', {
        page:serverOptions.value.page,
        limit:serverOptions.value.rowsPerPage,
    }));
};

watch([serverOptions, rowsPerPage], ([serverOptionsValue, rowsPerPageValue]) => {
  loadFromServer(serverOptionsValue.page, rowsPerPageValue);
}, { deep: true });
</script>


<template>
    <Head title="Book" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">BooK</h2>
                <a v-if="user.is_admin == 1" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white" :href="route('books.create')" >Add New</a>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   
                    <EasyDataTable
                    border-cell
                    buttons-pagination
                    show-index
                    must-sort
                    :headers="headers"
                    :items="items"
                    v-model:server-options="serverOptions"
                    :server-items-length="books.total"
                    >
                    <template #item-action="{ id }" v-if="user.is_admin == 1">
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white m-1" :href="route('books.edit',id)" >Edit</a>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white" @click="confirmDelete(id)">Delete</button>
                    </template>
                    </EasyDataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
