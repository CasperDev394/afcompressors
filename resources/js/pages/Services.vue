<script setup>
const breadcrumbItems = [
    { label: 'Услуги', current: true },
];

const presaleItems = [
    'Консультации инженера: Детальный анализ для определения наиболее подходящей конфигурации компрессора для вашего применения.',
    'Решения по повышению энергоэффективности: рекомендации по энергосберегающим технологиям, таким как системы регулирования, рекуперация тепла и системы управления в рамках концепции «Индустрия 4.0», для снижения эксплуатационных расходов.',
    'Анализ совокупной стоимости владения (TCO): комплексная оценка для обеспечения долгосрочной экономической эффективности предлагаемого решения.',
];

const predictiveItems = [
    'Регулярные системные аудиты: Проведение комплексных механических и энергетических аудитов для выявления областей, требующих улучшения, и обеспечения оптимальной производительности.',
    'Индивидуальные планы технического обслуживания: разработка графиков технического обслуживания, соответствующих ритму вашего производства, минимизация незапланированных простоев и продление срока службы вашего оборудования.',
    'Модернизация для оптимизации производительности: внедрение системных усовершенствований, таких как улучшенные баллоны и системы рециркуляции воздуха, для повышения эффективности и снижения энергопотребления.',
    'Передовые решения для мониторинга: использование технологий Индустрии 4.0 для мониторинга данных в режиме реального времени, что позволяет заблаговременно выявлять аномалии и принимать обоснованные решения по техническому обслуживанию.',
];

const supportItems = [
    {
        title: 'Круглосуточная поддержка по всему миру.',
        description: 'Наши многоязычные технические специалисты доступны круглосуточно, чтобы оказывать высококвалифицированную помощь по телефону или на вашем объекте, обеспечивая минимальное время простоя и оперативное решение проблем.',
        icon: 'globe',
    },
    {
        title: 'Наличие запасных частей в кратчайшие сроки',
        description: 'Наши стратегически расположенные центры запасных частей гарантируют наличие всех компонентов для немедленной отправки, обеспечивая бесперебойную работу вашей установки сжатого воздуха.',
        icon: 'box',
    },
    {
        title: 'Мероприятия по техническому обслуживанию',
        description: 'Гибкие услуги по техническому обслуживанию варьируются от выездных работ по запросу до комплексных договоров на техническое обслуживание «все включено», разработанных с учетом конкретных потребностей и производственных графиков клиентов.',
        icon: 'tool',
    },
    {
        title: 'Программы обучения',
        description: 'Компания AF Compressors предлагает программы обучения для повышения квалификации штатных сотрудников клиентов, способствуя эффективной эксплуатации и техническому обслуживанию оборудования.',
        icon: 'graduation',
    },
    {
        title: 'Разветвленная сеть сервисных центров',
        description: 'Благодаря штату из более чем 150 квалифицированных технических специалистов и 15 дочерним компаниям, располагающим полным ассортиментом запасных частей, мы обеспечиваем оперативное реагирование и локальную поддержку в более чем 185 странах.',
        icon: 'network',
    },
];

const renderIcon = (icon) => {
    if (icon === 'globe') {
        return 'M12 3.5a8.5 8.5 0 1 0 0 17a8.5 8.5 0 0 0 0-17Zm0 0c2.04 2.2 3.15 5.1 3.15 8.5S14.04 18.3 12 20.5m0-17c-2.04 2.2-3.15 5.1-3.15 8.5S9.96 18.3 12 20.5M4 12h16';
    }

    if (icon === 'box') {
        return 'M4.5 8.2 12 12.5m0 0 7.5-4.3M12 12.5V21M5.2 7.8 12 4l6.8 3.8M4.8 8.2v7.6L12 20l7.2-4.2V8.2';
    }

    if (icon === 'tool') {
        return 'M14.5 6.5a3.5 3.5 0 0 0 4.06 4.06l-7.72 7.72a2 2 0 0 1-2.83 0l-.21-.21a2 2 0 0 1 0-2.83l7.72-7.72A3.5 3.5 0 0 0 14.5 6.5Z';
    }

    if (icon === 'graduation') {
        return 'M3.5 9.5 12 5l8.5 4.5-8.5 4.5L3.5 9.5Zm3 2.3v4.2c0 .62 2.46 2.5 5.5 2.5s5.5-1.88 5.5-2.5v-4.2';
    }

    return 'M4 16.5h4v3H4v-3Zm6-6h4v9h-4v-9Zm6-4h4v13h-4v-13ZM2.5 20.5h19';
};
</script>

