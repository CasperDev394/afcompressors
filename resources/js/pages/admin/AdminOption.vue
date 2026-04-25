<template>
    <div class="pl-65 pt-20 pb-20 flex flex-col gap-4">
        <div class="max-w-7xl mx-auto flex flex-row gap-4 w-full">
            <div class="max-w-6xl mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 w-650">
                <div class="flex flex-col gap-8 justify-center items-center pb-8 text-white w-full">
                    <h2 class="text-2xl font-bold">option</h2>

                    <div class="flex flex-col gap-4 justify-center items-start w-full">
                        <input
                            class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                            type="text"
                            autofocus
                            placeholder="Название"
                            v-model="option.name"
                        />

                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <input
                                v-model="option.published"
                                type="checkbox"
                                class="h-4 w-4 rounded border border-white/20 bg-white/5"
                            />
                            <span>Опубликовано</span>
                        </label>

                        <div class="w-full rounded-xl border border-white/10 bg-white/5 p-4">
                            <div class="flex items-center justify-between gap-4 mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold">SVG иконка</h3>
                                    <p class="text-sm text-gray-400">Одна SVG иконка для опции.</p>
                                </div>

                                <label class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg transition-colors duration-200 cursor-pointer">
                                    Загрузить SVG
                                    <input
                                        class="hidden"
                                        type="file"
                                        accept=".svg,image/svg+xml"
                                        @change="uploadOptionIcon"
                                    />
                                </label>
                            </div>

                            <div v-if="option.iconAttachment" class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-18 h-18 rounded-lg bg-white p-2 flex items-center justify-center">
                                        <img
                                            :src="option.iconAttachment.url"
                                            :alt="option.iconAttachment.title || 'icon'"
                                            class="max-w-full max-h-full object-contain"
                                        />
                                    </div>
                                    <div class="text-sm text-gray-300 break-all">
                                        {{ option.iconAttachment.title }}
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    class="bg-gray-500 hover:bg-red-500 text-gray-200 px-3 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                                    @click="removeOptionIcon"
                                >
                                    Удалить иконку
                                </button>
                            </div>
                            <p v-else class="text-sm text-gray-400">SVG иконка пока не добавлена.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 flex flex-col justify-between">
                <div class="flex flex-col gap-4 justify-start items-start pb-8 text-white w-full">
                    <h2 class="text-x font-bold">Services</h2>

                    <div class="flex flex-row w-full gap-4">
                        <p class="text-sm font-semibold text-emerald-500">ID</p>
                        <p class="text-sm font-medium text-gray-400">{{ option.id }}</p>
                    </div>
                </div>

                <div v-if="option.id" class="flex justify-end">
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
                attachmentable-type="OPTION"
                modal-id="optionImagePreviewModal"
            />
        </div>

        <div class="max-w-7xl mx-auto bg-white/5 backdrop-blur-md rounded-xl p-6 w-full text-white">
            <div class="flex justify-between items-center gap-4 mb-6">
                <h3 class="text-xl font-bold">Посты опции</h3>

                <button
                    class="flex justify-center items-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="!option.id"
                    @click="openCreatePostModal"
                >
                    <svg-icon size="16" :fa-icon="faPlus" />
                    &nbsp;&nbsp;
                    Добавить
                </button>
            </div>

            <p v-if="!option.id" class="text-sm text-gray-400 mb-4">
                Сначала сохраните опцию, затем можно будет добавлять посты.
            </p>

            <div v-if="optionPosts.length" class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-sm text-gray-400">
                            <th class="py-2">Название</th>
                            <th class="py-2 w-40">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="post in optionPosts"
                            :key="post.id"
                            class="bg-white/5"
                        >
                            <td class="px-4 py-3 rounded-l-lg">{{ post.name }}</td>
                            <td class="px-4 py-3 rounded-r-lg">
                                <div class="flex items-center gap-2">
                                    <button
                                        class="bg-zinc-700 hover:bg-zinc-600 text-white px-3 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                                        @click="openEditPostModal(post)"
                                    >
                                        Редактировать
                                    </button>
                                    <button
                                        class="bg-gray-500 hover:bg-red-500 text-gray-200 px-3 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                                        @click="removePost(post)"
                                    >
                                        Удалить
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else class="text-sm text-gray-400">Постов пока нет.</p>
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

        <div v-if="option.id" class="flex justify-end mr-2">
            <button
                class="bg-gray-500 hover:bg-red-500 text-gray-300 px-4 py-2 rounded-lg transition-colors duration-200 flex justify-between items-center cursor-pointer"
                @click="remove"
            >
                <svg-icon size="16" :fa-icon="faTrashArrowUp" />
            </button>
        </div>
    </div>

    <app-modal ref="postModal" id="optionPostModal">
        <div class="p-4 md:p-6 min-w-[320px] md:min-w-[720px]">
            <h3 class="text-xl font-bold mb-6">
                {{ editingPost.id ? 'Редактирование поста' : 'Новый пост' }}
            </h3>

            <div class="flex flex-col gap-4">
                <input
                    v-model="editingPost.name"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full placeholder:text-gray-400"
                    type="text"
                    placeholder="Название"
                />

                <textarea
                    v-model="editingPost.description"
                    class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full min-h-36 placeholder:text-gray-400"
                    placeholder="Описание"
                ></textarea>

                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <input
                        v-model="editingPost.published"
                        type="checkbox"
                        class="h-4 w-4 rounded border border-white/20 bg-white/5"
                    />
                    <span>Опубликовано</span>
                </label>
            </div>

            <div class="mt-6">
                <attachment-gallery
                    v-model="editingPostAttachments"
                    title="Картинки"
                    upload-url="/uploadFile"
                    attachmentable-type="OPTION_POST"
                    modal-id="optionPostImagePreviewModal"
                />
            </div>
        </div>

        <template #footer>
            <div class="w-full flex items-center justify-between gap-3 px-2 pb-2">
                <button
                    v-if="editingPost.id"
                    class="bg-gray-500 hover:bg-red-500 text-gray-200 px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                    @click="removePost(editingPost, true)"
                >
                    Удалить
                </button>
                <div v-else></div>

                <button
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 cursor-pointer"
                    @click="savePost"
                >
                    Сохранить
                </button>
            </div>
        </template>
    </app-modal>
