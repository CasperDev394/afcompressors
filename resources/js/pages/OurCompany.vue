<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const breadcrumbItems = [
    { label: 'Наша компания', current: true },
];

const productsList = [
    'Трехступенчатые безмасляные поршневые компрессоры для ПЭТ. 15–40 бар.',
    'Двухступенчатые безмасляные поршневые компрессоры OPC. 8 и 10 бар.',
    '«Всё в одном», объединяющее воздух высокого и низкого давления.',
];

const timelineSections = [
    {
        image: '/img/our-company/af-compresors-rooftop-solar-pannels.jpg',
        alt: 'AF Compressors rooftop solar panels',
        imageFirst: true,
        items: [
            {
                year: '1870',
                text: 'Компания AF, находящаяся в частной собственности, была основана в Льеже, Бельгия, для производства пневматических молотков для горнодобывающей промышленности.',
            },
            {
                year: '1900–1960',
                text: 'Компания AF производит поршневые компрессоры для угольной и металлургической промышленности.',
            },
            {
                year: '1960',
                text: 'Безмасляные поршневые компрессоры с поршневыми кольцами из ПТФЭ были разработаны и успешно применяются в пивоваренной, химической и пищевой промышленности.',
            },
        ],
    },
    {
        image: '/img/our-company/ateliers-francois-compresseurs-logo-factory-entrance.jpg',
        alt: 'AF Compressors logo and factory entrance',
        imageFirst: false,
        items: [
            {
                year: '1980',
                text: 'Компания AF начинает производство безмасляных компрессоров для ПЭТ-бутылок, чтобы выйти на формирующийся рынок ПЭТ-бутылок.',
            },
            {
                year: '2000',
                text: 'Компания AF стала ведущим поставщиком и специалистом на рынке безмасляных компрессоров высокого давления для ПЭТ-трубок.',
            },
        ],
    },
    {
        image: '/img/our-company/af-compressors-foctury-compressor-pet-opc.jpg',
        alt: 'AF Compressors factory compressor PET OPC',
        imageFirst: true,
        items: [
            {
                year: '2010',
                text: 'Компания AF расширяет ассортимент продукции для низконапорных применений, включая двухступенчатые безмасляные поршневые компрессоры, предназначенные для пищевой промышленности, производства напитков и других промышленных применений.',
            },
            {
                year: 'Сегодня',
                text: 'Ведущий производитель безмасляных поршневых компрессоров с 60% долей на рынке компрессоров для ПЭТ.',
            },
        ],
    },
];

const statsSection = ref(null);
const countersStarted = ref(false);
const animatedValues = ref([0, 0, 0, 0, 0, 0]);

const statItems = [
    { value: 3, prefix: '', text: 'Глобальное присутствие, локальная экспертиза' },
    { value: 3, prefix: '', text: 'Распределительные центры: основной узел комплектующих и центр хранения всех запасных частей.' },
    { value: 150, prefix: '+', text: 'Специализированные инженеры' },
    { value: 15, prefix: '', text: 'Дочерние компании: коммерческая и техническая поддержка' },
    { value: 20, prefix: '', text: 'Официальные представительства: запасные части имеются на складе.' },
    { value: 6, prefix: '', text: 'Учебные центры' },
];

const formattedStatValues = computed(() => statItems.map((item, index) => `${item.prefix}${animatedValues.value[index]}`));

let statsObserver = null;
let animationFrameId = null;

