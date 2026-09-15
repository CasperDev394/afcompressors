<template>
    <div class="pl-65 pt-20 pb-20 flex flex-col gap-4">
        <div class="max-w-7xl mx-auto flex flex-row gap-4 w-full">
            <div class="max-w-6xl mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 w-650">
                <div class="flex flex-col gap-8 justify-center items-center pb-8 text-white w-full">
                    <h2 class="text-2xl font-bold">compressor</h2>

                    <div class="flex flex-col gap-4 justify-center items-start w-full">
                        <input
                            class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                            type="text"
                            autofocus
                            placeholder="Название"
                            v-model="compressor.name"
                        />

                        <select
                            v-model="compressor.pressure_category"
                            class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full text-white"
                        >
                            <option class="text-black" value="">Категория давления</option>
                            <option class="text-black" value="15-40-bar">15 – 40 бар</option>
<!--                            <option class="text-black" value="8-10-bar">8 и 10 бар</option>-->
                        </select>

                        <input
                            class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                            type="text"
                            placeholder="MSF"
                            v-model="compressor.msf"
                        />

                        <input
                            class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                            type="text"
                            placeholder="ISO 1217"
                            v-model="compressor.capacities_iso"
                        />
                    </div>
                </div>
            </div>

            <div class="w-100 mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 flex flex-col justify-between">
                <div class="flex flex-col gap-4 justify-start items-start pb-8 text-white w-full">
                    <h2 class="text-x font-bold">Services</h2>

                    <div class="flex flex-row w-full gap-4">
                        <p class="text-sm font-semibold text-emerald-500">ID</p>
                        <p class="text-sm font-medium text-gray-400">{{ compressor.id }}</p>
                    </div>
                </div>

                <div v-if="compressor.id" class="flex justify-end">
                    <button
                        class="bg-gray-500 hover:bg-red-500 text-gray-300 px-4 py-2 rounded-lg transition-colors duration-200 flex justify-between items-center cursor-pointer"
                        @click="remove"
                    >
                        <svg-icon size="16" :fa-icon="faTrashArrowUp" />
                    </button>
                </div>
            </div>
        </div>

        <div class="h-px bg-white/15 w-full max-w-7xl mx-auto"></div>

        <div class="max-w-7xl mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 w-full text-white">
            <div class="flex justify-between items-center gap-4 mb-6">
                <h3 class="text-xl font-bold">Модели</h3>

                <button
                    class="flex justify-center items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="!compressor.id"
                    @click="openCreateModelModal"
                >
                    Добавить
                </button>
            </div>

            <p v-if="!compressor.id" class="text-sm text-gray-400 mb-4">
                Сначала сохраните компрессор, затем можно будет добавлять модели.
            </p>

            <div v-if="compressorModels.length" class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-sm text-gray-400">
                            <th class="py-2">Название</th>
                            <th class="py-2">Capacity</th>
                            <th class="py-2">FAD</th>
                            <th class="py-2">CFM</th>
                            <th class="py-2">Installed power</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="item in compressorModels"
                            :key="item.id"
                            class="bg-white/5 cursor-pointer hover:bg-white/10"
                            @click="openEditModelModal(item)"
                        >
                            <td class="px-4 py-3 rounded-l-lg">{{ item.name }}</td>
                            <td class="px-4 py-3">{{ item.capacity ?? '—' }}</td>
                            <td class="px-4 py-3">{{ item.FAD ?? '—' }}</td>
                            <td class="px-4 py-3">{{ item.CFM ?? '—' }}</td>
                            <td class="px-4 py-3 rounded-r-lg">{{ item.installed_power ?? '—' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else class="text-sm text-gray-400">Моделей пока нет.</p>
        </div>

        <div class="max-w-7xl mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 w-full text-white">
            <attachment-gallery
                v-model="attachments"
                title="Галерея"
                upload-url="/uploadFile"
                attachmentable-type="COMPRESSOR"
                modal-id="compressorImagePreviewModal"
            />
        </div>
    </div>

    <div
        class="admin-bottom-bar fixed px-4 bottom-0 left-0 right-0 z-20 h-14 border-t border-white/10 bg-zinc-900/95 backdrop-blur-md flex items-center justify-between"
    >
        <div class="flex items-center gap-2 ml-4">
            <button
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex justify-between items-center cursor-pointer"
                @click="submit"
            >
                Сохранить
                <svg-icon size="16" :fa-icon="faArrowRight" />
            </button>
        </div>

        <div v-if="compressor.id" class="flex justify-end mr-2">
            <button
                class="bg-gray-500 hover:bg-red-500 text-gray-300 px-4 py-2 rounded-lg transition-colors duration-200 flex justify-between items-center cursor-pointer"
                @click="remove"
            >
                <svg-icon size="16" :fa-icon="faTrashArrowUp" />
            </button>
        </div>
    </div>

    <app-modal ref="modelModal" id="compressorModelModal">
        <div class="p-4 md:p-6 min-w-[320px] md:min-w-[620px]">
            <h3 class="text-xl font-bold mb-6">
                {{ editingModel.id ? 'Редактирование модели' : 'Новая модель' }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input
                    v-model="editingModel.name"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400 md:col-span-2"
                    type="text"
                    placeholder="Название"
                />

                <input
                    v-model="editingModel.capacity"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                    type="number"
                    step="0.1"
                    placeholder="Capacity"
                />

                <input
                    v-model="editingModel.FAD"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                    type="number"
                    step="1"
                    placeholder="FAD"
                />

                <input
                    v-model="editingModel.CFM"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                    type="number"
                    step="1"
                    placeholder="CFM"
                />

                <input
                    v-model="editingModel.installed_power"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                    type="number"
                    step="1"
                    placeholder="Installed power"
                />
            </div>
        </div>

        <template #footer>
            <div class="w-full flex items-center justify-between gap-3 px-2 pb-2">
                <button
                    v-if="editingModel.id"
                    class="bg-gray-500 hover:bg-red-500 text-gray-200 px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                    @click="removeModel(editingModel, true)"
                >
                    Удалить
                </button>
                <div v-else></div>

                <button
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                    @click="saveModel"
                >
                    Сохранить
                </button>
            </div>
        </template>
    </app-modal>
</template>

<script setup>
import { reactive, ref } from "vue";
import {faArrowRight, faTrashArrowUp} from "@fortawesome/free-solid-svg-icons";


const slug = window.location.href.split('/').pop();
const sourceSlug = ref(slug)
const attachments = ref([])
const compressorModels = ref([])
const modelModal = ref(null)

const compressor = ref({
    id: null,
    name: null,
    pressure_category: '',
    msf: '',
    capacities_iso: '',
})

const initialModelState = () => ({
    id: null,
    name: '',
    capacity: '',
    FAD: '',
    CFM: '',
    installed_power: '',
})

const editingModel = reactive(initialModelState())

const resetEditingModel = () => {
    Object.assign(editingModel, initialModelState())
}

const applyCompressorFromResponse = (data) => {
    compressor.value = {
        id: data.id,
        name: data.name,
        pressure_category: data.pressure_category || '',
        msf: data.msf || '',
        capacities_iso: data.capacities_iso || '',
    }

    attachments.value = data.attachments || []
    compressorModels.value = (data.models || []).map((item) => ({
        id: item.id,
        name: item.name,
        capacity: item.capacity,
        FAD: item.FAD,
        CFM: item.CFM,
        installed_power: item.installed_power,
    }))
}

if (slug !== 'compressor' && slug !== 'create') {
    axios.get('/admin/compressors/' + slug + '/read').then((resp) => {
        applyCompressorFromResponse(resp.data.data)
    }).catch(() => {})
}

const submit = () => {
    const payload = {
        id: compressor.value.id,
        name: compressor.value.name,
        pressure_category: compressor.value.pressure_category || null,
        msf: compressor.value.msf || null,
        capacities_iso: compressor.value.capacities_iso || null,
        attachment_ids: attachments.value.map((attachment) => attachment.id),
    }

    if (compressor.value.id) {
        axios.post('/admin/compressors/' + sourceSlug.value + '/update', payload)
            .then(() => {
                window.location.reload();
            });
    } else {
        axios.post('/admin/compressors/create', payload)
            .then(() => {
                window.location.href = '/admin/compressors'
            });
    }
}

const remove = () => {
    axios.post('/admin/compressors/' + sourceSlug.value + '/delete')
        .then(() => {
            window.location.href = '/admin/compressors'
        });
}

const openCreateModelModal = async () => {
    resetEditingModel()
    await modelModal.value?.show()
}

const openEditModelModal = async (item) => {
    Object.assign(editingModel, {
        id: item.id,
        name: item.name,
        capacity: item.capacity ?? '',
        FAD: item.FAD ?? '',
        CFM: item.CFM ?? '',
        installed_power: item.installed_power ?? '',
    })
    await modelModal.value?.show()
}

const upsertModelInList = (data) => {
    const normalized = {
        id: data.id,
        name: data.name,
        capacity: data.capacity,
        FAD: data.FAD,
        CFM: data.CFM,
        installed_power: data.installed_power,
    }

    const index = compressorModels.value.findIndex((item) => item.id === normalized.id)
    if (index === -1) {
        compressorModels.value = [...compressorModels.value, normalized].sort((a, b) => a.name.localeCompare(b.name))
        return
    }

    compressorModels.value[index] = normalized
    compressorModels.value = [...compressorModels.value]
}

const buildNullableNumber = (value, integer = false) => {
    if (value === '' || value === null || value === undefined) {
        return null
    }

    return integer ? Number.parseInt(value, 10) : Number.parseFloat(value)
}

const saveModel = () => {
    const payload = {
        name: editingModel.name,
        capacity: buildNullableNumber(editingModel.capacity),
        FAD: buildNullableNumber(editingModel.FAD, true),
        CFM: buildNullableNumber(editingModel.CFM, true),
        installed_power: buildNullableNumber(editingModel.installed_power, true),
    }

    if (editingModel.id) {
        axios.post(`/admin/compressors/${sourceSlug.value}/models/${editingModel.id}/update`, payload)
            .then((resp) => {
                upsertModelInList(resp.data.data)
                modelModal.value?.hide()
                resetEditingModel()
            });
        return
    }

    axios.post(`/admin/compressors/${sourceSlug.value}/models/create`, payload)
        .then((resp) => {
            upsertModelInList(resp.data.data)
            modelModal.value?.hide()
            resetEditingModel()
        });
}

const removeModel = (item, fromModal = false) => {
    if (!item?.id) {
        return
    }

    axios.post(`/admin/compressors/${sourceSlug.value}/models/${item.id}/delete`)
        .then(() => {
            compressorModels.value = compressorModels.value.filter((model) => model.id !== item.id)
            if (fromModal) {
                modelModal.value?.hide()
                resetEditingModel()
            }
        })
}
</script>
