<template>
    <header class="bg-white shadow-sm" :h1="h1">

        <!-- Верхний уровень -->
        <div class="border-b border-gray-100">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center">
                            <span class="text-2xl font-bold text-primary-500">AF compressors</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <nav class="container mx-auto px-4">
                            <ul class="flex items-center space-x-8 py-1">

                            </ul>
                        </nav>
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
</template>
<script setup>
import { ref } from 'vue';

import {faLocationDot} from "@fortawesome/free-solid-svg-icons";


const props = defineProps({
    h1: {
        type: String,
        required: false
    },
})

</script>
