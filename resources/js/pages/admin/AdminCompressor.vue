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
</template>

<script setup>
import {computed, ref} from "vue";
import {faArrowRight, faTrashArrowUp} from "@fortawesome/free-solid-svg-icons";


const slug = window.location.href.split('/').pop();
const sourceSlug = ref(slug)
const attachments = ref([])

const compressor = ref({
    id: null,
    name: null,
})

const applyCompressorFromResponse = (data) => {
    compressor.value = {
        id: data.id,
        name: data.name,
    }

    attachments.value = data.attachments || []
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
</script>
