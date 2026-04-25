<script setup>
import { computed, ref } from 'vue';

const options = ref([]);
const isLoaded = ref(false);

const breadcrumbItems = [
    { label: 'Технология AF' },
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
        <section class="options-page__hero">
            <div class="container mx-auto px-4 h-full">
                <div class="options-page__hero-inner">
                    <breadcrumbs :items="breadcrumbItems" />

                    <div class="options-page__hero-copy">
                        <h1 class="options-page__title">Опции</h1>
                    </div>
                </div>
            </div>
        </section>

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
    </div>
</template>

<style scoped>
.options-page__hero {
    min-height: 400px;
    background: var(--color-primary-800);
}

.options-page__hero-inner {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 48px;
    min-height: 400px;
    padding: 48px 0 56px;
}

.options-page__hero-copy {
    max-width: 820px;
}

.options-page__title {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3rem, 2.4rem + 1.6vw, 4.6rem);
    font-weight: 300;
    line-height: 0.98;
}

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
    .options-page__hero-inner {
        gap: 28px;
        min-height: 400px;
        padding: 32px 0 40px;
    }

    .options-page__content {
        padding: 52px 0 64px;
    }

    .options-page__spacer {
        height: 56px;
    }
}
</style>
