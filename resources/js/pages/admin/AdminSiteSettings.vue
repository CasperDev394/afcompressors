<template>
    <form class="pl-65 pt-20 pb-24" @submit.prevent="submit">
        <div class="max-w-5xl mx-auto flex flex-col gap-5 text-white">
            <section class="bg-white/5 backdrop-blur-md rounded-xl p-6">
                <h2 class="text-2xl font-bold mb-6">Контакты</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-gray-300">Телефон</span>
                        <input
                            v-model="settings.phone"
                            type="text"
                            autocomplete="tel"
                            class="bg-white/5 text-white border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-gray-500"
                            placeholder="+7 999 999 99 99"
                        >
                        <span v-if="errors.phone" class="text-sm text-red-400">{{ errors.phone }}</span>
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-gray-300">Email</span>
                        <input
                            v-model="settings.email"
                            type="email"
                            autocomplete="email"
                            class="bg-white/5 text-white border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-gray-500"
                            placeholder="info@example.com"
                        >
                        <span v-if="errors.email" class="text-sm text-red-400">{{ errors.email }}</span>
                    </label>
                </div>
            </section>

            <section class="bg-white/5 backdrop-blur-md rounded-xl p-6">
                <h2 class="text-2xl font-bold mb-6">SEO главной страницы</h2>

                <div class="flex flex-col gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-gray-300">H1</span>
                        <input
                            v-model="settings.home_h1"
                            type="text"
                            class="bg-white/5 text-white border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-gray-500"
                        >
                        <span v-if="errors.home_h1" class="text-sm text-red-400">{{ errors.home_h1 }}</span>
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-gray-300">Title</span>
                        <input
                            v-model="settings.home_title"
                            type="text"
                            class="bg-white/5 text-white border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-gray-500"
                        >
                        <span v-if="errors.home_title" class="text-sm text-red-400">{{ errors.home_title }}</span>
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-gray-300">Description</span>
                        <textarea
                            v-model="settings.home_description"
                            rows="5"
                            class="bg-white/5 text-white border border-white/10 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-gray-500 resize-y"
                        ></textarea>
                        <span v-if="errors.home_description" class="text-sm text-red-400">{{ errors.home_description }}</span>
                    </label>
                </div>
            </section>

            <p v-if="message" class="text-sm" :class="messageType === 'success' ? 'text-emerald-400' : 'text-red-400'">
                {{ message }}
            </p>
        </div>

        <div class="admin-bottom-bar fixed px-4 bottom-0 left-0 right-0 z-20 h-14 border-t border-white/10 bg-zinc-900/95 backdrop-blur-md flex items-center">
            <button
                type="submit"
                :disabled="isSaving || isLoading"
                class="ml-4 bg-emerald-600 hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-50 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2"
            >
                {{ isSaving ? 'Сохранение…' : 'Сохранить' }}
                <svg-icon size="16" :fa-icon="faArrowRight" />
            </button>
        </div>
    </form>
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue';
import { faArrowRight } from '@fortawesome/free-solid-svg-icons';

const settings = reactive({
    phone: '',
    email: '',
    home_h1: '',
    home_title: '',
    home_description: '',
});

const errors = reactive({});
const isLoading = ref(true);
const isSaving = ref(false);
const message = ref('');
const messageType = ref('success');

const applySettings = (data) => {
    settings.phone = data.phone || '';
    settings.email = data.email || '';
    settings.home_h1 = data.home_h1 || '';
    settings.home_title = data.home_title || '';
    settings.home_description = data.home_description || '';
};

const clearErrors = () => {
    Object.keys(errors).forEach((key) => delete errors[key]);
};

onMounted(async () => {
    try {
        const response = await axios.get('/admin/settings/read');
        applySettings(response.data.data);
    } catch (error) {
        message.value = 'Не удалось загрузить настройки.';
        messageType.value = 'error';
    } finally {
        isLoading.value = false;
    }
});

const submit = async () => {
    clearErrors();
    message.value = '';
    isSaving.value = true;

    try {
        const response = await axios.post('/admin/settings/update', settings);
        applySettings(response.data.data);
        message.value = 'Настройки сохранены.';
        messageType.value = 'success';
    } catch (error) {
        const validationErrors = error.response?.data?.errors || {};
        Object.entries(validationErrors).forEach(([field, messages]) => {
            errors[field] = messages[0];
        });
        message.value = Object.keys(validationErrors).length
            ? 'Проверьте заполнение полей.'
            : 'Не удалось сохранить настройки.';
        messageType.value = 'error';
    } finally {
        isSaving.value = false;
    }
};
</script>
