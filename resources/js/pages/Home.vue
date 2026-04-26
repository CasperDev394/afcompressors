<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const scrollY = ref(0);

const handleScroll = () => {
    scrollY.value = window.scrollY || 0;
};

const heroDotStyle = computed(() => {
    const offset = Math.max(0, Math.min(220, scrollY.value * 0.34));

    return {
        transform: `translate(-50%, ${offset}px)`,
    };
});

onMounted(() => {
    handleScroll();
    window.addEventListener('scroll', handleScroll, { passive: true });
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <div class="home-page">
        <section class="home-page__hero">
            <video
                class="home-page__hero-video"
                src="/video/af-hp-loopv2-light.mp4"
                autoplay
                muted
                loop
                playsinline
            ></video>
            <div class="home-page__hero-overlay" aria-hidden="true"></div>

            <div class="container mx-auto px-4 h-full">
                <div class="home-page__hero-inner">
                    <div class="home-page__hero-rail" aria-hidden="true">
                        <span class="home-page__hero-rail-line"></span>
                        <span class="home-page__hero-rail-dot" :style="heroDotStyle"></span>
                    </div>

                    <div class="home-page__hero-left">
                        <h1 class="home-page__hero-title">Energy Sobriety</h1>
                        <p class="home-page__hero-description">
                            Наиболее эффективные и долговечные компрессорные решения, разработанные для обеспечения вашего успеха.
                        </p>
                    </div>

                    <div class="home-page__hero-right">
                        <a href="/solutions" class="home-page__hero-link">
                            <span>Безмасляные поршневые компрессоры</span>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path
                                    d="M5 12h14M13 6l6 6-6 6"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>

                        <a href="/contact/?tab=quote" class="home-page__hero-button">
                            Запросить предложение
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-page__section">
            <div class="container mx-auto px-4">
                <div class="home-page__story">
                    <div class="home-page__story-copy">
                        <h2 class="site-h2 home-page__story-title">
                            Обеспечение долговременного удовлетворения потребностей всей цепочки создания стоимости промышленного оборудования.
                        </h2>

                        <p class="home-page__story-text">
                            Компания AF Compressors специализируется на проектировании, производстве и обслуживании безмасляных поршневых компрессоров , уделяя особое внимание отрасли розлива ПЭТ-бутылок. Наши компрессоры разработаны для оптимальной производительности, обеспечивая чистый, безмасляный воздух, отвечающий жестким требованиям к качеству в различных областях применения. Наши решения призваны помочь вашему бизнесу достичь большей эффективности, надежности и экологичности .
                        </p>

                        <a href="/our-company" class="home-page__story-link">
                            <span>Узнайте больше о нашей международной компании</span>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path
                                    d="M5 12h14M13 6l6 6-6 6"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                    </div>

                    <div class="home-page__story-media">
                        <div class="home-page__video-todo">TODO video</div>
                    </div>
                </div>
            </div>
        </section>

        <home-expectations-carousel />

        <section class="home-page__section home-page__section--sustainability">
            <div class="container mx-auto px-4">
                <div class="home-page__sustainability">
                    <div class="home-page__sustainability-copy">
                        <h2 class="site-h2 home-page__sustainability-title">
                            Инновационный подход к устойчивому развитию в области компрессионных решений.
                        </h2>

                        <p class="home-page__story-text">
                            В компании AF Compressors мы считаем, что настоящие инновации заключаются в гармоничном сочетании промышленной эффективности и экологической ответственности. Наша приверженность принципам устойчивого развития заложена во всех аспектах нашей деятельности, от проектирования и производства до окончательной поставки наших безмасляных поршневых компрессоров.
                        </p>

                        <p class="home-page__story-text">
                            Выбирая компрессоры AF, вы не только инвестируете в передовые технологии сжатия, но и вносите свой вклад в более экологичное и устойчивое будущее. Вместе мы можем достичь замечательной эффективности в промышленности, одновременно защищая окружающую среду для будущих поколений.
                        </p>

                        <a href="/sustainability" class="home-page__story-link">
                            <span>Узнайте, как</span>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path
                                    d="M5 12h14M13 6l6 6-6 6"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                    </div>

                    <div class="home-page__sustainability-media">
                        <img
                            src="/img/home/sustainability.jpg"
                            alt="Sustainability AF Compressors"
                            class="home-page__sustainability-image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.home-page {
    background: var(--color-white);
}

.home-page__hero {
    position: relative;
    min-height: calc(100dvh - 76px);
    overflow: hidden;
    background: var(--color-primary-800);
}

.home-page__hero-video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.home-page__hero-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(180deg, rgba(7, 24, 37, 0.26), rgba(7, 24, 37, 0.58)),
        radial-gradient(circle at 18% 20%, rgba(83, 165, 220, 0.16), transparent 36%);
    backdrop-filter: blur(3px);
}

