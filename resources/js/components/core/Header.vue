<template>
    <header class="site-header bg-white shadow-sm" :h1="h1">
        <div class="site-header__bar border-b border-gray-100 bg-primary-800">
            <div class="container mx-auto px-4 py-2">
                <div class="site-header__row flex items-center justify-between gap-4">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center">
                            <img class="site-header__logo" src="/img/logo-af-compressors-white.svg" alt="AF Compressors">
                        </a>
                    </div>

                    <button
                        type="button"
                        class="mob_navbar__action site-header__menu-button"
                        :class="{ 'menu-open': isMenuOpen }"
                        :aria-expanded="isMenuOpen ? 'true' : 'false'"
                        aria-controls="site-navigation"
                        :aria-label="isMenuOpen ? 'Закрыть меню' : 'Открыть меню'"
                        @click="toggleMenu"
                    >
                        <span class="site-header__menu-icon icon-bars" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="site-header__menu-icon icon-close" aria-hidden="true">
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <transition name="site-menu-overlay">
            <button
                v-if="isMenuOpen"
                type="button"
                class="site-header__overlay"
                aria-label="Закрыть меню"
                @click="closeMenu"
            ></button>
        </transition>

        <transition name="site-menu-panel">
            <div
                v-if="isMenuOpen"
                id="site-navigation"
                class="site-header__menu-panel bg-primary-800"
            >
                <div class="container mx-auto h-full px-4">
                    <div class="site-header__menu-content">
                        <div class="site-header__menu-main">
                            <div class="site-header__menu-top">
                                <div class="site-header__menu-top-left">
                                    <div class="site-header__featured-group">
                                        <a
                                            v-for="item in featuredMenuItems"
                                            :key="item.label"
                                            :href="item.href"
                                            class="site-header__menu-link"
                                            :class="item.className"
                                            @click="closeMenu"
                                        >
                                            <span
                                                v-if="item.eyebrow"
                                                class="site-header__featured-eyebrow"
                                                :class="item.eyebrowClass"
                                            >
                                                {{ item.eyebrow }}
                                            </span>
                                            <span>{{ item.label }}</span>
                                        </a>
                                    </div>
                                </div>

                                <nav class="site-header__menu-top-right" aria-label="Основное меню">
                                    <div
                                        v-for="section in menuSections"
                                        :key="section.title"
                                        class="site-header__menu-column"
                                    >
                                        <a
                                            :href="section.href"
                                            class="site-header__menu-heading"
                                            @click="closeMenu"
                                        >
                                            {{ section.title }}
                                        </a>

                                        <div class="site-header__menu-secondary site-header__menu-secondary--column">
                                            <template
                                                v-for="item in section.items"
                                                :key="item.label"
                                            >
                                                <a
                                                    :href="item.href"
                                                    class="secondary-menu"
                                                    :class="{ 'secondary-menu--nested': item.nested }"
                                                    @click="closeMenu"
                                                >
                                                    {{ item.label }}
                                                </a>
                                            </template>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>

                        <div class="site-header__menu-bottom">
                            <div class="site-header__menu-bottom-left">
                                <div class="site-header__menu-secondary">
                                    <a
                                        v-for="item in secondaryMenuItems"
                                        :key="item.label"
                                        :href="item.href"
                                        class="secondary-menu secondary-menu--footer"
                                        @click="closeMenu"
                                    >
                                        {{ item.label }}
                                    </a>
                                </div>

                                <div class="site-header__socials" aria-label="Социальные сети">
                                    <a
                                        v-for="item in socialItems"
                                        :key="item.label"
                                        :href="item.href"
                                        class="site-header__social-link"
                                        :aria-label="item.label"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <span>{{ item.short }}</span>
                                    </a>
                                </div>
                            </div>

                            <a class="site-header__hotline" href="tel:+79999999999">
                                <span class="site-header__hotline-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24c1.12.37 2.31.56 3.57.56a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.06 21 3 13.94 3 5a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.26.19 2.45.56 3.57a1 1 0 0 1-.24 1.02l-2.2 2.2Z"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </span>
                                <span class="site-header__hotline-copy">
                                    <span class="site-header__hotline-label">Горячая линия</span>
                                    <span class="site-header__hotline-number">+7 999 999 99 99</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import {
    featuredMenuItems,
    menuSections,
    secondaryMenuItems,
    socialItems,
} from '../../data/siteMenu';

defineProps({
    h1: {
        type: String,
        required: false,
    },
});

