<script setup>
import { ref,watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,useForm} from '@inertiajs/vue3';

const props = defineProps(['readers','user']);
const readers = ref(props.readers);
const user = ref(props.user);

const form = useForm({
    ok:true,
});

let headers = [];
if(user.is_admin == 0){
    
        headers =[
                    { text: "Name", value: "name" },
                ];
}else{
        headers =[
                    { text: "Name", value: "name" },
                    { text: "Action", value: "action",width: 200 },
                ];
}


const confirmDelete = async (readerId) => {
  if (confirm('Are you sure you want to delete this Reader?')) {
    form.delete(route('readers.destroy', readerId));
    window.location.reload();
  }
};

const rowsPerPage = ref(10);
const items = ref(props.readers.data)
const serverOptions = ref({
    page: readers.value.current_page,
    rowsPerPage: readers.value.per_page,
});

const loadFromServer = async () => {
    form.get(route('readers.index', {
        page:serverOptions.value.page,
        limit:serverOptions.value.rowsPerPage,
    }));
};

watch([serverOptions, rowsPerPage], ([serverOptionsValue, rowsPerPageValue]) => {
  loadFromServer(serverOptionsValue.page, rowsPerPageValue);
}, { deep: true });
</script>


<template>
    <Head title="Reader" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reader</h2>
                <a  v-if="user.is_admin==1" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white" :href="route('readers.create')" >Add New</a>
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
                    :server-items-length="readers.total"
                    >
                    <template #item-action="{ id }" v-if="user.is_admin==1">
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white m-1" :href="route('readers.edit',id)" >Edit</a>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white" @click="confirmDelete(id)">Delete</button>
                    </template>
                    </EasyDataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
