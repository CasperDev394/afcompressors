<script setup>
import { computed, ref } from 'vue';
import { solutionCategories } from '../data/solutionCategories';

const props = defineProps({
    categorySlug: {
        type: String,
        required: true,
    },
});

const compressors = ref([]);
const isLoaded = ref(false);
const category = computed(() => solutionCategories[props.categorySlug]);

const breadcrumbItems = computed(() => [
    { label: 'решения', href: '/solutions' },
    { label: category.value?.breadcrumb || '', current: true },
]);

axios.get(`/solutions/${props.categorySlug}/data`)
    .then((resp) => {
        compressors.value = resp.data?.data?.compressors || [];
    })
    .catch(() => {})
    .finally(() => {
        isLoaded.value = true;
    });
</script>

<template>
    <div v-if="category" class="solutions-category-page">
        <section class="solutions-category-page__hero">
            <div class="container mx-auto px-4 h-full">
                <div class="solutions-category-page__hero-inner">
                    <breadcrumbs :items="breadcrumbItems" />
                </div>
            </div>
        </section>

        <section class="solutions-category-page__envelope-wrap">
            <div class="container mx-auto px-4">
                <div class="solutions-category-page__envelope">
                    <div class="solutions-category-page__heading">
                        <h1 class="solutions-category-page__title">
                            <span class="solutions-category-page__title-accent" :class="category.accentClass">
                                {{ category.accentTitle }}
                            </span>
                            <span class="solutions-category-page__title-main">{{ category.title }}</span>
                        </h1>
                    </div>

                    <div class="solutions-category-page__intro">
                        <p class="solutions-category-page__lead">{{ category.lead }}</p>
                        <p class="solutions-category-page__text">{{ category.description }}</p>
                        <ul class="solutions-category-page__list">
                            <li v-for="item in category.bullets" :key="item">{{ item }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="solutions-category-page__catalog">
            <div class="container mx-auto px-4">
                <div v-if="compressors.length" class="solutions-category-page__grid">
                    <a
                        v-for="compressor in compressors"
                        :key="compressor.id"
                        :href="compressor.href"
                        class="solutions-category-page__card"
                    >
                        <div class="solutions-category-page__card-media">
                            <img
                                v-if="compressor.image"
                                :src="compressor.image.url"
                                :alt="compressor.image.title || compressor.name"
                                class="solutions-category-page__card-image"
                            >
                        </div>

                        <div class="solutions-category-page__card-copy">
                            <span class="solutions-category-page__card-name">{{ compressor.name }}</span>

                            <span class="solutions-category-page__card-cta">
                                <span>{{ category.detailsLabel }}</span>
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path
                                        d="M5 12h14M13 6l6 6-6 6"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </span>
                        </div>
                    </a>
                </div>

                <div v-else-if="isLoaded" class="solutions-category-page__empty">
                    Компрессоры этой категории пока не опубликованы.
                </div>
            </div>
        </section>

        <services-section />
    </div>
</template>

<style scoped>
.solutions-category-page {
    background: var(--color-white);
}

.solutions-category-page__hero {
    min-height: 280px;
    background: var(--color-primary-800);
}

.solutions-category-page__hero-inner {
    display: flex;
    align-items: flex-start;
    min-height: 280px;
    padding: 48px 0 96px;
}

.solutions-category-page__envelope-wrap {
    //background: var(--color-white);
}

.solutions-category-page__envelope {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: minmax(280px, 0.92fr) minmax(0, 1.08fr);
    gap: 42px;
    padding: 40px 44px 32px;
    margin-top: -154px;
    margin-bottom: -44px;
    border-radius: 28px 28px 0 0;
    background: var(--color-white);
    box-shadow: -18px -40px 34px rgba(8, 22, 34, 0.07), 18px -20px 16px rgba(8, 22, 34, 0.07);
}

.solutions-category-page__heading {
    padding-top: 6px;
}

.solutions-category-page__title {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin: 0;
}

.solutions-category-page__title-accent,
.solutions-category-page__title-main {
    font-family: stolzl, Helvetica, Arial, sans-serif;
    line-height: 1;
}

.solutions-category-page__title-accent {
    font-size: clamp(2.2rem, 1.8315789474rem + 0.9824561404vw, 3.6rem);
    font-weight: 600;
}

.solutions-category-page__title-accent--secondary {
    color: var(--color-secondary-500);
}

.solutions-category-page__title-accent--primary {
    color: var(--color-primary-400);
}

.solutions-category-page__title-main {
    color: var(--color-primary-800);
    font-size: clamp(2rem, 1.7368421053rem + 0.701754386vw, 3rem);
    font-weight: 300;
}

.solutions-category-page__intro {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding-top: 22px;
}

.solutions-category-page__lead,
.solutions-category-page__text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.68;
}

