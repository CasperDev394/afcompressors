<script setup>
import { computed, ref } from 'vue';
import { solutionCategories } from '../data/solutionCategories';

const props = defineProps({
    categorySlug: {
        type: String,
        required: true,
    },
    compressorSlug: {
        type: String,
        required: true,
    },
});

const compressor = ref({
    name: '',
    image: null,
    msf: '',
    capacities_iso: '',
});

const models = ref([]);
const options = ref([]);
const isLoaded = ref(false);
const activeTab = ref('specs');

const category = computed(() => solutionCategories[props.categorySlug]);

const breadcrumbItems = computed(() => [
    { label: 'решения', href: '/solutions' },
    { label: category.value?.breadcrumb || '', href: `/solutions/${props.categorySlug}` },
    { label: compressor.value.name, current: true },
]);

const tabs = [
    { key: 'specs', label: 'технические характеристики' },
    { key: 'features', label: 'Возможности' },
];

axios.get(`/solutions/${props.categorySlug}/${props.compressorSlug}/data`)
    .then((resp) => {
        compressor.value = {
            name: resp.data?.data?.compressor?.name || '',
            image: resp.data?.data?.compressor?.image || null,
            msf: resp.data?.data?.compressor?.msf || '',
            capacities_iso: resp.data?.data?.compressor?.capacities_iso || '',
        };
        models.value = resp.data?.data?.models || [];
        options.value = resp.data?.data?.options || [];
    })
    .catch(() => {})
    .finally(() => {
        isLoaded.value = true;
    });

const goBack = () => {
    window.location.href = `/solutions/${props.categorySlug}`;
};

const getRangeText = (items, key, suffix) => {
    const values = items
        .map((item) => item[key])
        .filter((value) => value !== null && value !== undefined && value !== '');

    if (!values.length) {
        return '—';
    }

    return `от ${Math.min(...values)} до ${Math.max(...values)} ${suffix}`;
};

const specsRows = computed(() => [
    [
        {
            title: 'Номинальная мощность',
            value: getRangeText(models.value, 'capacity', 'м³/мин'),
        },
        {
            title: 'FAD',
            value: getRangeText(models.value, 'CFM', 'CFM'),
        },
        {
            title: 'Мощность двигателя',
            value: getRangeText(models.value, 'installed_power', 'kW'),
        },
    ],
    [
        {
            title: 'MSF',
            value: compressor.value.msf || '—',
        },
        {
            title: 'ISO 1217',
            value: compressor.value.capacities_iso || '—',
        },
    ],
]);
</script>

