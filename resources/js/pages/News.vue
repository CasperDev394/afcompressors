<script setup>
import { ref } from 'vue';

const items = ref([]);
const isLoaded = ref(false);

const breadcrumbItems = [
    { label: 'Новости', current: true },
];

axios.get('/news/data')
    .then((resp) => {
        items.value = resp.data?.data || [];
    })
    .catch(() => {})
    .finally(() => {
        isLoaded.value = true;
    });
</script>

<template>
    <div class="news-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Новости"
            :min-height="400"
        />

        <section class="news-page__content">
            <div class="container mx-auto px-4">
                <div v-if="items.length" class="news-page__grid">
                    <a
                        v-for="item in items"
                        :key="item.id"
                        :href="item.href"
                        class="news-page__card"
                    >
                        <div
                            class="news-page__card-media"
                            :class="{ 'news-page__card-media--gradient': !item.image }"
                        >
                            <img
                                v-if="item.image"
                                :src="item.image.url"
                                :alt="item.image.title || item.name"
                                class="news-page__card-image"
                            >

                            <div class="news-page__card-overlay"></div>

                            <div class="news-page__card-copy">
                                <h2 class="news-page__card-title">{{ item.name }}</h2>
                            </div>
                        </div>
                    </a>
                </div>

                <div v-else-if="isLoaded" class="news-page__empty">
                    Новости пока не опубликованы.
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.news-page__content {
    padding: 72px 0 88px;
    background: var(--color-white);
}

.news-page__grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
}

.news-page__card {
    display: block;
    text-decoration: none;
}

.news-page__card-media {
    position: relative;
    min-height: 360px;
    border-radius: 28px;
    overflow: hidden;
    background: #dbeaf6;
    isolation: isolate;
}

.news-page__card-media--gradient {
    background:
        radial-gradient(circle at top left, rgba(83, 165, 220, 0.34), transparent 52%),
        linear-gradient(135deg, rgba(11, 40, 59, 0.96), rgba(83, 165, 220, 0.88));
}

.news-page__card-image {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 360px;
    object-fit: cover;
    transition: transform 350ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.news-page__card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(11, 40, 59, 0.12), rgba(11, 40, 59, 0.78));
    transition: background-color 350ms cubic-bezier(0.455, 0.03, 0.515, 0.955), opacity 350ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.news-page__card-copy {
    position: absolute;
    inset: auto 0 0 0;
    padding: 28px;
}

.news-page__card-title {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.6rem, 1.4684210526rem + 0.350877193vw, 2.1rem);
    font-weight: 300;
    line-height: 1.02;
    transition: color 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955), transform 350ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.news-page__card:hover .news-page__card-image {
    transform: scale(1.06);
}

.news-page__card:hover .news-page__card-overlay {
    background: linear-gradient(180deg, rgba(11, 40, 59, 0.22), rgba(11, 40, 59, 0.9));
}

.news-page__card:hover .news-page__card-title {
    color: var(--color-secondary-400);
    transform: translateY(-4px);
}

.news-page__empty {
    color: rgba(11, 40, 59, 0.72);
    font-size: 1rem;
    line-height: 1.6;
}

@media (max-width: 1023px) {
    .news-page__grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 767px) {
    .news-page__content {
        padding: 52px 0 64px;
    }

    .news-page__grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .news-page__card-media,
    .news-page__card-image {
        min-height: 300px;
        border-radius: 22px;
    }

    .news-page__card-copy {
        padding: 22px;
    }
}
</style>
