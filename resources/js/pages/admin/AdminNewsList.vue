<template>
    <div class="pl-65 pt-20">
        <div>
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
                :items="items"
                :filter-options="filterOptions"
                :loading="loading"
                theme-color="#f48225"
                buttons-pagination
                @click-row="openPageEdit"
                table-class-name="app-table customize-table"
            >
                <template #item-name="item">
                    <p>{{ item.name }}</p>
                </template>

                <template #item-published="item">
                    <span :class="item.published ? 'text-emerald-500' : 'text-gray-400'">
                        {{ item.published ? 'Да' : 'Нет' }}
                    </span>
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
import { computed, ref } from "vue";
import { faPlus } from "@fortawesome/free-solid-svg-icons";

const items = ref([])
const loading = ref(true)
const nameCriteria = ref('')

const headers = ref([
    { text: "Название", value: "name" },
    { text: "Опубликовано", value: "published" },
]);

const filterOptions = computed(() => ([
    {
        field: 'name',
        criteria: nameCriteria.value,
        comparison: (value, criteria) => (value != null && criteria != null && typeof value === 'string' && value.includes(`${criteria}`)),
    },
]))

axios.get('/admin/news/getList').then((resp) => {
    items.value = resp.data.data
    loading.value = false
}).catch(() => {})

const openPageCreate = () => {
    window.location.href = '/admin/news/create'
}

const openPageEdit = (item) => {
    window.location.href = '/admin/news/' + item.name_slug
}
</script>
