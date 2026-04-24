<template>
    <div class="pl-65 pt-20">
        <div class="">

            <button
                class="flex justify-center items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                @click="openPageCreate"
            >
                <svg-icon size="16" :fa-icon="faPlus" />
                &nbsp;&nbsp;
                Добавить
            </button>

            <data-table
                :headers="headers"
                :items="compressors"
                :filter-options="filterOptions"
                :loading="loading"
                theme-color="#f48225"
                buttons-pagination
                @click-row="openPageEdit"
                table-class-name="app-table customize-table"
            >
                <template #header-name="header">
                    <div class="">
                        {{ header.text }}
                        <div class="">

                        </div>
                    </div>
                </template>
                <template #item-name="item">
                    <p class="">{{item.name}}</p>
                </template>


                <template #loading>
                    <img
                        src="https://i.pinimg.com/originals/94/fd/2b/94fd2bf50097ade743220761f41693d5.gif"
                        style="width: 100px; height: 80px;"
                    />
                </template>
                <template #empty-message>
                    <p>Результатов нет</p>
                </template>
            </data-table>

        </div>
    </div>
</template>
<script setup>
import DataTable from "vue3-easy-data-table";
import {faPlus} from "@fortawesome/free-solid-svg-icons";
import {computed, ref, watch} from "vue";

const compressors = ref([])
const loading = ref(true)
const headers = ref([
    { text: "Название", value: "name" },
]);

const nameCriteria = ref('');
const filterOptions = computed(() => {
    const filterOptionsArray = [];

    filterOptionsArray.push({
        field: 'name',
        criteria: nameCriteria.value,
        comparison: (value, criteria) => (value != null && criteria != null && typeof value === 'string' && value.includes(`${criteria}`)),
    })
    return filterOptionsArray;
})

axios.get('/admin/compressors/getList').then((resp) => {
    compressors.value = resp.data.data
    loading.value = false
}).catch(() => {})

const openPageCreate = () =>{
    window.location.href = "/admin/compressors/create"
}
const openPageEdit = (item) =>{
    window.location.href = "/admin/compressors/"+item.name_slug
}

</script>
