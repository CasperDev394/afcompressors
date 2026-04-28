<script setup>
import Breadcrumbs from '../components/core/Breadcrumbs.vue';

const breadcrumbItems = [
    { label: 'Устойчивое развитие', current: true },
];

const featureItems = [
    {
        title: 'Экологически чистые технологии',
        description: 'Наши компрессоры разработаны с использованием передовых, экологически чистых технологий, которые обеспечивают приоритет энергоэффективности и снижают воздействие на окружающую среду. Благодаря многоступенчатому процессу сжатия мы минимизируем потребление энергии и оптимизируем производительность, гарантируя, что ваши операции будут не только экономически эффективными, но и экологически безопасными.',
        icon: 'bulb',
    },
    {
        title: 'Безмасляная конструкция',
        description: 'Безмасляная конструкция наших компрессоров исключает риск загрязнения маслом, обеспечивая высококачественный чистый воздух, необходимый для таких чувствительных процессов, как розлив ПЭТ-бутылок. Такая конструкция не только защищает вашу продукцию, но и значительно снижает потребность в техническом обслуживании, связанном с маслом, сокращая количество отходов и сохраняя природные ресурсы.',
        icon: 'drop-off',
    },
    {
        title: 'Энергоэффективность',
        description: 'Энергоэффективность лежит в основе нашей стратегии устойчивого развития. Наши компрессоры спроектированы таким образом, чтобы потреблять меньше энергии, обеспечивая при этом максимальную производительность. Это означает снижение эксплуатационных расходов для вас и уменьшение углеродного следа для планеты.\nНаш акцент на низком удельном энергопотреблении гарантирует, что вы получите максимальную отдачу от каждого киловатта, обеспечивая как эффективность, так и экологичность.',
        icon: 'energy',
    },
];

const renderIcon = (icon) => {
    if (icon === 'bulb') {
        return 'M12 3.5a5.5 5.5 0 0 0-3.65 9.62c.64.58 1.2 1.48 1.43 2.38h4.44c.23-.9.79-1.8 1.43-2.38A5.5 5.5 0 0 0 12 3.5Zm-2.03 13.5h4.06M10.4 20.5h3.2';
    }

    if (icon === 'drop-off') {
        return 'M12 3.5s-4.5 4.99-4.5 8.18A4.5 4.5 0 0 0 12 16.18a4.5 4.5 0 0 0 4.5-4.5C16.5 8.49 12 3.5 12 3.5ZM6 18 18 6';
    }

    return 'M13 2 6.5 13H11l-1 9 6.5-11H13l0-9Z';
};
</script>

