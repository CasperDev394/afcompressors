<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-content-start py-10 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Вход в личный кабинет
            </h2>
<!--            <p class="mt-2 text-center text-sm text-gray-600">-->
<!--                Или-->
<!--                <a href="/register" class="font-medium text-primary-600 hover:text-primary-500">-->
<!--                    зарегистрируйтесь-->
<!--                </a>-->
<!--            </p>-->
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <div class="mt-1">
                            <input
                                id="email"
                                name="email"
                                v-model="email"
                                type="email"
                                autocomplete="email"
                                autofocus
                                placeholder="email"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-gray-900 caret-gray-900 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Пароль
                        </label>
                        <div class="mt-1">
                            <input
                                id="password"
                                name="password"
                                v-model="password"
                                type="password"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-gray-900 caret-gray-900 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                            >
                        </div>
                    </div>

<!--                    <div class="flex items-center justify-between">-->
<!--                        <div class="flex items-center">-->
<!--                            <input-->
<!--                                id="remember-me"-->
<!--                                type="checkbox"-->
<!--                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"-->
<!--                            >-->
<!--                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">-->
<!--                                Запомнить меня-->
<!--                            </label>-->
<!--                        </div>-->

<!--                        <div class="text-sm">-->
<!--                            <a href="/forgot-password" class="font-medium text-primary-600 hover:text-primary-500">-->
<!--                                Забыли пароль?-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="space-y-4">-->
<!--                        <div class="flex items-start">-->
<!--                            <div class="flex items-center h-5">-->
<!--                                <input-->
<!--                                    id="terms"-->
<!--                                    type="checkbox"-->
<!--                                    class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded"-->
<!--                                >-->
<!--                            </div>-->
<!--                            <div class="ml-3 text-sm">-->
<!--                                <label for="terms" class="font-medium text-gray-700">-->
<!--                                    Я согласен с обработкой персональных данных-->
<!--                                </label>-->
<!--                                <p class="text-gray-500">-->
<!--                                    Нажимая "Войти", вы принимаете наши-->
<!--                                    <a href="/privacy" class="font-medium text-primary-600 hover:text-primary-500">-->
<!--                                        Условия использования-->
<!--                                    </a>-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="flex items-start">-->
<!--                            <div class="flex items-center h-5">-->
<!--                                <input-->
<!--                                    id="newsletter"-->
<!--                                    type="checkbox"-->
<!--                                    class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded"-->
<!--                                >-->
<!--                            </div>-->
<!--                            <div class="ml-3 text-sm">-->
<!--                                <label for="newsletter" class="font-medium text-gray-700">-->
<!--                                    Я согласен получать новости и предложения-->
<!--                                </label>-->
<!--                                <p class="text-gray-500">-->
<!--                                    Вы можете отписаться от рассылки в любой момент-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div>
                        <button
                            @click="()=>{}"
                            type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                        >
                            Войти
                        </button>
                    </div>
                </div>

                <div class="mt-6">
<!--                    <div class="relative">-->
<!--                        <div class="absolute inset-0 flex items-center">-->
<!--                            <div class="w-full border-t border-gray-300"></div>-->
<!--                        </div>-->
<!--                        <div class="relative flex justify-center text-sm">-->
<!--                        <span class="px-2 bg-white text-gray-500">-->
<!--                            Или войдите через-->
<!--                        </span>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="mt-6 grid grid-cols-2 gap-3">-->
<!--                        <div>-->
<!--                            <button-->
<!--                                type="button"-->
<!--                                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"-->
<!--                            >-->
<!--                                <span class="sr-only">Войти через Google</span>-->
<!--                                <svg class="w-5 h-5" viewBox="0 0 24 24">-->
<!--                                    <path-->
<!--                                        fill="currentColor"-->
<!--                                        d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </button>-->
<!--                        </div>-->

<!--                        <div>-->
<!--                            <button-->
<!--                                type="button"-->
<!--                                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"-->
<!--                            >-->
<!--                                <span class="sr-only">Войти через VK</span>-->
<!--                                <svg class="w-5 h-5" viewBox="0 0 24 24">-->
<!--                                    <path-->
<!--                                        fill="currentColor"-->
<!--                                        d="M15.07,2H8.93C3.33,2,2,3.33,2,8.93v6.14C2,20.67,3.33,22,8.93,22h6.14c5.6,0,6.93-1.33,6.93-6.93V8.93C22,3.33,20.67,2,15.07,2z M18.15,16.27c-.13,1.22-.7,2.07-1.62,2.7c-1.11,0.77-2.77,1.11-4.04,1.11c-1.4,0-1.81-.85-2.6-.85c-0.78,0-1.26,0.55-2.02,0.85c-0.76,0.3-1.74,0.62-2.97,0.62c-1.01,0-1.81-.39-2.4-1.15c-0.59-0.76-0.9-1.73-0.9-2.85c0-1.22,0.39-2.39,1.17-3.5c0.78-1.11,1.73-1.95,2.85-2.52c1.12-0.57,2.3-0.85,3.54-0.85c1.51,0,2.65,0.39,3.43,1.17c0.78,0.78,1.17,1.92,1.17,3.43c0,0.13-0.01,0.26-0.02,0.39c0.13,0.02,0.26,0.03,0.39,0.03c1.22,0,2.39-0.39,3.5-1.17c1.11-0.78,1.95-1.73,2.52-2.85c0.57-1.12,0.85-2.3,0.85-3.54c0-1.51-0.39-2.65-1.17-3.43c-0.78-0.78-1.92-1.17-3.43-1.17c-1.24,0-2.42,0.28-3.54,0.85c-1.12,0.57-2.07,1.41-2.85,2.52c-0.78,1.11-1.17,2.28-1.17,3.5c0,1.22,0.39,2.39,1.17,3.5c0.78,1.11,1.73,1.95,2.85,2.52c1.12,0.57,2.3,0.85,3.54,0.85c1.51,0,2.65-0.39,3.43-1.17c0.78-0.78,1.17-1.92,1.17-3.43c0-0.13,0.01-0.26,0.02-0.39c-0.13-0.02-0.26-0.03-0.39-0.03c-1.22,0-2.39,0.39-3.5,1.17c-1.11,0.78-1.95,1.73-2.52,2.85c-0.57,1.12-0.85,2.3-0.85,3.54c0,1.51,0.39,2.65,1.17,3.43c0.78,0.78,1.92,1.17,3.43,1.17c1.24,0,2.42-0.28,3.54-0.85c1.12-0.57,2.07-1.41,2.85-2.52c0.78-1.11,1.17-2.28,1.17-3.5C19.32,14.54,18.28,15.05,18.15,16.27z"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {ref} from 'vue'
const email = ref('');
const password = ref('');

</script>
