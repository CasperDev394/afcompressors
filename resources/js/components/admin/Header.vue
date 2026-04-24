<template>
    <header class="admin-header fixed w-full z-50 bg-gray backdrop-blur-md border-b border-white/10">
        <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="admin-header-inner flex flex-row justify-center md:justify-between items-center h-14 md:h-16 text-gray-500">

                <div class="flex items-center">
                    <a class="w-60" href="/admin/info">
<!--                        <img class="h-12 md:h-13" :src="'/assets/icon.webp'" alt="" sizes="" srcset="">-->
                        <h3 class="text-lg font-semibold text-white mb-4">Afcompressors</h3>
                    </a>

                    <div>
                        <h2 class="text-2xl  font-bold">{{h1}}</h2>
                    </div>
                </div>
                <div class="flex gap-8">
                    <a class="flex flex-row justify-between items-center" href="/" target="_blank">
                        <svg-icon size="16" :fa-icon="faRightFromBracket" />
                        &nbsp;
                        Сайт
                    </a>
                    <a class="flex flex-row justify-between items-center" href="/logout">
                        <svg-icon size="16" :fa-icon="faRightFromBracket" />
                        &nbsp;
                        Выход
                    </a>
                </div>
            </div>
        </div>
    </header>
</template>
<script setup>
import {faRightFromBracket} from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    h1: {
        type: String,
        required: true
    }
})

</script>

<style scoped lang="scss">
@media (max-height: 500px) and (orientation: landscape) {
    .admin-header-inner {
        height: 52px;
    }

    .admin-header h2 {
        font-size: 1.25rem;
    }

    .admin-header h3 {
        font-size: 1rem;
        margin-bottom: 0;
    }
}
</style>
