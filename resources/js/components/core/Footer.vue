<script setup>
import {
    certificateItems,
    featuredMenuItems,
    hotline,
    menuSections,
    secondaryMenuItems,
    socialItems,
} from '../../data/siteMenu';

const legalLinks = [
    { label: 'Условия и положения', href: '/terms-and-conditions' },
    { label: 'политика конфиденциальности', href: '/privacy-policy' },
    { label: 'Cookies', href: '/cookies' },
];

const getFooterFeaturedClass = (item) => item.className?.replaceAll('site-header__menu-link', 'site-footer__featured-link');
const getFooterEyebrowClass = (item) => item.eyebrowClass?.replaceAll('site-header__featured-eyebrow', 'site-footer__featured-eyebrow');
</script>

<template>
    <footer class="site-footer">
        <div class="container mx-auto px-4">
            <div class="site-footer__panel">
                <div class="site-footer__left">
                    <div class="site-footer__menu">
                        <div class="site-footer__menu-top">
                            <div class="site-footer__featured">
                                <a
                                    v-for="item in featuredMenuItems"
                                    :key="item.label"
                                    :href="item.href"
                                    class="site-footer__featured-link"
                                    :class="getFooterFeaturedClass(item)"
                                >
                                    <span
                                        v-if="item.eyebrow"
                                        class="site-footer__featured-eyebrow"
                                        :class="getFooterEyebrowClass(item)"
                                    >
                                        {{ item.eyebrow }}
                                    </span>
                                    <span>{{ item.label }}</span>
                                </a>
                            </div>

                            <nav class="site-footer__columns" aria-label="Навигация в подвале">
                                <div
                                    v-for="section in menuSections"
                                    :key="section.title"
                                    class="site-footer__column"
                                >
                                    <a :href="section.href" class="site-footer__heading">
                                        {{ section.title }}
                                    </a>

                                    <div class="site-footer__secondary site-footer__secondary--column">
                                        <a
                                            v-for="item in section.items"
                                            :key="item.label"
                                            :href="item.href"
                                            class="site-footer__secondary-link"
                                            :class="{ 'site-footer__secondary-link--nested': item.nested }"
                                        >
                                            {{ item.label }}
                                        </a>
                                    </div>
                                </div>
                            </nav>
                        </div>

                        <div class="site-footer__menu-bottom">
                            <div class="site-footer__secondary">
                                <a
                                    v-for="item in secondaryMenuItems"
                                    :key="item.label"
                                    :href="item.href"
                                    class="site-footer__secondary-link site-footer__secondary-link--footer"
                                >
                                    {{ item.label }}
                                </a>
                            </div>

                            <div class="site-footer__socials" aria-label="Социальные сети">
                                <a
                                    v-for="item in socialItems"
                                    :key="item.label"
                                    :href="item.href"
                                    class="site-footer__social-link"
                                    :aria-label="item.label"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <span>{{ item.short }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="site-footer__legal">
                        <p class="site-footer__copyright">© 2026 AF compressors - Все права защищены.</p>

                        <div class="site-footer__legal-links">
                            <template v-for="(item, index) in legalLinks" :key="item.label">
                                <a :href="item.href" class="site-footer__legal-link">
                                    {{ item.label }}
                                </a>
                                <span v-if="index < legalLinks.length - 1" class="site-footer__legal-separator">|</span>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="site-footer__right">
                    <div class="site-footer__right-inner">
                        <a class="site-footer__hotline" :href="hotline.href">
                            <span class="site-footer__hotline-icon" aria-hidden="true">
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
                            <span class="site-footer__hotline-copy">
                                <span class="site-footer__hotline-label">{{ hotline.label }}</span>
                                <span class="site-footer__hotline-number">{{ hotline.number }}</span>
                            </span>
                        </a>

                        <a href="/" class="site-footer__brand" aria-label="AF Compressors">
                            <img src="/img/logo-af-compressors-white.svg" alt="AF Compressors">
                        </a>

                        <span class="site-footer__cert-divider" aria-hidden="true"></span>

                        <div class="site-footer__certificates" aria-label="Сертификаты">
                            <img
                                v-for="item in certificateItems"
                                :key="item.src"
                                :src="item.src"
                                :alt="item.alt"
                                class="site-footer__certificate"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.site-footer {
    padding: 72px 0 44px;
    background: var(--color-primary-800);
}

.site-footer__panel {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
    gap: 48px;
}

.site-footer__left {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.site-footer__menu {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.site-footer__menu-top {
    display: grid;
    grid-template-columns: minmax(240px, 0.95fr) minmax(0, 2.05fr);
    gap: 34px;
}

.site-footer__featured {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
}

.site-footer__columns {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 24px;
}

.site-footer__column {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.site-footer__featured-link,
.site-footer__heading {
    display: inline-flex;
    flex-direction: column;
    align-items: flex-start;
    width: fit-content;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    text-decoration: none;
}

.site-footer__featured-link {
    font-size: 1rem;
    line-height: 1.05;
    transition: color 0.25s ease;
}

.site-footer__featured-link--primary {
    margin-bottom: 4px;
    font-size: 1.2rem;
    font-weight: 600;
}

.site-footer__featured-link--subitem {
    position: relative;
    gap: 2px;
    padding-left: 34px;
}

.site-footer__featured-link--subitem::before {
    content: "";
    position: absolute;
    top: 0.95em;
    left: 0;
    width: 1.5rem;
    height: 0.1rem;
    background: #fff;
    opacity: 0.2;
}

.site-footer__featured-link:hover {
    color: var(--color-secondary-500);
}

.site-footer__featured-link--subitem-blue:hover {
    color: var(--color-primary-300);
}

.site-footer__featured-eyebrow {
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.86rem;
    font-weight: 600;
    line-height: 1;
}

.site-footer__featured-eyebrow--secondary {
    color: var(--color-secondary-500);
}

.site-footer__featured-eyebrow--primary {
    color: var(--color-primary-400);
}

.site-footer__heading {
    font-size: 1.12rem;
    font-weight: 600;
    line-height: 1;
    transition: color 0.25s ease;
    text-transform: uppercase;
}

.site-footer__heading:hover {
    color: var(--color-secondary-400);
}

.site-footer__secondary {
    display: flex;
    align-items: center;
    gap: 22px;
    flex-wrap: wrap;
}

.site-footer__secondary--column {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    flex-wrap: nowrap;
}

.site-footer__secondary--column .site-footer__secondary-link--nested + .site-footer__secondary-link--nested {
    margin-top: -5px;
}

.site-footer__secondary-link {
    display: table;
    color: var(--color-white);
    opacity: 0.6;
    font-family: stolzl, Times, "Times New Roman", serif;
    font-size: 0.96rem;
    font-weight: 300;
    line-height: 1.12;
    text-decoration: none;
    transition: color 0.25s ease, opacity 0.25s ease;
}

.site-footer__secondary-link--footer {
    font-size: 1rem;
    text-transform: uppercase;
}

.site-footer__secondary-link--nested {
    margin-left: 16px;
}

.site-footer__secondary-link:hover {
    color: var(--color-secondary-400);
    opacity: 0.8;
}

.site-footer__menu-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}

.site-footer__socials {
    display: flex;
    align-items: center;
    gap: 10px;
}

.site-footer__social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 999px;
    color: rgba(255, 255, 255, 0.72);
    font-size: 0.64rem;
    font-weight: 500;
    line-height: 1;
    text-transform: uppercase;
    transition: color 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
}

.site-footer__social-link:hover {
    border-color: var(--color-secondary-400);
    background: rgba(251, 181, 91, 0.12);
    color: var(--color-secondary-400);
}

.site-footer__legal {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-top: 24px;
    border-top: 1px solid rgba(83, 165, 220, 0.22);
}

.site-footer__copyright,
.site-footer__legal-links {
    margin: 0;
    color: rgba(83, 165, 220, 0.76);
    font-size: 0.85rem;
    line-height: 1.5;
}

.site-footer__legal-links {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.site-footer__legal-link {
    color: inherit;
    text-decoration: none;
    transition: color 0.25s ease;
}

.site-footer__legal-link:hover {
    color: var(--color-secondary-400);
}

.site-footer__legal-separator {
    color: rgba(83, 165, 220, 0.42);
}

.site-footer__right {
    display: flex;
    justify-content: center;
}

.site-footer__right-inner {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    gap: 22px;
    width: min(100%, 290px);
    min-height: 100%;
}

.site-footer__hotline {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    min-height: 78px;
    width: min(100%, 290px);
    padding: 16px 22px;
    border: 1px solid var(--color-secondary-500);
    border-radius: 999rem;
    color: var(--color-secondary-500);
    text-decoration: none;
    transition: background-color 0.25s ease, color 0.25s ease;
}

.site-footer__hotline:hover {
    background: var(--color-secondary-500);
    color: var(--color-white);
}

.site-footer__hotline-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
}

.site-footer__hotline-icon svg {
    width: 24px;
    height: 24px;
}

.site-footer__hotline-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 4px;
    font-family: stolzl, Times, "Times New Roman", serif;
    font-size: 1.16rem;
    font-weight: 300;
    line-height: 1.1;
    text-transform: uppercase;
}

.site-footer__hotline-number {
    color: var(--color-white);
}

.site-footer__brand img {
    display: block;
    width: auto;
    height: 60px;
}

.site-footer__cert-divider {
    display: block;
    width: 100%;
    height: 1px;
    background: rgba(83, 165, 220, 0.34);
}

.site-footer__certificates {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
}

.site-footer__certificate {
    width: calc((100% - 40px) / 5);
    max-height: 40px;
    object-fit: contain;
    object-position: center;
}

@media (max-width: 1199px) {
    .site-footer__panel {
        grid-template-columns: 1.6fr 1fr;
        gap: 36px;
    }

    .site-footer__menu-top {
        grid-template-columns: 1fr;
        gap: 28px;
    }
}

@media (max-width: 991px) {
    .site-footer {
        padding: 56px 0 36px;
    }

    .site-footer__panel {
        grid-template-columns: 1fr;
    }

    .site-footer__columns {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .site-footer__right {
        justify-content: flex-start;
    }
}

@media (max-width: 767px) {
    .site-footer {
        padding: 44px 0 32px;
    }

    .site-footer__left {
        gap: 26px;
    }

    .site-footer__menu {
        gap: 26px;
    }

    .site-footer__columns {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .site-footer__menu-bottom {
        flex-direction: column;
        align-items: flex-start;
    }

    .site-footer__secondary {
        gap: 16px;
    }

    .site-footer__hotline {
        min-height: 72px;
    }

    .site-footer__brand img {
        height: 52px;
    }
}
</style>