<template>
    <div class="services-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Услуги"
            description="Компания AF Compressors предлагает полный спектр услуг, призванных поддерживать клиентов на протяжении всего жизненного цикла их компрессоров, обеспечивая оптимальную производительность, снижение эксплуатационных расходов и увеличение срока службы оборудования. Три основных вида услуг включают:"
            :min-height="400"
            copy-max-width="980px"
        />

        <section class="services-page__section">
            <div class="container mx-auto px-4">
                <div class="services-page__intro-block">
                    <div class="services-page__section-head">
                        <span class="services-page__number">1</span>
                        <h2 id="presale" class="site-h2 services-page__title">Предпродажные услуги</h2>
                    </div>

                    <p class="services-page__text">
                        В компании AF Compressors мы понимаем, что выбор правильной системы сжатого воздуха имеет решающее значение для вашей деятельности. Наши предпродажные услуги разработаны таким образом, чтобы помочь вам в этом важном процессе принятия решений. Наши опытные коммерческие консультанты тесно сотрудничают с вашей инженерной командой для оценки ваших конкретных требований, включая качество воздуха, объем и потребности в давлении. Используя наш обширный опыт, мы предлагаем индивидуальные решения, которые оптимизируют как капитальные затраты (CapEx), так и операционные затраты (OpEx).
                    </p>
                </div>

                <div class="services-page__split">
                    <div class="services-page__copy">
                        <p class="services-page__text services-page__text--emphasis">В число наших предложений входят:</p>

                        <ul class="services-page__list">
                            <li v-for="item in presaleItems" :key="item">{{ item }}</li>
                        </ul>

                        <p class="services-page__text">
                            Сотрудничество с AF Compressors на этапе предпродажной подготовки дает вам доступ к многолетнему опыту и инновациям, гарантируя решение, идеально соответствующее вашему производственному профилю и операционным целям.
                        </p>
                    </div>

                    <div class="services-page__media-shell">
                        <img
                            src="/img/services/af-compressors-compressor-pieces.jpg"
                            alt="AF Compressors presale services"
                            class="services-page__image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="services-page__section services-page__section--support">
            <div class="container mx-auto px-4">
                <div class="services-page__section-head">
                    <span class="services-page__number">2</span>
                    <h2 id="aftersale" class="site-h2 services-page__title">Техническая поддержка и послепродажное обслуживание</h2>
                </div>

                <div class="services-page__stack">
                    <p class="services-page__text">
                        Компания AF Compressors стремится предоставлять непревзойденную техническую поддержку и послепродажное обслуживание для поддержания надежности и эффективности вашего оборудования.
                    </p>
                    <p class="services-page__text">
                        Наша специализированная сервисная команда активно помогает вам в обслуживании и оптимизации вашего компрессора, обеспечивая десятилетия высокой производительности и бесперебойной работы.
                    </p>
                    <p class="services-page__text">
                        Наша глобальная сервисная сеть является одной из самых эффективных в мире для безмасляных поршневых воздушных компрессоров и включает в себя:
                    </p>
                </div>

                <div class="services-page__support-grid">
                    <article
                        v-for="item in supportItems"
                        :key="item.title"
                        class="services-page__support-card"
                    >
                        <div class="services-page__support-head">
                            <div class="services-page__support-icon">
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

                            <h3 class="services-page__support-title">{{ item.title }}</h3>
                        </div>

                        <p class="services-page__text">{{ item.description }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="services-page__section">
            <div class="container mx-auto px-4">
                <div class="services-page__intro-block">
                    <div class="services-page__section-head">
                        <span class="services-page__number">3</span>
                        <h2 id="predictive" class="site-h2 services-page__title">Прогнозируемое техническое обслуживание</h2>
                    </div>

                    <p class="services-page__text">
                        Понимая важность профилактического ухода за оборудованием, компания AF Compressors предлагает услуги по прогнозируемому техническому обслуживанию, разработанные для предотвращения и устранения потенциальных проблем до того, как они обострятся. Наши программы профилактического обслуживания сосредоточены на:
                    </p>
                </div>

                <div class="services-page__split services-page__split--predictive">
                    <div class="services-page__copy">
                        <ul class="services-page__list">
                            <li v-for="item in predictiveItems" :key="item">{{ item }}</li>
                        </ul>

                        <div class="services-page__quote">
                            <div class="services-page__quote-mark">“</div>
                            <p class="services-page__quote-text">
                                Выбирая услуги по профилактическому техническому обслуживанию от AF Compressors, вы получаете выгоду от снижения эксплуатационных расходов, повышения производительности и уверенности в том, что ваша система сжатого воздуха будет работать с максимальной эффективностью на протяжении всего срока службы.
                            </p>
                        </div>
                    </div>

                    <div class="services-page__media-shell">
                        <img
                            src="/img/services/af-compressors-maintenance.jpg"
                            alt="AF Compressors predictive maintenance"
                            class="services-page__image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.services-page {
    background: var(--color-white);
}

.services-page__section {
    padding: 80px 0;
    background: var(--color-white);
}