const isMenuOpen = ref(false);

const closeMenu = () => {
    isMenuOpen.value = false;
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const handleEscape = (event) => {
    if (event.key === 'Escape') {
        closeMenu();
    }
};

watch(isMenuOpen, (isOpen) => {
    document.body.classList.toggle('site-menu-open', isOpen);
});

onMounted(() => {
    window.addEventListener('keydown', handleEscape);
});

onBeforeUnmount(() => {
    document.body.classList.remove('site-menu-open');
    window.removeEventListener('keydown', handleEscape);
});
</script>

<style scoped>
.site-header {
    --site-header-height: 76px;
    position: relative;
    z-index: 40;
}

.site-header__row {
    min-height: calc(var(--site-header-height) - 16px);
}

.site-header__logo {
    height: 56px;
    width: auto;
}

.site-header__menu-button {
    position: relative;
    z-index: 45;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    border: 2px solid var(--color-white);
    border-radius: 999px;
    color: var(--color-white);
    transition: color 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
}

.site-header__menu-button:hover,
.site-header__menu-button.menu-open {
    border-color: var(--color-secondary-500);
    color: var(--color-secondary-500);
}

.site-header__menu-button:focus-visible {
    outline: 2px solid var(--color-secondary-500);
    outline-offset: 4px;
}

.site-header__menu-icon {
    position: absolute;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    width: 18px;
    height: 18px;
}

.icon-bars span {
    display: block;
    width: 18px;
    height: 2px;
    border-radius: 999px;
    background: currentColor;
}

.icon-close {
    gap: 0;
}

.icon-close span {
    position: absolute;
    width: 18px;
    height: 2px;
    border-radius: 999px;
    background: currentColor;
}

.icon-close span:first-child {
    transform: rotate(45deg);
}

.icon-close span:last-child {
    transform: rotate(-45deg);
}

.site-header__overlay {
    position: fixed;
    inset: 0;
    z-index: 41;
    background: rgba(0, 0, 0, 0.28);
}

.site-header__menu-panel {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 42;
    width: 100%;
    min-height: 521px;
    max-height: 621px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 28px 60px rgba(2, 12, 21, 0.28);
}

.site-header__menu-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
    min-height: 521px;
    max-height: 621px;
    padding: 48px 0;
}

.site-header__menu-main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex: 1 1 auto;
}

.site-header__menu-top {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 2fr);
    gap: 0;
    min-height: 100%;
}

.site-header__menu-top-left {
    display: flex;
    align-items: center;
    padding-right: 36px;
}

.site-header__featured-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 18px;
}

.site-header__menu-top-right {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 28px;
    padding-left: 36px;
    border-left: solid 1px rgba(83, 165, 220, 0.2);
}

.site-header__menu-column {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.site-header__menu-link {
    display: inline-flex;
    flex-direction: column;
    align-items: flex-start;
    width: fit-content;
    color: var(--color-white);
    font-size: 21px;
    line-height: 1;
    transition: color 0.25s ease;
}

.site-header__menu-link--primary {
    margin-bottom: 6px;
}

.site-header__menu-link--subitem {
    position: relative;
    gap: 2px;
    padding-left: 44px;
}

.site-header__menu-link--subitem::before {
    content: "";
    position: absolute;
    top: 0.95em;
    left: 0;
    width: 2rem;
    height: 0.1rem;
    background: #fff;
    opacity: 0.2;
}

.site-header__menu-link:hover {
    color: var(--color-secondary-500);
}

.site-header__menu-link--subitem-blue:hover {
    color: var(--color-primary-300);
}

.site-header__featured-eyebrow {
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1;
}

.site-header__featured-eyebrow--secondary {
    color: var(--color-secondary-500);
}

.site-header__featured-eyebrow--primary {
    color: var(--color-primary-400);
}

.site-header__menu-heading {
    margin-bottom: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 21px;
    font-weight: 600;
    line-height: 1;
    text-decoration: none;
    transition: all 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
    text-transform: uppercase;
}

.site-header__menu-heading:hover {
    color: var(--color-secondary-400);
}

.site-header__menu-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    margin-top: 16px;
    padding: 16px 0;
    border-top: solid 1px rgba(83, 165, 220, 0.2);
}

.site-header__menu-bottom-left {
    display: flex;
    align-items: center;
    gap: 28px;
    flex-wrap: wrap;
}

.site-header__menu-secondary {
    display: flex;
    align-items: center;
    gap: 28px;
    flex-wrap: wrap;
}