<template>
    <div v-if="category" class="solutions-compressor-page">
        <section class="solutions-compressor-page__hero">
            <div class="container mx-auto px-4 h-full">
                <div class="solutions-compressor-page__hero-inner">
                    <div class="solutions-compressor-page__hero-top">
                        <breadcrumbs :items="breadcrumbItems" />

                        <button type="button" class="solutions-compressor-page__back-button" @click="goBack">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path
                                    d="M19 12H5M11 18l-6-6 6-6"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <span>Вернуться</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="solutions-compressor-page__envelope-wrap">
            <div class="container mx-auto px-4">
                <div class="solutions-compressor-page__envelope">
                    <div class="solutions-compressor-page__media">
                        <img
                            v-if="compressor.image"
                            :src="compressor.image.url"
                            :alt="compressor.image.title || compressor.name"
                            class="solutions-compressor-page__image"
                        >
                    </div>

                    <div class="solutions-compressor-page__content">
                        <p class="solutions-compressor-page__category" :class="category.categoryAccentClass">
                            {{ category.accentTitle }}
                        </p>
                        <h1 class="solutions-compressor-page__title">{{ compressor.name }}</h1>
                        <span class="solutions-compressor-page__divider" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="solutions-compressor-page__section">
            <div class="container mx-auto px-4">
                <div class="solutions-compressor-page__section-head">
                    <h2 class="site-h2">Характеристики</h2>
                </div>

                <div class="solutions-compressor-page__tabs-wrap">
                    <div class="solutions-compressor-page__tabs-line"></div>
                    <div class="solutions-compressor-page__tabs" role="tablist" aria-label="Характеристики компрессора">
                        <button
                            v-for="tab in tabs"
                            :key="tab.key"
                            type="button"
                            class="solutions-compressor-page__tab"
                            :class="{ 'is-active': activeTab === tab.key }"
                            :aria-selected="activeTab === tab.key ? 'true' : 'false'"
                            @click="activeTab = tab.key"
                        >
                            {{ tab.label }}
                        </button>
                    </div>
                </div>

                <div class="solutions-compressor-page__tab-shell">
                    <div v-if="activeTab === 'specs'" class="solutions-compressor-page__specs">
                        <div
                            v-for="(row, rowIndex) in specsRows"
                            :key="rowIndex"
                            class="solutions-compressor-page__spec-row"
                            :class="{ 'solutions-compressor-page__spec-row--compact': row.length < 3 }"
                        >
                            <article
                                v-for="item in row"
                                :key="item.title"
                                class="solutions-compressor-page__spec-item"
                            >
                                <span class="solutions-compressor-page__spec-marker" aria-hidden="true"></span>
                                <div class="solutions-compressor-page__spec-copy">
                                    <p class="solutions-compressor-page__spec-title">{{ item.title }}</p>
                                    <p class="solutions-compressor-page__spec-value">{{ item.value }}</p>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div v-else-if="models.length" class="solutions-compressor-page__models-table-wrap">
                        <table class="solutions-compressor-page__models-table">
                            <thead>
                                <tr>
                                    <th>Модель</th>
                                    <th>Capacity</th>
                                    <th>FAD</th>
                                    <th>CFM</th>
                                    <th>Installed power</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in models" :key="item.id">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.capacity ?? '—' }}</td>
                                    <td>{{ item.FAD ?? '—' }}</td>
                                    <td>{{ item.CFM ?? '—' }}</td>
                                    <td>{{ item.installed_power ?? '—' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-else class="solutions-compressor-page__todo">
                        Модели пока не добавлены.
                    </div>
                </div>
            </div>
        </section>

        <section class="solutions-compressor-page__section solutions-compressor-page__section--options">
            <div class="container mx-auto px-4">
                <div v-if="options.length" class="solutions-compressor-page__options">
                    <options-grid-block title="Параметры" :items="options" />
                </div>

                <div v-else-if="isLoaded" class="solutions-compressor-page__empty">
                    Параметры пока не опубликованы.
                </div>
            </div>
        </section>

        <services-section />
    </div>
</template>

<style scoped>
.solutions-compressor-page {
    background: var(--color-white);
}

.solutions-compressor-page__hero {
    min-height: 280px;
    background: var(--color-primary-800);
}

.solutions-compressor-page__hero-inner {
    display: flex;
    flex-direction: column;
    min-height: 280px;
    padding: 48px 0 96px;
}

.solutions-compressor-page__hero-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
}

.solutions-compressor-page__back-button {
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

.solutions-compressor-page__back-button:hover {
    background: var(--color-secondary-500);
    color: var(--color-white);
}

.solutions-compressor-page__back-button svg {
    width: 20px;
    height: 20px;
}

.solutions-compressor-page__envelope-wrap {
}

.solutions-compressor-page__envelope {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: minmax(280px, 0.92fr) minmax(0, 1.08fr);
    gap: 42px;
    padding: 34px 40px 30px;
    margin-top: -154px;
    margin-bottom: -44px;
    border-radius: 28px 28px 0 0;
    background: var(--color-white);
    box-shadow: -18px -40px 34px rgba(8, 22, 34, 0.07), 18px -20px 16px rgba(8, 22, 34, 0.07);
}

.solutions-compressor-page__media {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 320px;
    border-radius: 22px;
    background: rgba(234, 247, 255, 0.72);
    overflow: hidden;
}

.solutions-compressor-page__image {
    display: block;
    width: 100%;
    height: auto;
    max-height: 320px;
    object-fit: contain;
}

.solutions-compressor-page__content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 16px;
    padding-top: 12px;
}

.solutions-compressor-page__category {
    margin: 0;
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1.45rem;
    font-weight: 600;
    line-height: 1;
}

.solutions-compressor-page__category--secondary {
    color: var(--color-secondary-500);
}

.solutions-compressor-page__category--primary {
    color: var(--color-primary-400);
}

.solutions-compressor-page__title {
    margin: 0;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(2rem, 1.7368421053rem + 0.701754386vw, 3rem);
    font-weight: 300;
    line-height: 1;
}

.solutions-compressor-page__divider {
    display: block;
    width: 100%;
    height: 1px;
    margin-top: 4px;
    background: rgba(83, 165, 220, 0.24);
}

.solutions-compressor-page__section {
    padding: 124px 0 88px;
    background: var(--color-white);
}

.solutions-compressor-page__section--options {
    padding-top: 0;
}

.solutions-compressor-page__section-head {
    margin-bottom: 32px;
}

.solutions-compressor-page__tabs-wrap {
    position: relative;
    margin-bottom: -1px;
}

.solutions-compressor-page__tabs-line {
    position: absolute;
    inset: auto 0 0;
    height: 1px;
    background: var(--color-primary-400);
}

.solutions-compressor-page__tabs {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: stretch;
    gap: 12px;
    flex-wrap: wrap;
}

.solutions-compressor-page__tab {
    min-height: 64px;
    padding: 18px 28px;
    border: 1px solid var(--color-secondary-500);
    border-bottom-color: var(--color-primary-400);
    border-radius: 20px 20px 0 0;
    background: var(--color-white);
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 400;
    line-height: 1.2;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
}

.solutions-compressor-page__tab.is-active {
    border-color: var(--color-primary-400);
    background: var(--color-primary-400);
    color: var(--color-white);
}

.solutions-compressor-page__tab-shell {
    border-top: 1px solid var(--color-primary-400);
    background: #eaf7ff;
    padding: 36px;
}

.solutions-compressor-page__todo {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 220px;
    border: 1px dashed rgba(83, 165, 220, 0.38);
    border-radius: 24px;
    color: rgba(11, 40, 59, 0.56);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.solutions-compressor-page__specs {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.solutions-compressor-page__spec-row {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
}

.solutions-compressor-page__spec-row--compact {
    grid-template-columns: repeat(2, minmax(0, 1fr));
}

.solutions-compressor-page__spec-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 22px 20px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.58);
}

.solutions-compressor-page__spec-marker {
    width: 12px;
    height: 12px;
    margin-top: 6px;
    border-radius: 999px;
    background: var(--color-primary-400);
    flex: 0 0 auto;
}

.solutions-compressor-page__spec-copy {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.solutions-compressor-page__spec-title,
.solutions-compressor-page__spec-value {
    margin: 0;
}

.solutions-compressor-page__spec-title {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1.08rem;
    font-weight: 600;
    line-height: 1.2;
}

.solutions-compressor-page__spec-value {
    color: rgba(11, 40, 59, 0.8);
    font-size: 0.98rem;
    line-height: 1.6;
}

.solutions-compressor-page__models-table-wrap {
    overflow-x: auto;
}

.solutions-compressor-page__models-table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255, 255, 255, 0.58);
    border-radius: 24px;
    overflow: hidden;
}