const startCounters = () => {
    if (countersStarted.value) {
        return;
    }

    countersStarted.value = true;

    const start = performance.now();
    const duration = 1400;

    const tick = (timestamp) => {
        const progress = Math.min((timestamp - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);

        animatedValues.value = statItems.map((item) => Math.round(item.value * eased));

        if (progress < 1) {
            animationFrameId = window.requestAnimationFrame(tick);
        }
    };

    animationFrameId = window.requestAnimationFrame(tick);
};

onMounted(() => {
    if (!statsSection.value) {
        return;
    }

    statsObserver = new IntersectionObserver(
        (entries) => {
            if (entries.some((entry) => entry.isIntersecting)) {
                startCounters();
                statsObserver?.disconnect();
                statsObserver = null;
            }
        },
        {
            threshold: 0.25,
        },
    );

    statsObserver.observe(statsSection.value);
});

onBeforeUnmount(() => {
    statsObserver?.disconnect();

    if (animationFrameId) {
        window.cancelAnimationFrame(animationFrameId);
    }
});
</script>

<template>
    <div class="our-company-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Наша компания"
            subtitle="Инновации и традиции в индустрии сжатого воздуха с 1870 года"
            :min-height="400"
            copy-max-width="960px"
        />

        <section class="our-company-page__section">
            <div class="container mx-auto px-4">
                <div class="our-company-page__split">
                    <div class="our-company-page__copy">
                        <h2 class="site-h2 our-company-page__title">
                            AF Compressors — лидер в производстве безмасляных поршневых компрессоров.
                        </h2>

                        <p class="our-company-page__text">
                            Компания AF compressors является мировым лидером в поставке высококачественных безмасляных поршневых компрессоров для рынка выдувного формования ПЭТ.
                        </p>

                        <p class="our-company-page__text">
                            Помимо нашего главного завода и штаб-квартиры в Бельгии, у нас есть производственные центры мирового класса в Куньшане (Китай) и Пуне (Индия), которые поддерживают эти процветающие рынки.
                        </p>

                        <p class="our-company-page__text">
                            Компания AF Compressors находится на переднем крае инноваций в области безмасляных поршневых компрессоров, предлагая надежные, эффективные и экологичные решения для отраслей промышленности по всему миру. Обладая более чем 150-летним опытом и стремлением к совершенству, мы стали надежным партнером для предприятий, предъявляющих самые высокие требования к производительности и экологической ответственности.
                        </p>
                    </div>

                    <div class="our-company-page__media-shell">
                        <img
                            src="/img/our-company/pet-l5-series-1.png"
                            alt="AF Compressors PET L5 series"
                            class="our-company-page__image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="our-company-page__mission">
            <div class="container mx-auto px-4">
                <div class="our-company-page__mission-panel">
                    <h2 class="site-h2 our-company-page__mission-title">Наша миссия</h2>
                    <p class="our-company-page__text our-company-page__text--mission">
                        Наша миссия — предоставлять передовые компрессорные решения, повышающие эффективность работы и минимизирующие воздействие на окружающую среду. Мы стремимся стать мировым эталоном в области безмасляных компрессорных технологий, помогая нашим клиентам достигать своих целей с уверенностью, а устойчивое развитие лежит в основе всего, что мы делаем.
                    </p>
                </div>
            </div>
        </section>

        <section class="our-company-page__section">
            <div class="container mx-auto px-4">
                <div class="our-company-page__split our-company-page__split--products">
                    <div class="our-company-page__copy">
                        <h2 class="site-h2 our-company-page__title">Наши продукты и решения</h2>

                        <p class="our-company-page__text">
                            Компания AF Compressors специализируется на проектировании, производстве и обслуживании безмасляных поршневых компрессоров, уделяя особое внимание отрасли розлива ПЭТ-бутылок.
                        </p>

                        <p class="our-company-page__text">
                            Наши компрессоры разработаны для оптимальной производительности, обеспечивая подачу чистого, безмасляного воздуха, соответствующего строгим требованиям к качеству, предъявляемым к различным областям применения.
                        </p>

                        <p class="our-company-page__text">
                            Мы предлагаем широкий ассортимент безмасляных компрессоров, каждый из которых разработан с учетом уникальных потребностей наших клиентов. От небольших предприятий до крупных промышленных объектов, наши компрессоры обеспечивают надежность и эффективность, необходимые вашему бизнесу.
                        </p>

                        <p class="our-company-page__text">
                            В наш ассортимент продукции входят:
                        </p>

                        <ul class="our-company-page__list">
                            <li v-for="item in productsList" :key="item">{{ item }}</li>
                        </ul>
                    </div>

                    <div class="our-company-page__media-shell">
                        <img
                            src="/img/our-company/savings.jpg"
                            alt="AF Compressors products and solutions"
                            class="our-company-page__image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="our-company-page__section our-company-page__section--map">
            <div class="container mx-auto px-4">
                <div class="our-company-page__split our-company-page__split--map-layout">
                    <div class="our-company-page__media-shell our-company-page__media-shell--map">
                        <img
                            src="/img/map.jpg"
                            alt="AF Compressors global presence"
                            class="our-company-page__image our-company-page__image--map"
                        >
                    </div>

                    <div class="our-company-page__copy our-company-page__copy--map">
                        <h2 class="site-h2 our-company-page__title">Глобальное присутствие, локальная экспертиза</h2>

                        <p class="our-company-page__text">
                            Благодаря глобальной сети офисов и сервисных центров, компания AF Compressors готова поддержать ваш бизнес, где бы вы ни работали.
                        </p>

                        <p class="our-company-page__text">
                            Наша команда экспертов сочетает знание местной специфики с глобальным опытом, гарантируя вам наилучшее обслуживание и поддержку.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section ref="statsSection" class="our-company-page__section our-company-page__section--stats">
            <div class="container mx-auto px-4">
                <div class="our-company-page__stats-grid">
                    <article
                        v-for="(item, index) in statItems"
                        :key="`${item.value}-${index}`"
                        class="our-company-page__stat-card"
                    >
                        <div class="our-company-page__stat-value">{{ formattedStatValues[index] }}</div>
                        <p class="our-company-page__stat-text">{{ item.text }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="our-company-page__section our-company-page__section--insights">
            <div class="container mx-auto px-4">
                <div class="our-company-page__insights">
                    <article class="our-company-page__insight-card our-company-page__insight-card--green">
                        <h2 class="site-h2 our-company-page__title">Стремимся к более экологичному будущему</h2>
                        <p class="our-company-page__text">
                            В компании AF Compressors мы стремимся сократить наше воздействие на окружающую среду и помогаем нашим клиентам делать то же самое. Наш подход к устойчивому развитию распространяется не только на нашу продукцию, но и на нашу деловую практику, где мы стремимся внедрять экологически чистые процессы и сокращать количество отходов на каждом этапе производства.
                        </p>
                        <a href="/sustainability" class="our-company-page__cta-link">
                            <span>Наш устойчивый подход</span>
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
                    </article>

                    <article class="our-company-page__insight-card our-company-page__insight-card--white">
                        <h2 class="site-h2 our-company-page__title">Передовые решения</h2>
                        <p class="our-company-page__text">
                            Благодаря нашей научно-исследовательской лаборатории в Льеже, наши клиенты получают доступ к самым передовым и надежным решениям.
                        </p>
                        <p class="our-company-page__text">
                            Наш современный испытательный стенд подтверждает соответствие производительности системы вентиляции стандартам ISO 5167-2003 и ISO 1217-2009.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section id="history" class="our-company-page__section our-company-page__section--history">
            <div class="container mx-auto px-4">
                <div class="our-company-page__history">
                    <div class="our-company-page__history-copy">
                        <h2 class="site-h2 our-company-page__title">История</h2>
                        <h3 class="our-company-page__history-subtitle">Наследие, насчитывающее 150 лет</h3>

                        <p class="our-company-page__text">
                            Опыт и традиции компании AF заложили прочную основу для того, чтобы наша компания стала ведущим поставщиком высококачественных систем сжатого воздуха.
                        </p>

                        <p class="our-company-page__text">
                            Среди наших клиентов — самые известные производители выдувного формования и крупные производители напитков, таких как безалкогольные напитки, вода, соки, чай и другие, где требуется надежный сжатый воздух.
                        </p>
                    </div>

                    <div class="our-company-page__history-media">
                        <img
                            src="/img/our-company/af-compressors-buildings.jpg"
                            alt="AF Compressors history"
                            class="our-company-page__image our-company-page__image--history"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="our-company-page__section our-company-page__section--timeline">
            <div class="container mx-auto px-4">
                <div class="our-company-page__timeline">
                    <article
                        v-for="(section, index) in timelineSections"
                        :key="section.image"
                        class="our-company-page__timeline-block"
                        :class="{ 'our-company-page__timeline-block--reversed': !section.imageFirst }"
                    >
                        <div class="our-company-page__timeline-media">
                            <img
                                :src="section.image"
                                :alt="section.alt"
                                class="our-company-page__image our-company-page__image--timeline"
                            >
                        </div>

                        <div class="our-company-page__timeline-copy">
                            <div
                                v-for="item in section.items"
                                :key="`${index}-${item.year}`"
                                class="our-company-page__timeline-entry"
                            >
                                <h3 class="our-company-page__timeline-year">{{ item.year }}</h3>
                                <p class="our-company-page__text">{{ item.text }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.our-company-page {
    background: var(--color-white);
}

.our-company-page__section {
    padding: 84px 0;
    background: var(--color-white);
}

.our-company-page__split {
    display: grid;
    grid-template-columns: minmax(0, 0.96fr) minmax(0, 1.04fr);
    align-items: center;
    gap: 52px;
}

.our-company-page__split--products {
    grid-template-columns: minmax(0, 0.98fr) minmax(0, 1.02fr);
}

.our-company-page__split--map-layout {
    grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
}

.our-company-page__copy {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.our-company-page__copy--map {
    max-width: 520px;
}

.our-company-page__title {
    margin: 0 0 10px;
}

.our-company-page__text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.72;
}

.our-company-page__text--mission {
    max-width: 820px;
}

.our-company-page__media-shell {
    overflow: hidden;
    border-radius: 28px;
    background: linear-gradient(135deg, rgba(83, 165, 220, 0.14), rgba(255, 255, 255, 0.72));
}

.our-company-page__media-shell--map {
    min-height: 100%;
}

.our-company-page__image {
    display: block;
    width: 100%;
    height: auto;
    object-fit: cover;
}

.our-company-page__image--map {
    height: 100%;
    min-height: 420px;
}

.our-company-page__mission {
    padding: 88px 0 94px;
    background: linear-gradient(135deg, rgba(83, 165, 220, 0.22), rgba(240, 249, 255, 0.96));
}

.our-company-page__mission-panel {
    max-width: 860px;
    margin: 0 auto;
    text-align: center;
}

.our-company-page__mission-title {
    margin: 0 0 22px;
}

.our-company-page__list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin: 0;
    padding-left: 22px;
    color: rgba(11, 40, 59, 0.86);
    line-height: 1.7;
}

.our-company-page__list li::marker {
    color: var(--color-secondary-500);
}

.our-company-page__section--map {
    padding-top: 20px;
}

.our-company-page__section--stats {
    padding-top: 12px;
}

.our-company-page__stats-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
}

.our-company-page__stat-card {
    min-height: 220px;
    padding: 30px 28px;
    border: 1px solid rgba(83, 165, 220, 0.42);
    border-radius: 26px;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(240, 249, 255, 0.88));
    box-shadow: 0 20px 48px rgba(11, 40, 59, 0.08);
}