<template>
    <div class="sustainability-page">
        <section class="sustainability-page__hero">
            <div class="container mx-auto px-4 h-full">
                <div class="sustainability-page__hero-inner">
                    <Breadcrumbs :items="breadcrumbItems" />

                    <div class="sustainability-page__hero-copy">
                        <h1 class="sustainability-page__hero-title">Устойчивое развитие</h1>
                        <p class="sustainability-page__hero-lead">
                            Для компании AF Compressors устойчивое развитие — это не просто цель, а основополагающий принцип.
                        </p>
                        <p class="sustainability-page__hero-text">
                            Наши безмасляные компрессоры разработаны для снижения энергопотребления, исключения загрязнения маслом и продления срока службы оборудования, что способствует созданию более экологичной и устойчивой промышленной экосистемы.
                        </p>
                        <p class="sustainability-page__hero-text">
                            Мы стремимся помочь нашим клиентам сократить выбросы углекислого газа, сохраняя при этом высочайший уровень операционной эффективности.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="sustainability-page__section">
            <div class="container mx-auto px-4">
                <h2 class="site-h2 sustainability-page__section-title">
                    Вот как компания AF лидирует в разработке экологичных решений для компрессионного белья.
                </h2>

                <div class="sustainability-page__feature-grid">
                    <article
                        v-for="item in featureItems"
                        :key="item.title"
                        class="sustainability-page__feature-card"
                    >
                        <div class="sustainability-page__feature-head">
                            <div class="sustainability-page__feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path
                                        :d="renderIcon(item.icon)"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>

                            <h3 class="sustainability-page__feature-title">{{ item.title }}</h3>
                        </div>

                        <p class="sustainability-page__text sustainability-page__text--preline">{{ item.description }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="sustainability-page__section sustainability-page__section--compact">
            <div class="container mx-auto px-4">
                <div class="sustainability-page__split sustainability-page__split--blue">
                    <div class="sustainability-page__media-shell sustainability-page__media-shell--plain">
                        <img
                            src="/img/sustainability/af-compressors-services-maintenance-1536x590.jpg"
                            alt="AF Compressors services maintenance"
                            class="sustainability-page__image sustainability-page__image--wide"
                        >
                    </div>

                    <div class="sustainability-page__copy-panel sustainability-page__copy-panel--blue">
                        <h3 class="sustainability-page__subheading">Усовершенствованные системы мониторинга</h3>
                        <p class="sustainability-page__text">
                            Наши современные системы мониторинга и управления обеспечивают получение информации о работе компрессора в режиме реального времени, что позволяет проводить точную оптимизацию и заблаговременное выявление потенциальных проблем. Благодаря возможности прогнозирующего технического обслуживания мы помогаем вам избежать неожиданных простоев и гарантируем максимальную эффективность работы компрессора, что дополнительно экономит энергию и ресурсы.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="sustainability-page__section sustainability-page__section--compact">
            <div class="container mx-auto px-4">
                <div class="sustainability-page__split sustainability-page__split--reverse">
                    <div class="sustainability-page__copy-panel sustainability-page__copy-panel--white">
                        <h3 class="sustainability-page__subheading">Долговечность</h3>
                        <p class="sustainability-page__text">
                            Наши компрессоры, созданные для работы в самых суровых промышленных условиях, отличаются непревзойденной надежностью и долговечностью. Более длительный срок службы означает меньшее количество замен и меньше отходов, что способствует более устойчивой промышленной экосистеме.
                        </p>
                        <p class="sustainability-page__text">
                            Наши надежные конструкции обеспечивают непрерывную и эффективную работу, снижая необходимость в частом капитальном ремонте и минимизируя воздействие на окружающую среду.
                        </p>
                        <p class="sustainability-page__text">
                            Кроме того, мы предлагаем индивидуальные решения по компрессорному оборудованию, разработанные с учетом ваших конкретных требований. Такой индивидуальный подход гарантирует, что наши системы не только эффективны, но и оптимизированы для вашего конкретного применения, что повышает общую экологичность.
                        </p>
                    </div>

                    <div class="sustainability-page__media-shell sustainability-page__media-shell--plain">
                        <img
                            src="/img/sustainability/af-compressors-compressor-pieces.jpg"
                            alt="AF Compressors compressor pieces"
                            class="sustainability-page__image sustainability-page__image--wide"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="sustainability-page__section sustainability-page__section--practice">
            <div class="container mx-auto px-4">
                <div class="sustainability-page__practice">
                    <div class="sustainability-page__practice-main">
                        <h3 class="sustainability-page__subheading">Устойчивое развитие на практике</h3>
                        <p class="sustainability-page__text">
                            Наша приверженность принципам устойчивого развития отражается как в разрабатываемых нами технологиях, так и в способе ведения нашей деятельности, где мы постоянно уделяем особое внимание энергоэффективности, надежности и рациональному использованию ресурсов.
                        </p>

                        <div class="sustainability-page__practice-links">
                            <a href="/sustainability/our-products" class="sustainability-page__cta-link">
                                <span>Откройте для себя наши экологически чистые технологии.</span>
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>

                            <a href="/sustainability/our-operations" class="sustainability-page__cta-link">
                                <span>Узнайте о нашей ответственной деятельности.</span>
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="sustainability-page__practice-side">
                        <img
                            src="/img/certificats/logo-ecovadis-white.svg"
                            alt="EcoVadis"
                            class="sustainability-page__ecovadis"
                        >
                        <p class="sustainability-page__text">
                            Компания AF Compressors, прошедшая оценку EcoVadis, продолжает двигаться вперед по пути к устойчивым практикам, уделяя особое внимание экологической и социальной ответственности. На протяжении десятилетий AF внедряет инновации в области устойчивого проектирования, стремясь к снижению энергопотребления.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="sustainability-page__section sustainability-page__section--join">
            <div class="container mx-auto px-4">
                <div class="sustainability-page__join">
                    <h2 class="site-h2 sustainability-page__join-title">Присоединяйтесь к нам на пути к более устойчивому будущему!</h2>

                    <a href="/contact" class="sustainability-page__join-link">
                        <span class="sustainability-page__join-track">
                            <span class="sustainability-page__join-badge">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.sustainability-page {
    background: var(--color-white);
}

.sustainability-page__hero {
    min-height: 400px;
    background: var(--color-primary-800);
}

.sustainability-page__hero-inner {
    display: flex;
    flex-direction: column;
    gap: 44px;
    min-height: 400px;
    padding: 48px 0 56px;
}

.sustainability-page__hero-copy {
    display: flex;
    flex-direction: column;
    gap: 18px;
    max-width: 920px;
}

.sustainability-page__hero-title {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3rem, 2.4rem + 1.6vw, 4.6rem);
    font-weight: 300;
    line-height: 0.98;
}