.home-page__hero-inner {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 48px;
    min-height: calc(100dvh - 76px);
    padding: 96px 0 56px;
}

.home-page__hero-rail {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 40px;
    pointer-events: none;
}

.home-page__hero-rail-line {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 1px;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.38), rgba(255, 255, 255, 0.08));
}

.home-page__hero-rail-dot {
    position: absolute;
    top: 22px;
    left: 50%;
    width: 14px;
    height: 14px;
    border: 1px solid rgba(251, 181, 91, 0.9);
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.16);
    box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.05);
    transition: transform 0.12s linear;
}

.home-page__hero-left {
    max-width: 720px;
}

.home-page__hero-title {
    margin: 0 0 20px;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3.3rem, 2.6157894737rem + 1.8245614035vw, 5.9rem);
    font-weight: 300;
    line-height: 0.95;
}

.home-page__hero-description {
    margin: 0;
    max-width: 640px;
    color: rgba(255, 255, 255, 0.92);
    font-size: 1.08rem;
    line-height: 1.72;
}

.home-page__hero-right {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 18px;
    max-width: 360px;
}

.home-page__hero-link {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.35rem, 1.1657894737rem + 0.4912280702vw, 2.05rem);
    font-weight: 300;
    line-height: 1.18;
    text-decoration: none;
    transition: color 0.25s ease;
}

.home-page__hero-link:hover {
    color: var(--color-secondary-400);
}

.home-page__hero-link svg {
    width: 24px;
    height: 24px;
    flex: 0 0 auto;
}

.home-page__hero-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 56px;
    padding: 14px 28px;
    border-radius: 999rem;
    background: var(--color-secondary-500);
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 400;
    line-height: 1;
    letter-spacing: 0.04em;
    text-decoration: none;
    text-transform: uppercase;
    transition: background-color 0.25s ease, transform 0.25s ease;
}

.home-page__hero-button:hover {
    background: var(--color-secondary-400);
    transform: translateY(-2px);
}

.home-page__section {
    padding: 88px 0;
    background: var(--color-white);
}

.home-page__section--sustainability {
    padding-top: 0;
}

.home-page__story {
    display: grid;
    grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
    align-items: center;
    gap: 46px;
}

.home-page__story-copy {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.home-page__story-title {
    margin: 0;
    max-width: 760px;
}

.home-page__story-text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.72;
}

.home-page__story-link {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    width: fit-content;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 400;
    line-height: 1.35;
    letter-spacing: 0.04em;
    text-decoration: none;
    transition: color 0.25s ease;
}

.home-page__story-link:hover {
    color: var(--color-secondary-400);
}

.home-page__story-link svg {
    width: 20px;
    height: 20px;
    flex: 0 0 auto;
}

.home-page__story-media {
    display: flex;
}

.home-page__video-todo {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 420px;
    border: 1px dashed rgba(83, 165, 220, 0.38);
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(145, 211, 255, 0.08), rgba(83, 165, 220, 0.04));
    color: rgba(11, 40, 59, 0.58);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.home-page__sustainability {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(320px, 0.9fr);
    align-items: center;
    gap: 44px;
    padding: 46px 42px;
    border-radius: 32px;
    background:
        radial-gradient(circle at top left, rgba(83, 165, 220, 0.14), transparent 30%),
        linear-gradient(135deg, #f8fbfd 0%, #eef8fd 100%);
}

.home-page__sustainability-copy {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.home-page__sustainability-title {
    margin: 0;
    max-width: 760px;
}

.home-page__sustainability-media {
    overflow: hidden;
    border-radius: 28px;
    background: rgba(255, 255, 255, 0.5);
}

.home-page__sustainability-image {
    display: block;
    width: 100%;
    height: auto;
    min-height: 100%;
    object-fit: cover;
}

@media (max-width: 991px) {
    .home-page__hero {
        min-height: auto;
    }

    .home-page__hero-inner {
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-end;
        min-height: auto;
        padding: 84px 0 48px;
    }

    .home-page__hero-right {
        max-width: 520px;
    }

    .home-page__hero-rail {
        display: none;
    }

    .home-page__story {
        grid-template-columns: 1fr;
        gap: 32px;
    }

    .home-page__sustainability {
        grid-template-columns: 1fr;
        gap: 28px;
        padding: 34px 28px;
    }
}

@media (max-width: 767px) {
    .home-page__hero-inner {
        gap: 28px;
        padding: 64px 0 36px;
    }

    .home-page__section {
        padding: 56px 0;
    }

    .home-page__video-todo {
        min-height: 260px;
        border-radius: 22px;
    }

    .home-page__sustainability {
        padding: 28px 20px;
        border-radius: 24px;
    }

    .home-page__sustainability-media {
        border-radius: 22px;
    }
}
</style>