.our-company-page__stat-value {
    margin-bottom: 18px;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3rem, 2.4rem + 1.5vw, 4.5rem);
    font-weight: 300;
    line-height: 0.95;
}

.our-company-page__stat-text {
    margin: 0;
    color: rgba(11, 40, 59, 0.8);
    font-size: 1rem;
    line-height: 1.68;
}

.our-company-page__section--insights {
    padding-top: 28px;
}

.our-company-page__insights {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px;
}

.our-company-page__insight-card {
    display: flex;
    flex-direction: column;
    gap: 18px;
    min-height: 100%;
    padding: 38px 34px;
    border-radius: 30px;
}

.our-company-page__insight-card--green {
    background: linear-gradient(135deg, rgba(220, 247, 216, 0.95), rgba(248, 253, 247, 0.98));
}

.our-company-page__insight-card--white {
    border: 1px solid rgba(83, 165, 220, 0.18);
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(245, 251, 255, 0.94));
}

.our-company-page__cta-link {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-top: 6px;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.2;
    text-decoration: none;
    transition: color 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955), transform 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.our-company-page__cta-link svg {
    width: 20px;
    height: 20px;
    transition: transform 250ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
}

.our-company-page__cta-link:hover {
    color: var(--color-secondary-400);
}

.our-company-page__cta-link:hover svg {
    transform: translateX(4px);
}