.sustainability-page__hero-lead {
    margin: 0;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.35rem, 1.1394736842rem + 0.5614035088vw, 2.15rem);
    font-weight: 500;
    line-height: 1.14;
}

.sustainability-page__hero-text,
.sustainability-page__text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.72;
}

.sustainability-page__hero-text {
    max-width: 860px;
    color: rgba(255, 255, 255, 0.92);
}

.sustainability-page__section {
    padding: 84px 0;
    background: var(--color-white);
}

.sustainability-page__section--compact {
    padding-top: 0;
}

.sustainability-page__section-title {
    max-width: 980px;
    margin: 0 0 34px;
}

.sustainability-page__feature-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
}

.sustainability-page__feature-card {
    display: flex;
    flex-direction: column;
    gap: 20px;
    min-height: 100%;
    padding: 32px 28px;
    border-radius: 28px;
    border: 1px solid rgba(231, 192, 96, 0.24);
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(255, 250, 240, 0.82));
}

.sustainability-page__feature-head {
    display: flex;
    align-items: center;
    gap: 18px;
}

.sustainability-page__feature-icon {
    flex: 0 0 auto;
    display: grid;
    place-items: center;
    width: 76px;
    height: 76px;
    border-radius: 999rem;
    background: rgba(251, 241, 195, 0.76);
    color: #c98927;
}

.sustainability-page__feature-icon svg {
    width: 34px;
    height: 34px;
}

.sustainability-page__feature-title,
.sustainability-page__subheading {
    margin: 0;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.6rem, 1.4684210526rem + 0.350877193vw, 2.1rem);
    font-weight: 300;
    line-height: 1.06;
}

.sustainability-page__text--preline {
    white-space: pre-line;
}

.sustainability-page__split {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    align-items: stretch;
    gap: 28px;
}

.sustainability-page__split--reverse .sustainability-page__copy-panel {
    order: 1;
}

.sustainability-page__split--reverse .sustainability-page__media-shell {
    order: 2;
}

.sustainability-page__media-shell {
    overflow: hidden;
    border-radius: 28px;
    min-height: 100%;
}

.sustainability-page__media-shell--plain {
    background: #dfeff9;
}

.sustainability-page__image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sustainability-page__image--wide {
    min-height: 420px;
}

.sustainability-page__copy-panel {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 18px;
    padding: 38px 34px;
    border-radius: 28px;
}

.sustainability-page__copy-panel--blue {
    background: linear-gradient(180deg, rgba(226, 240, 250, 0.95), rgba(240, 249, 255, 0.96));
}

.sustainability-page__copy-panel--white {
    background: var(--color-white);
    border: 1px solid rgba(83, 165, 220, 0.14);
}

