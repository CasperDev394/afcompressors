<script setup>
import { ref, computed } from 'vue';

const options = ref([]);
const isLoaded = ref(false);

const breadcrumbItems = [
    { label: 'Технология AF', href: '/af-technology' },
    { label: 'Опции', current: true },
];

const ecoOptions = computed(() => options.value.filter((item) => item.eco));
const technicalOptions = computed(() => options.value.filter((item) => !item.eco));

axios.get('/options/data')
    .then((resp) => {
        options.value = resp.data?.data || [];
    })
    .catch(() => {})
    .finally(() => {
        isLoaded.value = true;
    });
</script>

<template>
    <div class="options-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Опции"
            :min-height="400"
        />

        <section class="options-page__content">
            <div class="container mx-auto px-4">
                <options-grid-block
                    v-if="ecoOptions.length"
                    title="Варианты экономии энергии и средств"
                    :items="ecoOptions"
                />

                <div v-if="ecoOptions.length && technicalOptions.length" class="options-page__spacer"></div>

                <options-grid-block
                    v-if="technicalOptions.length"
                    title="Технические характеристики"
                    :items="technicalOptions"
                />

                <div v-if="isLoaded && !options.length" class="options-page__empty">
                    Опции пока не опубликованы.
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.options-page__content {
    padding: 72px 0 88px;
    background: var(--color-white);
}

.options-page__spacer {
    height: 92px;
}

.options-page__empty {
    color: rgba(11, 40, 59, 0.72);
    font-size: 1rem;
    line-height: 1.6;
}

@media (max-width: 767px) {
    .options-page__content {
        padding: 52px 0 64px;
    }

    .options-page__spacer {
        height: 56px;
    }
}
</style>
