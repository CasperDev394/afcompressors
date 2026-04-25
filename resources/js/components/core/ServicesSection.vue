<script setup>
import {
    faArrowRight,
    faBinoculars,
    faHeadset,
    faScrewdriverWrench,
} from '@fortawesome/free-solid-svg-icons';

const serviceItems = [
    {
        title: 'ПРЕДПРОДАЖА',
        href: '#',
        icon: faBinoculars,
    },
    {
        title: 'ТЕХНИЧЕСКАЯ ПОДДЕРЖКА И ОБСЛУЖИВАНИЕ',
        href: '#',
        icon: faHeadset,
    },
    {
        title: 'ПРОГНОЗИРУЕМОЕ ТЕХНИЧЕСКОЕ ОБСЛУЖИВАНИЕ',
        href: '#',
        icon: faScrewdriverWrench,
    },
];
</script>

<template>
    <section class="services-section">
        <div class="container mx-auto px-4">
            <div class="services-section__panel">
                <div class="services-section__left">
                    <h2 class="services-section__title">Услуги</h2>

                    <div class="services-section__list">
                        <a
                            v-for="item in serviceItems"
                            :key="item.title"
                            :href="item.href"
                            class="services-section__item"
                        >
                            <span class="services-section__item-main">
                                <span class="services-section__item-icon">
                                    <svg-icon size="18" :fa-icon="item.icon" />
                                </span>
                                <span class="services-section__item-title">{{ item.title }}</span>
                            </span>

                            <span class="services-section__item-arrow">
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
                        </a>
                    </div>
                </div>

                <div class="services-section__divider" aria-hidden="true">
                    <span class="services-section__divider-dot"></span>
                </div>

                <a href="#" class="services-section__right">
                    <p class="services-section__lead">
                        Для решения, адаптированного к вашим потребностям.
                    </p>

                    <span class="services-section__cta">
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
                </a>
            </div>
        </div>
    </section>
</template>

<style scoped>
.services-section {
    padding: 0 0 88px;
    background: var(--color-white);
}

.services-section__panel {
    display: grid;
    grid-template-columns: minmax(0, 0.9fr) 40px minmax(0, 1.1fr);
    gap: 36px;
    padding: 56px 48px;
    border-radius: 32px;
    background:
        radial-gradient(circle at top left, rgba(83, 165, 220, 0.28), transparent 34%),
        linear-gradient(135deg, #0b283b 0%, #123948 48%, #0d504f 100%);
    overflow: hidden;
}

.services-section__left {
    display: flex;
    flex-direction: column;
    gap: 28px;
}

.services-section__title {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(2rem, 1.8157894737rem + 0.4912280702vw, 2.7rem);
    font-weight: 300;
    line-height: 1;
}

.services-section__list {
    display: flex;
    flex-direction: column;
    border-top: 1px solid rgba(255, 255, 255, 0.14);
}

.services-section__item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 20px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.14);
    color: var(--color-white);
    text-decoration: none;
    transition: color 0.25s ease;
}

.services-section__item:hover {
    color: var(--color-secondary-400);
}

.services-section__item-main {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.services-section__item-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border: 1px solid rgba(242, 138, 4, 0.34);
    border-radius: 999px;
    color: currentColor;
    flex: 0 0 auto;
    transition: border-color 0.25s ease, transform 0.25s ease;
}

.services-section__item-title {
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.98rem;
    font-weight: 400;
    line-height: 1.35;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.services-section__item-arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    border: 1px solid rgba(242, 138, 4, 0.5);
    border-radius: 999px;
    color: currentColor;
    flex: 0 0 auto;
    transition: transform 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
}

.services-section__item-arrow svg {
    width: 18px;
    height: 18px;
}

.services-section__item:hover .services-section__item-arrow {
    transform: translateX(4px);
    border-color: var(--color-secondary-400);
    background: rgba(251, 181, 91, 0.12);
}

.services-section__item:hover .services-section__item-icon {
    transform: translateX(2px);
    border-color: var(--color-secondary-400);
}

.services-section__divider {
    position: relative;
    display: flex;
    justify-content: center;
}

.services-section__divider::before {
    content: "";
    width: 1px;
    height: 100%;
    background: rgba(255, 255, 255, 0.16);
}

.services-section__divider-dot {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 14px;
    height: 14px;
    border: 1px solid rgba(242, 138, 4, 0.75);
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.08);
    transform: translate(-50%, -50%);
}

.services-section__right {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 28px;
    color: var(--color-white);
    text-decoration: none;
}

.services-section__lead {
    max-width: 585px;
    color: currentColor;
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(2rem, 1.7368421053rem + 0.701754386vw, 3rem);
    font-weight: 300;
    line-height: 1.02;
    transition: color 0.25s ease;
}

.services-section__cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 108px;
    height: 108px;
    border: 1px solid var(--color-secondary-500);
    border-radius: 999px;
    color: var(--color-secondary-500);
    text-decoration: none;
    flex: 0 0 auto;
    transition: transform 0.25s ease, background-color 0.25s ease, color 0.25s ease;
}

.services-section__right:hover {
    color: var(--color-secondary-400);
}

.services-section__right:hover .services-section__cta {
    background: var(--color-secondary-500);
    color: var(--color-white);
    transform: translateX(4px);
}

.services-section__cta svg {
    width: 30px;
    height: 30px;
}

@media (max-width: 991px) {
    .services-section__panel {
        grid-template-columns: 1fr;
        gap: 32px;
        padding: 40px 28px;
    }

    .services-section__divider {
        display: none;
    }

    .services-section__right {
        align-items: flex-start;
    }
}

@media (max-width: 767px) {
    .services-section {
        padding: 0 0 64px;
    }

    .services-section__panel {
        gap: 28px;
        padding: 32px 20px;
        border-radius: 24px;
    }

    .services-section__item {
        align-items: flex-start;
    }

    .services-section__item-main {
        align-items: flex-start;
    }

    .services-section__right {
        flex-direction: column;
    }

    .services-section__cta {
        width: 84px;
        height: 84px;
    }
}
</style>
