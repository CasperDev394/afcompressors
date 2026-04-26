<script setup>
import { computed, ref } from 'vue';

const options = ref([]);

const breadcrumbItems = [
    { label: 'Технология AF', current: true },
];

const ecoOptions = computed(() => options.value.filter((item) => item.eco).slice(0, 4));

const featureCards = [
    {
        title: 'Низкие затраты на техническое обслуживание для повышения надежности',
        intro: 'В компании AF compressors мы уделяем первостепенное внимание долгосрочной надежности и предсказуемости обслуживания оборудования.',
        bullets: [
            'Минимальное количество движущихся частей снижает износ критически важных узлов.',
            'Интервалы обслуживания остаются стабильными и легко планируются в производственном графике.',
            'Продуманная механика уменьшает риск незапланированных остановок и внеплановых вмешательств.',
        ],
        outro: 'Наши системы рассчитаны на длительный срок службы и помогают удерживать эксплуатационные затраты под контролем.',
    },
    {
        stat: '80% от общих затрат на эксплуатацию предприятия по производству кормов для животных приходится на потребление энергии.',
        image: '/img/af-technology/80-total-cost-1.svg',
    },
    {
        title: 'Эффективная конструкция для простой установки и эксплуатации',
        intro: 'L-образная архитектура AF упрощает интеграцию компрессора в существующие производственные линии и делает ежедневную эксплуатацию более предсказуемой.',
        bullets: [
            'Компактная компоновка уменьшает требования к занимаемой площади.',
            'Удобный доступ к ключевым узлам ускоряет диагностику и обслуживание.',
            'Гибкая линейка моделей позволяет точнее подобрать установку под реальную нагрузку.',
        ],
    },
    {
        title: 'Минимальное энергопотребление для максимальной экономии',
        intro: 'Высокая энергоэффективность формируется не одной функцией, а всей системой компрессора: от кинематики до режимов управления.',
        bullets: [
            'Низкоскоростная работа механики снижает потери и повышает стабильность.',
            'Системы рекуперации и интеллектуального управления уменьшают совокупное энергопотребление.',
            'Экономия энергии напрямую снижает стоимость владения на протяжении всего жизненного цикла.',
        ],
    },
];

axios.get('/options/data')
    .then((resp) => {
        options.value = resp.data?.data || [];
    })
    .catch(() => {});
</script>

