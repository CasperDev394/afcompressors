<script setup>
import Breadcrumbs from './Breadcrumbs.vue';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        required: true,
    },
    subtitle: {
        type: String,
        default: '',
    },
    description: {
        type: String,
        default: '',
    },
    minHeight: {
        type: Number,
        default: 400,
    },
    copyMaxWidth: {
        type: String,
        default: '820px',
    },
});
</script>

<template>
    <section class="site-hero" :style="{ '--site-hero-min-height': `${minHeight}px`, '--site-hero-copy-max-width': copyMaxWidth }">
        <div class="container mx-auto px-4 h-full">
            <div class="site-hero__inner">
                <Breadcrumbs :items="breadcrumbs" />

                <div class="site-hero__copy">
                    <h1 class="site-hero__title">{{ title }}</h1>

                    <h2 v-if="subtitle" class="site-hero__subtitle">{{ subtitle }}</h2>

                    <p v-if="description" class="site-hero__description">{{ description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.site-hero {
    min-height: var(--site-hero-min-height);
    background: var(--color-primary-800);
}

.site-hero__inner {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 48px;
    min-height: var(--site-hero-min-height);
    padding: 48px 0 56px;
}

.site-hero__copy {
    display: flex;
    flex-direction: column;
    gap: 22px;
    max-width: var(--site-hero-copy-max-width);
}

.site-hero__title {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3rem, 2.4rem + 1.6vw, 4.6rem);
    font-weight: 300;
    line-height: 0.98;
}

.site-hero__subtitle {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.5rem, 1.2368421053rem + 0.701754386vw, 2.5rem);
    font-weight: 300;
    line-height: 1.08;
}

.site-hero__description {
    margin: 0;
    max-width: 760px;
    color: rgba(255, 255, 255, 0.92);
    font-size: 1rem;
    line-height: 1.7;
    white-space: pre-line;
}

@media (max-width: 767px) {
    .site-hero__inner {
        gap: 28px;
        padding: 32px 0 40px;
    }

    .site-hero__copy {
        gap: 18px;
    }
}
</style>
