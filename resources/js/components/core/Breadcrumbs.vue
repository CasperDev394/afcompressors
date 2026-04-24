<script setup>
defineProps({
    items: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <nav class="breadcrumbs" aria-label="Хлебные крошки">
        <ol class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="/" class="breadcrumbs__home" aria-label="Главная">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M4 10.5 12 4l8 6.5V20H4v-9.5Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M9.5 20v-5h5v5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </a>
            </li>

            <template v-for="item in items" :key="item.label">
                <li class="breadcrumbs__separator" aria-hidden="true">/</li>
                <li class="breadcrumbs__item">
                    <a
                        v-if="item.href && !item.current"
                        :href="item.href"
                        class="breadcrumbs__link"
                    >
                        {{ item.label }}
                    </a>
                    <span v-else class="breadcrumbs__link breadcrumbs__link--current" aria-current="page">
                        {{ item.label }}
                    </span>
                </li>
            </template>
        </ol>
    </nav>
</template>

<style scoped>
.breadcrumbs__list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
    color: var(--color-white);
}

.breadcrumbs__home {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    border-radius: 999px;
    color: var(--color-white);
    transition: color 0.25s ease, border-color 0.25s ease;
}

.breadcrumbs__home:hover {
    border-color: var(--color-secondary-400);
    color: var(--color-secondary-400);
}

.breadcrumbs__home svg {
    width: 16px;
    height: 16px;
}

.breadcrumbs__separator {
    color: var(--color-white);
    opacity: 0.5;
}

.breadcrumbs__link {
    color: var(--color-white);
    font-size: 1rem;
    line-height: 1.2;
    text-decoration: none;
    transition: color 0.25s ease;
}

.breadcrumbs__link:hover {
    color: var(--color-secondary-400);
}

.breadcrumbs__link--current {
    color: var(--color-primary-300);
    cursor: default;
    font-weight: 400;
    pointer-events: none;
}
</style>