</template>

<script setup>
import { reactive, ref } from "vue";
import { faArrowRight, faPlus, faTrashArrowUp } from "@fortawesome/free-solid-svg-icons";

const slug = window.location.href.split('/').pop();
const sourceSlug = ref(slug)
const attachments = ref([])
const optionPosts = ref([])
const postModal = ref(null)
const editingPostAttachments = ref([])

const option = ref({
    id: null,
    name: null,
    published: true,
    iconAttachment: null,
})

const initialPostState = () => ({
    id: null,
    name: '',
    name_slug: null,
    description: '',
    published: true,
})

const editingPost = reactive(initialPostState())

const resetEditingPost = () => {
    Object.assign(editingPost, initialPostState())
    editingPostAttachments.value = []
}

const applyOptionFromResponse = (data) => {
    option.value = {
        id: data.id,
        name: data.name,
        published: !!data.published,
        iconAttachment: data.icon_attachment || null,
    }

    attachments.value = data.attachments || []
    optionPosts.value = (data.posts || []).map((post) => ({
        id: post.id,
        name: post.name,
        name_slug: post.name_slug,
        description: post.description,
        published: !!post.published,
        attachments: post.attachments || [],
    }))
}

if (slug !== 'option' && slug !== 'create') {
    axios.get('/admin/options/' + slug + '/read').then((resp) => {
        applyOptionFromResponse(resp.data.data)
    }).catch(() => {})
}

const submit = () => {
    const payload = {
        id: option.value.id,
        name: option.value.name,
        published: option.value.published ? 1 : 0,
        icon_attachment_id: option.value.iconAttachment?.id || null,
        attachment_ids: attachments.value.map((attachment) => attachment.id),
    }

    if (option.value.id) {
        axios.post('/admin/options/' + sourceSlug.value + '/update', payload)
            .then(() => {
                window.location.reload();
            });
    } else {
        axios.post('/admin/options/create', payload)
            .then(() => {
                window.location.href = '/admin/options'
            });
    }
}

const remove = () => {
    axios.post('/admin/options/' + sourceSlug.value + '/delete')
        .then(() => {
            window.location.href = '/admin/options'
        });
}

const uploadOptionIcon = async (event) => {
    const file = event.target.files?.[0]
    if (!file) {
        return
    }

    const formData = new FormData()
    formData.append('file', file)
    formData.append('attachmentableType', 'OPTION_ICON')

    try {
        const resp = await axios.post('/uploadFile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })

        option.value.iconAttachment = resp.data?.data || null
    } finally {
        event.target.value = ''
    }
}

const removeOptionIcon = () => {
    option.value.iconAttachment = null
}

const openCreatePostModal = async () => {
    resetEditingPost()
    await postModal.value?.show()
}

const openEditPostModal = async (post) => {
    Object.assign(editingPost, {
        id: post.id,
        name: post.name,
        name_slug: post.name_slug,
        description: post.description || '',
        published: !!post.published,
    })
    editingPostAttachments.value = [...(post.attachments || [])]
    await postModal.value?.show()
}

const upsertPostInList = (postData) => {
    const normalized = {
        id: postData.id,
        name: postData.name,
        name_slug: postData.name_slug,
        description: postData.description,
        published: !!postData.published,
        attachments: postData.attachments || [],
    }

    const index = optionPosts.value.findIndex((item) => item.id === normalized.id)
    if (index === -1) {
        optionPosts.value = [...optionPosts.value, normalized].sort((a, b) => a.name.localeCompare(b.name))
        return
    }

    optionPosts.value[index] = normalized
    optionPosts.value = [...optionPosts.value]
}

const savePost = () => {
    const payload = {
        name: editingPost.name,
        description: editingPost.description,
        published: editingPost.published ? 1 : 0,
        attachment_ids: editingPostAttachments.value.map((attachment) => attachment.id),
    }

    if (editingPost.id) {
        axios.post(`/admin/options/${sourceSlug.value}/posts/${editingPost.name_slug}/update`, payload)
            .then((resp) => {
                upsertPostInList(resp.data.data)
                postModal.value?.hide()
                resetEditingPost()
            });
        return
    }

    axios.post(`/admin/options/${sourceSlug.value}/posts/create`, payload)
        .then((resp) => {
            upsertPostInList(resp.data.data)
            postModal.value?.hide()
            resetEditingPost()
        });
}

const removePost = (post, fromModal = false) => {
    if (!post?.id) {
        return
    }

    axios.post(`/admin/options/${sourceSlug.value}/posts/${post.name_slug}/delete`)
        .then(() => {
            optionPosts.value = optionPosts.value.filter((item) => item.id !== post.id)
            if (fromModal) {
                postModal.value?.hide()
                resetEditingPost()
            }
        })
}
</script>