.our-company-page__section--history {
    padding-top: 4px;
}

.our-company-page__history {
    display: grid;
    grid-template-columns: minmax(0, 1.12fr) minmax(0, 0.88fr);
    align-items: stretch;
    border-radius: 30px;
    overflow: hidden;
}

.our-company-page__history-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 18px;
    padding: 48px 42px;
    background: linear-gradient(135deg, rgba(251, 241, 195, 0.92), rgba(255, 251, 238, 0.98));
}

.our-company-page__history-subtitle {
    margin: -4px 0 8px;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.6rem, 1.4421052632rem + 0.4210526316vw, 2.2rem);
    font-weight: 300;
    line-height: 1.06;
}

.our-company-page__history-media {
    min-height: 100%;
}

.our-company-page__image--history {
    width: 100%;
    height: 100%;
    min-height: 420px;
    object-fit: cover;
}

.our-company-page__section--timeline {
    padding-top: 0;
}

.our-company-page__timeline {
    display: flex;
    flex-direction: column;
    gap: 28px;
}

.our-company-page__timeline-block {
    display: grid;
    grid-template-columns: minmax(0, 0.96fr) minmax(0, 1.04fr);
    align-items: stretch;
    gap: 28px;
}

.our-company-page__timeline-block--reversed {
    grid-template-columns: minmax(0, 1.04fr) minmax(0, 0.96fr);
}