<template>
    <div class="af-technology-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Технология AF"
            subtitle="Новаторская эффективность, надежность и экономия затрат."
            description="Компания AF Compressors является лидером в отрасли безмасляных поршневых компрессоров для рынка выдувного формования ПЭТ, предлагая решения, обеспечивающие исключительную эффективность, минимизацию эксплуатационных расходов и надежную работу. Наша технология сочетает в себе низкое энергопотребление, снижение затрат на техническое обслуживание и эффективную конструкцию, обеспечивая вашему предприятию непревзойденную выгоду."
            :min-height="400"
            copy-max-width="980px"
        />

        <section class="af-technology-page__section">
            <div class="container mx-auto px-4">
                <div class="af-technology-page__intro">
                    <h2 class="site-h2 af-technology-page__section-title">Что делает нас уникальными?</h2>
                    <p class="af-technology-page__text af-technology-page__text--narrow">
                        Уникальная L-образная конструкция компрессора AF оказывает многостороннее влияние на эффективность и срок службы, делая его наиболее экологичным оборудованием. Сжатие осуществляется в 3 этапа с использованием всего двух поршневых штоков, что обеспечивает минимальное количество движущихся частей. Механика компрессора и его трансмиссионная система идеально адаптированы для работы на низких скоростях и обеспечивают большую гибкость в удовлетворении потребностей клиентов благодаря широкому ассортименту моделей компрессоров.
                    </p>
                </div>
            </div>
        </section>

        <section class="af-technology-page__section af-technology-page__section--compact-top">
            <div class="container mx-auto px-4">
                <div class="af-technology-page__media-block">
                    <div class="af-technology-page__media-copy">
                        <p class="af-technology-page__text">
                            Одним из постоянных приоритетов AF является снижение энергопотребления за счет использования всех своих преимуществ. В последнее время компания также перешла к повышению энергоэффективности, используя иной подход к потреблению, например, благодаря системе рекуперации тепла, в которой 80% механической мощности компрессора преобразуется в тепловую энергию.
                        </p>

                        <p class="af-technology-page__text">
                            В ассортименте также представлены другие уникальные системы асинхронного торможения, разработанные для повышения эффективности компрессорной установки и улучшения условий ее работы, включая системы регулирования, управления и т.д.
                        </p>
                    </div>

                    <div class="af-technology-page__media-shell">
                        <img
                            src="/img/af-technology/l-shape-design-af.jpg"
                            alt="L-shape design AF Compressors"
                            class="af-technology-page__media-image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="af-technology-page__section af-technology-page__section--video">
            <div class="container mx-auto px-4">
                <div class="af-technology-page__video-placeholder">
                    TODO video af-technology
                </div>
            </div>
        </section>

        <section v-if="ecoOptions.length" class="af-technology-page__eco">
            <div class="container mx-auto px-4">
                <div class="af-technology-page__eco-panel">
                    <options-grid-block
                        :title="'Варианты\nэкономии энергии\nи средств'"
                        :items="ecoOptions"
                    />
                </div>
            </div>
        </section>

        <section class="af-technology-page__section af-technology-page__section--cards">
            <div class="container mx-auto px-4">
                <div class="af-technology-page__cards">
                    <article class="af-technology-page__card">
                        <h2 class="site-h2 af-technology-page__card-title">{{ featureCards[0].title }}</h2>
                        <p class="af-technology-page__text">{{ featureCards[0].intro }}</p>
                        <ul class="af-technology-page__list">
                            <li v-for="item in featureCards[0].bullets" :key="item">{{ item }}</li>
                        </ul>
                        <p class="af-technology-page__text">{{ featureCards[0].outro }}</p>
                    </article>

                    <article class="af-technology-page__card af-technology-page__card--stat">
                        <p class="af-technology-page__stat-text">{{ featureCards[1].stat }}</p>
                        <img
                            :src="featureCards[1].image"
                            alt="80 percent total cost"
                            class="af-technology-page__stat-image"
                        >
                    </article>

                    <article class="af-technology-page__card">
                        <h2 class="site-h2 af-technology-page__card-title">{{ featureCards[2].title }}</h2>
                        <p class="af-technology-page__text">{{ featureCards[2].intro }}</p>
                        <ul class="af-technology-page__list">
                            <li v-for="item in featureCards[2].bullets" :key="item">{{ item }}</li>
                        </ul>
                    </article>

                    <article class="af-technology-page__card">
                        <h2 class="site-h2 af-technology-page__card-title">{{ featureCards[3].title }}</h2>
                        <p class="af-technology-page__text">{{ featureCards[3].intro }}</p>
                        <ul class="af-technology-page__list">
                            <li v-for="item in featureCards[3].bullets" :key="item">{{ item }}</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section class="af-technology-page__invest">
            <div class="container mx-auto px-4">
                <div class="af-technology-page__invest-panel">
                    <div class="af-technology-page__invest-copy">
                        <h2 class="site-h2 af-technology-page__invest-title">
                            Инвестируйте в перспективные технологии с компрессорами AF.
                        </h2>

                        <p class="af-technology-page__text">
                            Выбирая AF Technologies, вы инвестируете в передовые решения, обеспечивающие низкое
                            энергопотребление, снижение затрат на техническое обслуживание и эффективную, надежную
                            конструкцию. Наши системы созданы для обеспечения вашей компании долгосрочной экономии
                            энергии и средств, гарантируя при этом максимальное время безотказной работы.
                        </p>

                        <p class="af-technology-page__text">
                            Узнайте, как компания AF Technologies может преобразить работу вашего предприятия.
                        </p>

                        <a href="/contact" class="af-technology-page__invest-link">
                            <span>Свяжитесь с нами сегодня, чтобы узнать больше.</span>
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

                    <div class="af-technology-page__invest-media">
                        <img
                            src="/img/af-technology/l-shape-design-af-invest.jpg"
                            alt="AF Technologies investment"
                            class="af-technology-page__invest-image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.af-technology-page {
    background: var(--color-white);
}

.af-technology-page__section {
    padding: 80px 0;
    background: var(--color-white);
}

.af-technology-page__section--compact-top {
    padding-top: 0;
}

.af-technology-page__intro {
    max-width: 900px;
}

.af-technology-page__section-title {
    margin: 0 0 28px;
}

.af-technology-page__text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.72;
}

.af-technology-page__text--narrow {
    max-width: 840px;
}

.af-technology-page__media-block {
    display: grid;
    grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
    align-items: center;
    gap: 48px;
}