.sustainability-page__section--practice {
    padding-bottom: 72px;
}

.sustainability-page__practice {
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
    gap: 28px;
    align-items: stretch;
}

.sustainability-page__practice-main {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 40px 36px;
    border-radius: 30px;
    background: linear-gradient(135deg, rgba(219, 246, 216, 0.96), rgba(249, 253, 247, 0.98));
}

.sustainability-page__practice-side {
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    padding: 36px 32px;
    border-radius: 30px;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(244, 250, 255, 0.94));
    border: 1px solid rgba(83, 165, 220, 0.14);
}

.sustainability-page__ecovadis {
    display: block;
    width: 180px;
    max-width: 100%;
    filter: brightness(0) saturate(100%) invert(31%) sepia(10%) saturate(999%) hue-rotate(155deg) brightness(95%) contrast(89%);
}

.sustainability-page__practice-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 4px;
}

.sustainability-page__cta-link {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    width: fit-content;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    line-height: 1.3;
    text-decoration: none;
    transition: color 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.sustainability-page__cta-link svg {
    width: 20px;
    height: 20px;
    transition: transform 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.sustainability-page__cta-link:hover {
    color: var(--color-secondary-400);
}

.sustainability-page__cta-link:hover svg {
    transform: translateX(4px);
}

.sustainability-page__section--join {
    padding-top: 8px;
}

.sustainability-page__join {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 380px;
    gap: 28px;
    align-items: center;
}

.sustainability-page__join-title {
    margin: 0;
}

.sustainability-page__join-link {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 14px 0;
    text-decoration: none;
}

.sustainability-page__join-track {
    --join-badge-size: 54px;
    position: relative;
    width: 100%;
    height: 6px;
    border-radius: 999rem;
    background: linear-gradient(90deg, rgba(251, 181, 91, 0.96), rgba(248, 201, 135, 0.94));
}

.sustainability-page__join-badge {
    position: absolute;
    left: 0;
    top: 50%;
    display: grid;
    place-items: center;
    width: var(--join-badge-size);
    height: var(--join-badge-size);
    border-radius: 999rem;
    background: var(--color-secondary-500);
    color: var(--color-white);
    box-shadow: 0 12px 26px rgba(251, 181, 91, 0.28);
    transform: translateY(-50%);
    transition: left 300ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.sustainability-page__join-badge svg {
    width: 22px;
    height: 22px;
}

.sustainability-page__join-link:hover .sustainability-page__join-badge {
    left: calc(100% - var(--join-badge-size));
}

@media (max-width: 1023px) {
    .sustainability-page__feature-grid,
    .sustainability-page__split,
    .sustainability-page__practice,
    .sustainability-page__join {
        grid-template-columns: 1fr;
    }

    .sustainability-page__split--reverse .sustainability-page__copy-panel,
    .sustainability-page__split--reverse .sustainability-page__media-shell {
        order: initial;
    }

    .sustainability-page__join {
        gap: 22px;
    }

    .sustainability-page__join-link {
        max-width: 420px;
    }
}

@media (max-width: 767px) {
    .sustainability-page__hero-inner {
        gap: 28px;
        padding: 32px 0 40px;
    }

    .sustainability-page__section {
        padding: 56px 0;
    }

    .sustainability-page__feature-card,
    .sustainability-page__copy-panel,
    .sustainability-page__practice-main,
    .sustainability-page__practice-side {
        padding: 28px 24px;
        border-radius: 22px;
    }

    .sustainability-page__media-shell {
        border-radius: 22px;
    }

    .sustainability-page__image--wide {
        min-height: 240px;
    }

    .sustainability-page__feature-head {
        align-items: flex-start;
    }

    .sustainability-page__feature-icon {
        width: 62px;
        height: 62px;
    }

    .sustainability-page__join-track {
        --join-badge-size: 48px;
        height: 4px;
    }

    .sustainability-page__join-badge {
        width: var(--join-badge-size);
        height: var(--join-badge-size);
    }
}
</style>
