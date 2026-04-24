<template>
    <footer class="bg-primary-800 text-gray-100">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- О компании -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">О AF compressors</h3>
                    <p class="text-gray-300 mb-4">
                        AF compressors
                    </p>
                    <div class="flex space-x-4">
<!--                        <a href="#" class="text-gray-400 hover:text-secondary-400 transition-colors">-->
<!--                            <span class="sr-only">Facebook</span>-->
<!--                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">-->
<!--                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                        <a href="#" class="text-gray-400 hover:text-secondary-400 transition-colors">-->
<!--                            <span class="sr-only">Twitter</span>-->
<!--                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">-->
<!--                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>-->
<!--                            </svg>-->
<!--                        </a>-->
                    </div>
                </div>

                <!-- Полезные ссылки -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Полезные ссылки</h3>
                    <ul class="space-y-2">
                        <li v-for="link in usefulLinks" :key="link.name">
                            <a :href="link.href" class="text-gray-300 hover:text-secondary-400 transition-colors">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Контакты -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Контакты</h3>
                    <ul class="space-y-2">
                        <li class="text-gray-300">
                            <span class="font-medium text-secondary-400">Email:</span> support@siderdy.ru
                        </li>
<!--                        <li class="text-gray-300">-->
<!--                            <span class="font-medium text-secondary-400">Телефон:</span> 8 (800) 123-45-67-->
<!--                        </li>-->
<!--                        <li class="text-gray-300">-->
<!--                            <span class="font-medium text-secondary-400">Адрес:</span> Москва, ул. Примерная, 123-->
<!--                        </li>-->
                    </ul>
                </div>

                <!-- Подписка -->
<!--                <div>-->
<!--                    <h3 class="text-lg font-semibold text-white mb-4">Подписка на новости</h3>-->
<!--                    <form class="space-y-4">-->
<!--                        <input-->
<!--                            type="email"-->
<!--                            placeholder="Ваш email"-->
<!--                            class="w-full px-4 py-2 bg-primary-700 border border-primary-600 rounded-md focus:ring-secondary-500 focus:border-secondary-500 text-white placeholder-gray-400"-->
<!--                        >-->
<!--                        <button-->
<!--                            type="submit"-->
<!--                            class="w-full bg-secondary-500 text-white px-4 py-2 rounded-md hover:bg-secondary-600 transition-colors"-->
<!--                        >-->
<!--                            Подписаться-->
<!--                        </button>-->
<!--                    </form>-->
<!--                </div>-->
            </div>

            <!-- Нижняя часть -->
            <div class="mt-12 pt-8 border-t border-primary-700">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400">
                        © {{ new Date().getFullYear() }} AF compressors. Все права защищены.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
<!--                        <a href="/privacy" class="text-gray-400 hover:text-secondary-400 transition-colors">-->
<!--                            Политика конфиденциальности-->
<!--                        </a>-->
<!--                        <a href="/terms" class="text-gray-400 hover:text-secondary-400 transition-colors">-->
<!--                            Условия использования-->
<!--                        </a>-->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
const usefulLinks = [
    { name: 'О нас', href: '/about' },
    { name: 'Города', href: '/ru/countries/egipet' },
    // { name: 'Вакансии', href: '/careers' },
    // { name: 'Блог', href: '/blog' },
    // { name: 'FAQ', href: '/faq' }
]
</script>