.solutions-category-page__lead {
    color: var(--color-primary-800);
}

.solutions-category-page__list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin: 0;
    padding-left: 20px;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.62;
}

.solutions-category-page__catalog {
    padding: 124px 0 88px;
    background: var(--color-white);
}

.solutions-category-page__grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px 24px;
}

.solutions-category-page__card {
    display: flex;
    flex-direction: column;
    min-height: 100%;
    padding: 18px;
    border: 1px solid rgba(83, 165, 220, 0.22);
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(248, 251, 253, 1), rgba(255, 255, 255, 1));
    text-decoration: none;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.solutions-category-page__card:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 42px rgba(11, 40, 59, 0.1);
}

.solutions-category-page__card-media {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 280px;
    border-radius: 22px;
    background: rgba(234, 247, 255, 0.74);
    overflow: hidden;
}

.solutions-category-page__card-image {
    display: block;
    width: 100%;
    height: auto;
    max-height: 280px;
    object-fit: contain;
}

.solutions-category-page__card-copy {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 18px 6px 4px;
}

.solutions-category-page__card-name {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1.24rem;
    font-weight: 300;
    line-height: 1.2;
}

.solutions-category-page__card-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    width: fit-content;
    padding: 8px 14px;
    border-radius: 999rem;
    background: var(--color-secondary-500);
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.82rem;
    font-weight: 400;
    letter-spacing: 0.04em;
    opacity: 0;
    transform: translateY(10px);
    text-transform: uppercase;
    transition: opacity 0.25s ease, transform 0.25s ease;
}

.solutions-category-page__card:hover .solutions-category-page__card-cta {
    opacity: 1;
    transform: translateY(0);
}

.solutions-category-page__card-cta svg {
    width: 16px;
    height: 16px;
}

.solutions-category-page__empty {
    color: rgba(11, 40, 59, 0.72);
    font-size: 1rem;
    line-height: 1.6;
}

@media (max-width: 991px) {
    .solutions-category-page__envelope {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .solutions-category-page__intro {
        padding-top: 0;
    }

    .solutions-category-page__grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 767px) {
    .solutions-category-page__hero {
        min-height: 220px;
    }

    .solutions-category-page__hero-inner {
        min-height: 220px;
        padding: 32px 0 84px;
    }

    .solutions-category-page__envelope-wrap {
        background: var(--color-white);
    }

    .solutions-category-page__envelope {
        gap: 22px;
        padding: 28px 20px 24px;
        margin-top: -92px;
        margin-bottom: -28px;
        border-radius: 0 0 24px 24px;
    }

    .solutions-category-page__catalog {
        padding: 84px 0 64px;
    }

    .solutions-category-page__grid {
        grid-template-columns: 1fr;
    }

    .solutions-category-page__card {
        border-radius: 24px;
    }

    .solutions-category-page__card-media {
        min-height: 220px;
        border-radius: 18px;
    }

    .solutions-category-page__card-image {
        max-height: 220px;
    }
}
</style>