.solutions-compressor-page__models-table th,
.solutions-compressor-page__models-table td {
    padding: 18px 20px;
    text-align: left;
}

.solutions-compressor-page__models-table th {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.88rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    background: rgba(83, 165, 220, 0.16);
}

.solutions-compressor-page__models-table td {
    color: rgba(11, 40, 59, 0.82);
    font-size: 0.98rem;
    line-height: 1.55;
    border-top: 1px solid rgba(83, 165, 220, 0.12);
}

.solutions-compressor-page__empty {
    color: rgba(11, 40, 59, 0.72);
    font-size: 1rem;
    line-height: 1.6;
}

@media (max-width: 991px) {
    .solutions-compressor-page__envelope {
        grid-template-columns: 1fr;
        gap: 28px;
    }
}

@media (max-width: 767px) {
    .solutions-compressor-page__hero {
        min-height: 220px;
    }

    .solutions-compressor-page__hero-inner {
        min-height: 220px;
        padding: 32px 0 84px;
    }

    .solutions-compressor-page__hero-top {
        flex-direction: column;
    }

    .solutions-compressor-page__envelope {
        gap: 22px;
        padding: 24px 20px;
        margin-top: -112px;
        margin-bottom: -28px;
        border-radius: 24px 24px 0 0;
    }

    .solutions-compressor-page__media {
        min-height: 220px;
        border-radius: 18px;
    }

    .solutions-compressor-page__image {
        max-height: 220px;
    }

    .solutions-compressor-page__section {
        padding: 84px 0 64px;
    }

    .solutions-compressor-page__tab-shell {
        padding: 24px 20px;
    }

    .solutions-compressor-page__spec-row,
    .solutions-compressor-page__spec-row--compact {
        grid-template-columns: 1fr;
    }
}
</style>
