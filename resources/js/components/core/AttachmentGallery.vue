<template>
    <div class="text-white">
        <h3 class="text-xl font-bold mb-4">{{ title }}</h3>

        <div class="flex items-center gap-3 mb-4">
            <label
                class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                :class="{ 'opacity-60 cursor-not-allowed': loading }"
            >
                Добавить изображения
                <input
                    class="hidden"
                    type="file"
                    accept="image/*"
                    multiple
                    :disabled="loading"
                    @change="uploadImages"
                />
            </label>
        </div>

        <div v-if="galleryItems.length" class="grid grid-cols-2 md:grid-cols-6 gap-3">
            <div
                v-for="item in galleryItems"
                :key="item.id"
                class="relative rounded-lg overflow-hidden border border-white/15 bg-black/20"
            >
                <img
                    :src="item.url"
                    :alt="item.title || 'image'"
                    class="w-full h-28 object-cover cursor-pointer"
                    @click="openPreview(item)"
                />

                <button
                    type="button"
                    class="absolute top-1 right-1 w-7 h-7 rounded-full bg-red-600/90 hover:bg-red-700 text-white text-sm cursor-pointer"
                    :disabled="loading"
                    @click="removeImage(item)"
                >
                    x
                </button>
            </div>
        </div>

        <div v-else class="text-sm text-gray-300">Изображений пока нет.</div>

        <app-modal ref="previewModal" :id="modalId">
            <div class="p-2">
                <img
                    v-if="previewImage"
                    :src="previewImage.url"
                    :alt="previewImage.title || 'preview'"
                    class="max-w-[80vw] max-h-[80vh] object-contain"
                />
            </div>
        </app-modal>
    </div>
</template>

<script setup>
import {ref, watch} from 'vue';

const props = defineProps({
    modelValue: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        default: 'Галерея',
    },
    uploadUrl: {
        type: String,
        default: '/uploadFile',
    },
    attachmentableType: {
        type: String,
        default: 'EXCURSION',
    },
    modalId: {
        type: String,
        default: 'attachmentPreviewModal',
    },
});

const emit = defineEmits(['update:modelValue']);

const galleryItems = ref([...(props.modelValue || [])]);
const loading = ref(false);
const previewImage = ref(null);
const previewModal = ref(null);

watch(() => props.modelValue, (value) => {
    galleryItems.value = [...(value || [])];
});

const emitItems = (items) => {
    emit('update:modelValue', items);
};

const uploadOneFile = (file) => {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('attachmentableType', props.attachmentableType);

    return axios.post(props.uploadUrl, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    }).then((resp) => resp.data?.data || null);
};

const uploadImages = async (event) => {
    const files = event.target.files ? Array.from(event.target.files) : [];
    if (!files.length) {
        return;
    }

    loading.value = true;

    try {
        for (const file of files) {
            const uploaded = await uploadOneFile(file);
            if (uploaded && uploaded.id) {
                galleryItems.value.push({
                    id: uploaded.id,
                    title: uploaded.title,
                    url: uploaded.url,
                    previews: uploaded.previews || [],
                });
            }
        }

        emitItems(galleryItems.value);
    } finally {
        loading.value = false;
        event.target.value = '';
    }
};

const removeImage = (item) => {
    galleryItems.value = galleryItems.value.filter((galleryItem) => galleryItem.id !== item.id);
    emitItems(galleryItems.value);
};

const openPreview = (item) => {
    previewImage.value = item;
    previewModal.value?.show();
};
</script>
