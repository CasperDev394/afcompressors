<script setup>
import { faArrowRight, faLeaf } from '@fortawesome/free-solid-svg-icons';
import { computed } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        required: true,
    },
});

const normalizedTitle = computed(() => props.title.split('\n'));
</script>

<template>
    <section class="options-grid-block">
        <div class="options-grid-block__title-col">
            <h2 class="site-h2 options-grid-block__title">
                <span
                    v-for="line in normalizedTitle"
                    :key="line"
                    class="options-grid-block__title-line"
                >
                    {{ line }}
                </span>
            </h2>
        </div>

        <div class="options-grid-block__grid">
            <article
                v-for="item in items"
                :key="item.id"
                class="options-grid-block__card"
            >
                <a :href="`/options/${item.name_slug}`" class="options-grid-block__main-link">
                    <div class="options-grid-block__visual">
                        <span
                            v-if="item.eco"
                            class="options-grid-block__eco-badge"
                            aria-hidden="true"
                        >
                            <svg-icon size="14" :fa-icon="faLeaf" />
                        </span>

                        <img
                            v-if="item.icon_attachment"
                            :src="item.icon_attachment.url"
                            :alt="item.icon_attachment.title || item.name"
                            class="options-grid-block__icon"
                        >

                        <span class="options-grid-block__cta">
                            <span class="options-grid-block__cta-label">подробнее</span>
                            <span class="options-grid-block__cta-arrow">
                                <svg-icon size="16" :fa-icon="faArrowRight" />
                            </span>
                        </span>
                    </div>

                    <span class="options-grid-block__name">{{ item.name }}</span>
                </a>
            </article>
        </div>
    </section>
</template>

<style scoped>
.options-grid-block {
    display: grid;
    grid-template-columns: minmax(280px, 1fr) minmax(0, 2fr);
    gap: 28px;
}

.options-grid-block__title {
    margin: 0;
}

.options-grid-block__title-line {
    display: block;
}

.options-grid-block__grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(156px, 1fr));
    gap: 54px 18px;
}

.options-grid-block__card {
    display: flex;
    justify-content: flex-start;
}

.options-grid-block__main-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 18px;
    width: 100%;
    max-width: 190px;
    color: var(--color-primary-800);
    text-decoration: none;
}

.options-grid-block__visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: min(100%, 156px);
    aspect-ratio: 1 / 1;
    overflow: visible;
}

.options-grid-block__visual::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 999px;
    background: #eaf7ff;
    z-index: 0;
}

.options-grid-block__eco-badge {
    position: absolute;
    top: 8px;
    right: 2px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 999px;
    background: #87cc70;
    color: var(--color-white);
    box-shadow: 0 10px 24px rgba(33, 94, 52, 0.2);
    z-index: 2;
}

.options-grid-block__icon {
    position: relative;
    z-index: 1;
    width: 48%;
    height: 48%;
    object-fit: contain;
    object-position: center;
    filter: brightness(0) saturate(100%) invert(56%) sepia(78%) saturate(552%) hue-rotate(175deg) brightness(99%) contrast(74%);
    transition: transform 0.25s ease;
}

.options-grid-block__cta {
    position: absolute;
    left: 50%;
    bottom: 0;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    min-width: 52px;
    height: 32px;
    padding: 0 18px;
    border-radius: 999px;
    background: var(--color-secondary-500);
    color: var(--color-white);
    z-index: 3;
    transform: translate(-50%, 50%);
    overflow: hidden;
    transition: min-width 0.25s ease, transform 0.25s ease;
}

.options-grid-block__cta-label {
    max-width: 0;
    opacity: 0;
    white-space: nowrap;
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.82rem;
    font-weight: 400;
    line-height: 1;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    transition: max-width 0.25s ease, opacity 0.2s ease;
}

.options-grid-block__name {
    display: block;
    max-width: 100%;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1.1rem;
    font-weight: 300;
    line-height: 1.3;
    text-align: center;
    transition: color 0.25s ease;
}

.options-grid-block__main-link:hover .options-grid-block__name {
    color: var(--color-secondary-500);
}

.options-grid-block__main-link:hover .options-grid-block__icon {
    transform: scale(1.04);
}

.options-grid-block__main-link:hover .options-grid-block__cta {
    min-width: 148px;
}

.options-grid-block__main-link:hover .options-grid-block__cta-label {
    max-width: 90px;
    opacity: 1;
}

@media (max-width: 1199px) {
    .options-grid-block {
        grid-template-columns: minmax(240px, 0.95fr) minmax(0, 2.05fr);
    }

    .options-grid-block__grid {
        grid-template-columns: repeat(3, minmax(156px, 1fr));
    }
}

@media (max-width: 991px) {
    .options-grid-block {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .options-grid-block__grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 575px) {
    .options-grid-block__grid {
        grid-template-columns: 1fr;
        gap: 48px 0;
    }

    .options-grid-block__main-link {
        max-width: 172px;
    }
}
</style>
