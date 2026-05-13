<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    newsSlug: {
        type: String,
        required: true,
    },
});

const item = ref({
    name: '',
    description: '',
    images: [],
});

const isLoaded = ref(false);
const activeImageIndex = ref(0);

const breadcrumbItems = computed(() => [
    { label: 'Новости', href: '/news' },
    { label: item.value.name, current: true },
]);

const activeImage = computed(() => item.value.images[activeImageIndex.value] || null);

axios.get(`/news/${props.newsSlug}/data`)
    .then((resp) => {
        item.value = {
            name: resp.data?.data?.name || '',
            description: resp.data?.data?.description || '',
            images: resp.data?.data?.images || [],
        };
    })
    .catch(() => {})
    .finally(() => {
        isLoaded.value = true;
    });
</script>

<template>
    <div class="news-item-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            :title="item.name"
            :min-height="400"
            copy-max-width="980px"
        />

        <section class="news-item-page__content">
            <div class="container mx-auto px-4">
                <div v-if="activeImage" class="news-item-page__gallery">
                    <div class="news-item-page__lead-media">
                        <img
                            :src="activeImage.url"
                            :alt="activeImage.title || item.name"
                            class="news-item-page__lead-image"
                        >
                    </div>

                    <div v-if="item.images.length > 1" class="news-item-page__thumbs">
                        <button
                            v-for="(image, index) in item.images"
                            :key="image.id"
                            type="button"
                            class="news-item-page__thumb"
                            :class="{ 'is-active': index === activeImageIndex }"
                            @click="activeImageIndex = index"
                        >
                            <img
                                :src="image.url"
                                :alt="image.title || `${item.name} ${index + 1}`"
                                class="news-item-page__thumb-image"
                            >
                        </button>
                    </div>

                    <div v-else class="news-item-page__thumbs news-item-page__thumbs--placeholder">
                        <div class="news-item-page__placeholder">
                            <div class="news-item-page__placeholder-icon">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path
                                        d="M7 17.5h10M7 13h10M9 8.5h6M8.8 3.5h6.4c1.68 0 2.52 0 3.16.33a3 3 0 0 1 1.31 1.31c.33.64.33 1.48.33 3.16v7.4c0 1.68 0 2.52-.33 3.16a3 3 0 0 1-1.31 1.31c-.64.33-1.48.33-3.16.33H8.8c-1.68 0-2.52 0-3.16-.33a3 3 0 0 1-1.31-1.31c-.33-.64-.33-1.48-.33-3.16V8.3c0-1.68 0-2.52.33-3.16a3 3 0 0 1 1.31-1.31c.64-.33 1.48-.33 3.16-.33Z"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                            <p class="news-item-page__placeholder-text"></p>
                        </div>
                    </div>
                </div>

                <article v-if="item.description" class="news-item-page__article">
                    <p class="news-item-page__description">{{ item.description }}</p>
                </article>

                <div v-else-if="isLoaded" class="news-item-page__empty">
                    Описание новости пока не добавлено.
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.news-item-page__content {
    padding: 72px 0 88px;
    background: var(--color-white);
}

.news-item-page__gallery {
    display: grid;
    grid-template-columns: minmax(0, 1.22fr) minmax(220px, 0.48fr);
    gap: 20px;
    align-items: start;
    margin-bottom: 36px;
}

.news-item-page__lead-media {
    overflow: hidden;
    border-radius: 28px;
    background: #edf6fb;
}

.news-item-page__lead-image {
    display: block;
    width: 100%;
    height: auto;
    max-height: 560px;
    object-fit: cover;
}

.news-item-page__thumbs {
    display: grid;
    grid-template-columns: 1fr;
    gap: 14px;
}

.news-item-page__thumb {
    overflow: hidden;
    border: 2px solid transparent;
    border-radius: 18px;
    background: transparent;
    transition: border-color 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955), transform 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.news-item-page__thumb.is-active {
    border-color: var(--color-secondary-500);
}

.news-item-page__thumb:hover {
    transform: translateY(-2px);
}

.news-item-page__thumb-image {
    display: block;
    width: 100%;
    height: 131px;
    object-fit: cover;
}

.news-item-page__thumbs--placeholder {
    min-height: 100%;
}

.news-item-page__placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 14px;
    min-height: 100%;
    height: 100%;
    padding: 28px 24px;
    border: 1px dashed rgba(83, 165, 220, 0.32);
    border-radius: 24px;
    background:
        radial-gradient(circle at top left, rgba(83, 165, 220, 0.16), transparent 48%),
        linear-gradient(180deg, rgba(240, 249, 255, 0.92), rgba(255, 255, 255, 0.98));
    text-align: center;
}

.news-item-page__placeholder-icon {
    display: grid;
    place-items: center;
    width: 62px;
    height: 62px;
    border-radius: 999rem;
    background: rgba(83, 165, 220, 0.12);
    color: var(--color-secondary-500);
}

.news-item-page__placeholder-icon svg {
    width: 28px;
    height: 28px;
}

.news-item-page__placeholder-text {
    margin: 0;
    color: rgba(11, 40, 59, 0.68);
    font-size: 0.95rem;
    line-height: 1.5;
}

.news-item-page__article {
    max-width: 980px;
}

.news-item-page__description {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.75;
    white-space: pre-line;
}

.news-item-page__empty {
    color: rgba(11, 40, 59, 0.72);
    font-size: 1rem;
    line-height: 1.6;
}

@media (max-width: 767px) {
    .news-item-page__content {
        padding: 52px 0 64px;
    }

    .news-item-page__gallery {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .news-item-page__lead-media {
        border-radius: 22px;
    }

    .news-item-page__thumbs {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .news-item-page__thumb {
        border-radius: 14px;
    }

    .news-item-page__thumb-image {
        height: 92px;
    }

    .news-item-page__placeholder {
        min-height: 140px;
        border-radius: 18px;
    }
}
</style>