.services-page__section--support {
    background: linear-gradient(135deg, rgba(226, 240, 250, 0.92), rgba(250, 253, 255, 0.98));
}

.services-page__intro-block {
    display: flex;
    flex-direction: column;
    gap: 24px;
    margin-bottom: 38px;
    max-width: 1080px;
}

.services-page__section-head {
    display: flex;
    align-items: flex-start;
    gap: 18px;
}

.services-page__number {
    flex: 0 0 auto;
    min-width: 0.9em;
    color: rgba(11, 40, 59, 0.46);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(2.2rem, 1.8842105263rem + 0.8421052632vw, 3.4rem);
    font-weight: 400;
    line-height: 1;
    letter-spacing: -0.03em;
}

.services-page__title {
    margin: 0;
}

.services-page__text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.72;
}

.services-page__text--emphasis {
    color: var(--color-primary-800);
}

.services-page__stack {
    display: flex;
    flex-direction: column;
    gap: 18px;
    max-width: 1120px;
    margin-bottom: 34px;
}

.services-page__split {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 0.96fr);
    gap: 38px;
    align-items: start;
}

.services-page__split--predictive {
    align-items: stretch;
}

.services-page__copy {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.services-page__list {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin: 0;
    padding-left: 22px;
    color: rgba(11, 40, 59, 0.86);
    line-height: 1.7;
}

.services-page__list li::marker {
    color: var(--color-secondary-500);
}

.services-page__media-shell {
    overflow: hidden;
    border-radius: 28px;
    background: #eaf4fb;
    min-height: 100%;
}

.services-page__image {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 420px;
    object-fit: cover;
}

.services-page__support-grid {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 22px;
}

.services-page__support-card {
    display: flex;
    flex-direction: column;
    gap: 18px;
    min-height: 100%;
    padding: 28px 24px;
    border-radius: 26px;
    border: 1px solid rgba(83, 165, 220, 0.18);
    background: rgba(255, 255, 255, 0.94);
}

.services-page__support-card:nth-child(1),
.services-page__support-card:nth-child(2),
.services-page__support-card:nth-child(3) {
    grid-column: span 2;
}

.services-page__support-card:nth-child(4) {
    grid-column: 1 / span 2;
}

.services-page__support-card:nth-child(5) {
    grid-column: 3 / span 2;
}

.services-page__support-head {
    display: flex;
    align-items: center;
    gap: 16px;
}

.services-page__support-icon {
    flex: 0 0 auto;
    display: grid;
    place-items: center;
    width: 72px;
    height: 72px;
    border-radius: 999rem;
    background: var(--color-white);
    color: #c98927;
    box-shadow: inset 0 0 0 1px rgba(231, 192, 96, 0.34);
}

.services-page__support-icon svg {
    width: 32px;
    height: 32px;
}

.services-page__support-title {
    margin: 0;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.3rem, 1.1947368421rem + 0.2807017544vw, 1.7rem);
    font-weight: 300;
    line-height: 1.08;
}

.services-page__quote {
    position: relative;
    margin-top: 6px;
    padding: 28px 28px 28px 70px;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(251, 235, 178, 0.94), rgba(255, 248, 229, 0.98));
}

.services-page__quote-mark {
    position: absolute;
    top: 18px;
    left: 22px;
    color: var(--color-secondary-500);
    font-family: Georgia, serif;
    font-size: 4rem;
    line-height: 0.7;
}

.services-page__quote-text {
    margin: 0;
    color: rgba(11, 40, 59, 0.88);
    font-size: 1rem;
    line-height: 1.72;
}

@media (max-width: 1199px) {
    .services-page__support-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .services-page__support-card:nth-child(1),
    .services-page__support-card:nth-child(2),
    .services-page__support-card:nth-child(3),
    .services-page__support-card:nth-child(4),
    .services-page__support-card:nth-child(5) {
        grid-column: auto;
    }
}

@media (max-width: 1023px) {
    .services-page__section {
        padding: 64px 0;
    }

    .services-page__split {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .services-page__image {
        min-height: 320px;
    }
}

@media (max-width: 767px) {
    .services-page__section {
        padding: 52px 0;
    }

    .services-page__section-head {
        gap: 14px;
    }

    .services-page__intro-block {
        margin-bottom: 28px;
    }

    .services-page__support-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .services-page__support-card,
    .services-page__quote {
        border-radius: 20px;
    }

    .services-page__support-card {
        padding: 24px 20px;
    }

    .services-page__quote {
        padding: 24px 20px 24px 56px;
    }

    .services-page__quote-mark {
        left: 16px;
        font-size: 3.4rem;
    }

    .services-page__support-icon {
        width: 62px;
        height: 62px;
    }

    .services-page__media-shell {
        border-radius: 22px;
    }

    .services-page__image {
        min-height: 240px;
    }
}
</style>