.our-company-page__timeline-block--reversed .our-company-page__timeline-media {
    order: 2;
}

.our-company-page__timeline-block--reversed .our-company-page__timeline-copy {
    order: 1;
}

.our-company-page__timeline-media {
    overflow: hidden;
    border-radius: 28px;
    min-height: 100%;
}

.our-company-page__image--timeline {
    width: 100%;
    height: 100%;
    min-height: 420px;
    object-fit: cover;
}

.our-company-page__timeline-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 24px;
    padding: 36px 34px;
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(245, 251, 255, 0.94));
    border: 1px solid rgba(83, 165, 220, 0.16);
}

.our-company-page__timeline-entry {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.our-company-page__timeline-year {
    margin: 0;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.7rem, 1.5157894737rem + 0.4912280702vw, 2.4rem);
    font-weight: 300;
    line-height: 1;
}

@media (max-width: 1023px) {
    .our-company-page__section {
        padding: 68px 0;
    }

    .our-company-page__split,
    .our-company-page__split--products,
    .our-company-page__split--map-layout {
        grid-template-columns: 1fr;
        gap: 36px;
    }

    .our-company-page__split--map-layout .our-company-page__media-shell--map {
        order: -1;
    }

    .our-company-page__copy--map {
        max-width: none;
    }

    .our-company-page__stats-grid,
    .our-company-page__insights,
    .our-company-page__history,
    .our-company-page__timeline-block,
    .our-company-page__timeline-block--reversed {
        grid-template-columns: 1fr;
    }

    .our-company-page__stat-card {
        min-height: 190px;
    }

    .our-company-page__timeline-block--reversed .our-company-page__timeline-media,
    .our-company-page__timeline-block--reversed .our-company-page__timeline-copy {
        order: initial;
    }

    .our-company-page__image--timeline,
    .our-company-page__image--history,
    .our-company-page__image--map {
        min-height: 320px;
    }
}

@media (max-width: 767px) {
    .our-company-page__section {
        padding: 54px 0;
    }

    .our-company-page__mission {
        padding: 60px 0 64px;
    }

    .our-company-page__stats-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .our-company-page__split,
    .our-company-page__split--products,
    .our-company-page__split--map-layout {
        gap: 28px;
    }

    .our-company-page__stat-card,
    .our-company-page__insight-card,
    .our-company-page__history-copy,
    .our-company-page__timeline-copy {
        padding: 28px 24px;
        border-radius: 22px;
    }

    .our-company-page__history {
        border-radius: 22px;
    }

    .our-company-page__timeline-media,
    .our-company-page__media-shell {
        border-radius: 22px;
    }

    .our-company-page__timeline {
        gap: 22px;
    }

    .our-company-page__image--timeline,
    .our-company-page__image--history,
    .our-company-page__image--map {
        min-height: 240px;
    }
}
</style>
