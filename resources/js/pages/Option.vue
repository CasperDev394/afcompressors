<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    optionSlug: {
        type: String,
        required: true,
    },
});

const option = ref({
    name: '',
    icon_attachment: null,
    posts: [],
});

const isLoaded = ref(false);

const breadcrumbItems = computed(() => [
    { label: 'Технология AF', href: '/af-technology' },
    { label: 'Опции', href: '/options' },
    { label: option.value.name, current: true },
]);

axios.get(`/options/${props.optionSlug}/data`)
    .then((resp) => {
        option.value = {
            name: resp.data?.data?.name || '',
            icon_attachment: resp.data?.data?.icon_attachment || null,
            posts: resp.data?.data?.posts || [],
        };
    })
    .catch(() => {})
    .finally(() => {
        isLoaded.value = true;
    });

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
        return;
    }

    window.location.href = '/';
};
</script>

<template>
    <div class="option-page">
        <section class="option-page__hero">
            <div class="container mx-auto px-4 h-full">
                <div class="option-page__hero-inner">
                    <div class="option-page__hero-top">
                        <breadcrumbs :items="breadcrumbItems" />

                        <button type="button" class="option-page__back-button" @click="goBack">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path
                                    d="M19 12H5M11 18l-6-6 6-6"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <span>опции</span>
                        </button>
                    </div>

                    <div class="option-page__hero-copy">
                        <div v-if="option.icon_attachment" class="option-page__icon-shell">
                            <img
                                :src="option.icon_attachment.url"
                                :alt="option.icon_attachment.title || option.name"
                                class="option-page__icon"
                            >
                        </div>

                        <div class="option-page__hero-text">
                            <p class="option-page__eyebrow">опция</p>
                            <h1 class="option-page__title">
                                {{ option.name }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="option-page__posts">
            <div class="container mx-auto px-4">
                <div v-if="option.posts.length" class="option-page__posts-list">
                    <article
                        v-for="(post, index) in option.posts"
                        :key="post.id"
                        class="option-page__post"
                        :class="{ 'is-reversed': index % 2 === 1 }"
                    >
                        <div v-if="post.image" class="option-page__post-media">
                            <img
                                :src="post.image.url"
                                :alt="post.image.title || post.name"
                                class="option-page__post-image"
                            >
                        </div>

                        <div class="option-page__post-copy">
                            <h2 class="site-h2 option-page__post-title">{{ post.name }}</h2>
                            <p v-if="post.description" class="option-page__post-description">
                                {{ post.description }}
                            </p>
                        </div>
                    </article>
                </div>

                <div v-else-if="isLoaded" class="option-page__empty">
                    Посты пока не опубликованы.
                </div>
            </div>
        </section>

        <services-section />
    </div>
</template>

<style scoped>
.option-page__hero {
    min-height: 400px;
    background: var(--color-primary-800);
}

.option-page__hero-inner {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 48px;
    min-height: 400px;
    padding: 48px 0 56px;
}

.option-page__hero-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
}

.option-page__back-button {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    min-height: 56px;
    padding: 12px 24px;
    border: 1px solid var(--color-secondary-500);
    border-radius: 999rem;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 400;
    line-height: 1;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    transition: background-color 0.25s ease, color 0.25s ease;
}

.option-page__back-button:hover {
    background: var(--color-secondary-500);
    color: var(--color-white);
}

.option-page__back-button svg {
    width: 20px;
    height: 20px;
}

.option-page__hero-copy {
    display: flex;
    align-items: center;
    gap: 16px;
    max-width: 820px;
}

.option-page__hero-text {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.option-page__eyebrow {
    color: var(--color-primary-400);
    font-size: 1.3rem;
    line-height: 0.7;
}

.option-page__icon-shell {
    position: relative;
    width: 79px;
    height: 79px;
    border-radius: 999px;
    background: hsla(0, 0%, 100%, 0.12);
    overflow: hidden;
    flex: 0 0 auto;
}

.option-page__icon {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50%;
    height: 50%;
    object-fit: contain;
    object-position: center;
    transform: translate(-50%, -50%);
    filter: brightness(0) saturate(100%) invert(56%) sepia(78%) saturate(552%) hue-rotate(175deg) brightness(99%) contrast(74%);
    transition: all 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.option-page__title {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3rem, 2.4rem + 1.6vw, 4.6rem);
    font-weight: 300;
    line-height: 0.98;
}

.option-page__posts {
    padding: 72px 0 88px;
    background: var(--color-white);
}

.option-page__posts-list {
    display: flex;
    flex-direction: column;
    gap: 56px;
}

.option-page__post {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    align-items: center;
    gap: 40px;
}

.option-page__post.is-reversed .option-page__post-media {
    order: 2;
}

.option-page__post.is-reversed .option-page__post-copy {
    order: 1;
}

.option-page__post-media {
    width: 100%;
}

.option-page__post-image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 24px;
    object-fit: cover;
}

.option-page__post-copy {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.option-page__post-title {
    margin: 0;
}

.option-page__post-description {
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.7;
    white-space: pre-line;
}

.option-page__empty {
    color: rgba(11, 40, 59, 0.72);
    font-size: 1rem;
    line-height: 1.6;
}

@media (max-width: 767px) {
    .option-page__hero {
        min-height: 420px;
    }

    .option-page__hero-inner {
        min-height: 420px;
        gap: 28px;
        padding: 32px 0 40px;
    }

    .option-page__hero-top {
        flex-direction: column;
        align-items: stretch;
    }

    .option-page__back-button {
        width: 100%;
        justify-content: center;
    }

    .option-page__icon-shell {
        width: 64px;
        height: 64px;
    }

    .option-page__hero-copy {
        align-items: flex-start;
    }

    .option-page__posts {
        padding: 52px 0 64px;
    }

    .option-page__posts-list {
        gap: 40px;
    }

    .option-page__post,
    .option-page__post.is-reversed {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .option-page__post.is-reversed .option-page__post-media,
    .option-page__post.is-reversed .option-page__post-copy {
        order: initial;
    }
}
</style>