.site-header__menu-secondary--column {
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
    flex-wrap: nowrap;
}

.site-header__menu-secondary--column .secondary-menu--nested + .secondary-menu--nested {
    margin-top: -11px;
}

.secondary-menu {
    display: table;
    color: var(--color-white);
    opacity: 0.6;
    font-family: stolzl, Times, "Times New Roman", serif;
    font-size: 21px;
    font-weight: 300;
    line-height: 1.1;
    text-decoration: none;
    transition-property: color, opacity;
    transition-duration: 0.25s;
    transition-timing-function: ease;
}

.secondary-menu--footer {
    font-size: 21px;
    text-transform: uppercase;
}

.secondary-menu--nested {
    margin-left: 16px;
}

.secondary-menu:hover {
    color: var(--color-secondary-400);
    opacity: 0.8;
}

.site-header__socials {
    display: flex;
    align-items: center;
    gap: 12px;
}

.site-header__social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 999px;
    color: rgba(255, 255, 255, 0.72);
    font-size: 0.7rem;
    font-weight: 500;
    line-height: 1;
    text-transform: uppercase;
    transition: color 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
}

.site-header__social-link:hover {
    border-color: var(--color-secondary-400);
    background: rgba(251, 181, 91, 0.12);
    color: var(--color-secondary-400);
}

.site-header__hotline {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    min-height: 78px;
    width: min(100%, 290px);
    padding: 16px 22px;
    border: 1px solid var(--color-secondary-500);
    border-radius: 999rem;
    color: var(--color-secondary-500);
    transition: background-color 0.25s ease, color 0.25s ease;
}

.site-header__hotline:hover {
    background: var(--color-secondary-500);
    color: var(--color-white);
}

.site-header__hotline-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
}

.site-header__hotline-icon svg {
    width: 24px;
    height: 24px;
}

.site-header__hotline-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 4px;
    font-family: stolzl, Times, "Times New Roman", serif;
    font-size: 21px;
    font-weight: 300;
    line-height: 1.1;
    text-transform: uppercase;
}

.site-header__hotline-label {
    color: currentColor;
}

.site-header__hotline-number {
    color: var(--color-white);
    transition: color 0.25s ease;
}

.site-header__hotline:hover .site-header__hotline-number {
    color: var(--color-white);
}

.site-menu-overlay-enter-active,
.site-menu-overlay-leave-active {
    transition: opacity 0.25s ease;
}

.site-menu-overlay-enter-from,
.site-menu-overlay-leave-to {
    opacity: 0;
}

.site-menu-panel-enter-active,
.site-menu-panel-leave-active {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.site-menu-panel-enter-from,
.site-menu-panel-leave-to {
    opacity: 0;
    transform: translateY(-16px);
}

@media (max-width: 767px) {
    .site-header {
        --site-header-height: 68px;
    }

    .site-header__logo {
        height: 44px;
    }

    .site-header__menu-button {
        width: 42px;
        height: 42px;
    }

    .site-header__menu-icon,
    .icon-bars span,
    .icon-close span {
        width: 16px;
    }

    .site-header__menu-panel {
        left: 0;
        right: auto;
        width: min(100%, 360px);
        min-height: calc(100dvh - var(--site-header-height));
        max-height: calc(100dvh - var(--site-header-height));
    }

    .site-header__menu-content {
        justify-content: space-between;
        min-height: calc(100dvh - var(--site-header-height));
        max-height: calc(100dvh - var(--site-header-height));
        padding: 28px 0 32px;
    }

    .site-header__menu-top {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .site-header__menu-top-left {
        padding-right: 0;
    }

    .site-header__featured-group {
        gap: 16px;
    }

    .site-header__menu-top-right {
        grid-template-columns: 1fr;
        gap: 24px;
        padding-top: 24px;
        padding-left: 0;
        border-top: solid 1px rgba(83, 165, 220, 0.2);
        border-left: 0;
    }

    .site-header__menu-bottom {
        flex-direction: column;
        align-items: stretch;
        gap: 20px;
    }

    .site-header__menu-bottom-left,
    .site-header__menu-secondary {
        align-items: flex-start;
        gap: 18px;
    }

    .site-header__socials {
        gap: 10px;
    }

    .site-header__hotline {
        width: 100%;
        min-height: 72px;
    }

    .site-menu-panel-enter-from,
    .site-menu-panel-leave-to {
        transform: translateX(-24px);
    }
}
</style>