.af-technology-page__media-copy {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.af-technology-page__media-shell {
    overflow: hidden;
    border-radius: 28px;
    background: #eef8fd;
}

.af-technology-page__media-image {
    display: block;
    width: 100%;
    height: auto;
    object-fit: cover;
}

.af-technology-page__section--video {
    padding-top: 0;
}

.af-technology-page__video-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 320px;
    border: 1px dashed rgba(83, 165, 220, 0.4);
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(145, 211, 255, 0.08), rgba(83, 165, 220, 0.04));
    color: rgba(11, 40, 59, 0.58);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.af-technology-page__eco {
    padding: 0 0 80px;
    background: var(--color-white);
}

.af-technology-page__eco-panel {
    padding: 56px 48px;
    border-radius: 32px;
    background: linear-gradient(135deg, #cfeeff 0%, #f1fbff 100%);
}

.af-technology-page__cards {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    align-items: stretch;
    gap: 24px;
}

.af-technology-page__card {
    display: flex;
    flex-direction: column;
    gap: 20px;
    min-height: 100%;
    padding: 36px 34px;
    border-radius: 28px;
    background: #f8fbfd;
}

.af-technology-page__card--stat {
    justify-content: space-between;
    background: linear-gradient(180deg, #fff2c6 0%, #fff9ea 100%);
}

.af-technology-page__card-title {
    margin: 0;
    max-width: 580px;
    font-size: clamp(1.8rem, 1.6157894737rem + 0.4912280702vw, 2.5rem);
}

.af-technology-page__list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin: 0;
    padding-left: 20px;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.65;
}

.af-technology-page__stat-text {
    margin: 0;
    max-width: 420px;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.6rem, 1.4421052632rem + 0.4210526316vw, 2.2rem);
    font-weight: 300;
    line-height: 1.12;
}

.af-technology-page__stat-image {
    width: min(100%, 330px);
    height: auto;
    align-self: flex-end;
    object-fit: contain;
}

.af-technology-page__invest {
    padding: 0 0 80px;
    background: var(--color-white);
}

.af-technology-page__invest-panel {
    display: grid;
    grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
    align-items: center;
    gap: 42px;
    padding: 52px 48px;
    border-radius: 32px;
    background: linear-gradient(135deg, #cfeeff 0%, #f1fbff 100%);
}

.af-technology-page__invest-copy {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.af-technology-page__invest-title {
    margin: 0 0 4px;
    max-width: 620px;
}

.af-technology-page__invest-link {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    width: fit-content;
    margin-top: 4px;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 400;
    line-height: 1.3;
    letter-spacing: 0.04em;
    text-decoration: none;
    text-transform: uppercase;
    transition: color 0.25s ease, transform 0.25s ease;
}

.af-technology-page__invest-link:hover {
    color: var(--color-secondary-400);
}

.af-technology-page__invest-link:hover svg {
    transform: translateX(4px);
}

.af-technology-page__invest-link svg {
    width: 20px;
    height: 20px;
    flex: 0 0 auto;
    transition: transform 0.25s ease;
}

.af-technology-page__invest-media {
    overflow: hidden;
    border-radius: 28px;
    background: rgba(255, 255, 255, 0.4);
}

.af-technology-page__invest-image {
    display: block;
    width: 100%;
    height: auto;
    object-fit: cover;
}

@media (max-width: 1199px) {
    .af-technology-page__cards {
        gap: 20px;
    }

    .af-technology-page__card {
        padding: 30px 28px;
    }
}

@media (max-width: 991px) {
    .af-technology-page__section {
        padding: 64px 0;
    }

    .af-technology-page__media-block {
        grid-template-columns: 1fr;
        gap: 32px;
    }

    .af-technology-page__eco-panel {
        padding: 40px 28px;
    }

    .af-technology-page__cards {
        grid-template-columns: 1fr;
    }

    .af-technology-page__invest-panel {
        grid-template-columns: 1fr;
        gap: 32px;
        padding: 40px 28px;
    }
}

@media (max-width: 767px) {
    .af-technology-page__section {
        padding: 52px 0;
    }

    .af-technology-page__video-placeholder {
        min-height: 220px;
        border-radius: 24px;
    }

    .af-technology-page__eco {
        padding-bottom: 52px;
    }

    .af-technology-page__eco-panel {
        padding: 32px 20px;
        border-radius: 24px;
    }

    .af-technology-page__card {
        padding: 28px 20px;
        border-radius: 24px;
    }

    .af-technology-page__invest {
        padding-bottom: 52px;
    }

    .af-technology-page__invest-panel {
        gap: 24px;
        padding: 32px 20px;
        border-radius: 24px;
    }
}
</style>
