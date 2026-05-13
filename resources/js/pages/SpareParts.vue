<script setup>
const breadcrumbItems = [
    { label: 'Продажа запчастей', current: true },
];

const stockHighlights = [
    {
        title: 'Постоянный резерв',
        text: 'Мы поддерживаем постоянный резерв наиболее востребованных запасных частей для регулярных технических обслуживаний и плановых сервисных интервалов.',
    },
    {
        title: 'Крупные позиции под заказ',
        text: 'Крупногабаритные и редко запрашиваемые узлы поставляются под заказ с прозрачным согласованием сроков и полной технической спецификацией.',
    },
    {
        title: 'Локальное производство',
        text: 'Мы развиваем производство отдельных запасных частей в России под строгим контролем бельгийского офиса, сохраняя единые стандарты качества.',
    },
    {
        title: 'Гарантия и контроль',
        text: 'За качество отвечаем и гарантию обеспечиваем: каждая позиция проходит проверку на соответствие требованиям оборудования AF Compressors.',
    },
];

const galleryItems = [
    {
        src: '/img/services/af-compressors-compressor-pieces.jpg',
        alt: 'Запасные части AF Compressors',
        className: 'spare-parts-page__gallery-card--large',
    },
    {
        src: '/img/services/af-compressors-maintenance.jpg',
        alt: 'Сервис и складское сопровождение AF Compressors',
        className: '',
    },
    {
        src: '/img/sustainability/af-compressors-compressor-pieces.jpg',
        alt: 'Контроль качества запасных частей AF Compressors',
        className: '',
    },
];
</script>

<template>
    <div class="spare-parts-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Продажа запчастей"
            description="Мы поддерживаем клиентов AF Compressors не только сервисом, но и быстрой поставкой оригинальных и контролируемых запасных частей, необходимых для стабильной и безопасной работы оборудования."
            :min-height="400"
            copy-max-width="980px"
        />

        <section class="spare-parts-page__section">
            <div class="container mx-auto px-4">
                <div class="spare-parts-page__intro">
                    <div class="spare-parts-page__intro-copy">
                        <h2 class="site-h2 spare-parts-page__title">Складская программа, ориентированная на реальную эксплуатацию</h2>

                        <p class="spare-parts-page__text">
                            Для текущих технических обслуживаний мы держим постоянный складской резерв основных комплектующих, чтобы сервисные работы проходили без задержек и без лишнего давления на ваш производственный график.
                        </p>

                        <p class="spare-parts-page__text">
                            Если речь идёт о крупных узлах или редких позициях, мы организуем поставку под заказ с техническим сопровождением, понятной логистикой и контролем качества на каждом этапе.
                        </p>

                        <p class="spare-parts-page__text">
                            Дополнительно мы развиваем производство ряда запасных частей в России под строгим контролем бельгийского офиса. Это позволяет ускорять поставки, сохраняя единые требования AF Compressors к надежности, ресурсу и гарантии.
                        </p>
                    </div>

                    <div class="spare-parts-page__intro-media">
                        <img
                            src="/img/services/af-compressors-compressor-pieces.jpg"
                            alt="Склад и запасные части AF Compressors"
                            class="spare-parts-page__intro-image"
                        >
                    </div>
                </div>
            </div>
        </section>

        <section class="spare-parts-page__section spare-parts-page__section--highlights">
            <div class="container mx-auto px-4">
                <div class="spare-parts-page__highlights">
                    <article
                        v-for="item in stockHighlights"
                        :key="item.title"
                        class="spare-parts-page__highlight-card"
                    >
                        <h3 class="spare-parts-page__highlight-title">{{ item.title }}</h3>
                        <p class="spare-parts-page__text">{{ item.text }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="spare-parts-page__section">
            <div class="container mx-auto px-4">
                <div class="spare-parts-page__gallery-head">
                    <h2 class="site-h2 spare-parts-page__title">Склад, контроль и готовность к поставке</h2>
                    <p class="spare-parts-page__text spare-parts-page__text--narrow">
                        Пока здесь используются производственные и сервисные кадры из текущих материалов проекта. Когда появятся живые фотографии склада, этот блок можно будет быстро обновить без изменения структуры страницы.
                    </p>
                </div>

                <div class="spare-parts-page__gallery">
                    <figure
                        v-for="item in galleryItems"
                        :key="item.src"
                        class="spare-parts-page__gallery-card"
                        :class="item.className"
                    >
                        <img
                            :src="item.src"
                            :alt="item.alt"
                            class="spare-parts-page__gallery-image"
                        >
                    </figure>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.spare-parts-page {
    background: var(--color-white);
}

.spare-parts-page__section {
    padding: 80px 0;
    background: var(--color-white);
}

.spare-parts-page__section--highlights {
    padding-top: 8px;
}

.spare-parts-page__intro {
    display: grid;
    grid-template-columns: minmax(0, 1.02fr) minmax(0, 0.98fr);
    align-items: center;
    gap: 40px;
}

.spare-parts-page__intro-copy {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.spare-parts-page__title {
    margin: 0 0 6px;
}

.spare-parts-page__text {
    margin: 0;
    color: rgba(11, 40, 59, 0.82);
    font-size: 1rem;
    line-height: 1.72;
}

.spare-parts-page__text--narrow {
    max-width: 760px;
}

.spare-parts-page__intro-media {
    overflow: hidden;
    border-radius: 30px;
    background: #eaf4fb;
}

.spare-parts-page__intro-image {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 460px;
    object-fit: cover;
}

.spare-parts-page__highlights {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}

.spare-parts-page__highlight-card {
    display: flex;
    flex-direction: column;
    gap: 14px;
    min-height: 100%;
    padding: 30px 28px;
    border-radius: 28px;
    border: 1px solid rgba(83, 165, 220, 0.18);
    background:
        radial-gradient(circle at top left, rgba(83, 165, 220, 0.16), transparent 34%),
        linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(244, 250, 255, 0.96));
}

.spare-parts-page__highlight-title {
    margin: 0;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.5rem, 1.3684210526rem + 0.350877193vw, 2rem);
    font-weight: 300;
    line-height: 1.08;
}

.spare-parts-page__gallery-head {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 30px;
}

.spare-parts-page__gallery {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
}

.spare-parts-page__gallery-card {
    overflow: hidden;
    border-radius: 28px;
    background: #eaf4fb;
    min-height: 280px;
}

.spare-parts-page__gallery-card--large {
    grid-column: span 2;
    min-height: 420px;
}

.spare-parts-page__gallery-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@media (max-width: 1023px) {
    .spare-parts-page__section {
        padding: 64px 0;
    }

    .spare-parts-page__intro,
    .spare-parts-page__highlights,
    .spare-parts-page__gallery {
        grid-template-columns: 1fr;
    }

    .spare-parts-page__gallery-card--large {
        grid-column: auto;
        min-height: 340px;
    }

    .spare-parts-page__intro-image {
        min-height: 340px;
    }
}

@media (max-width: 767px) {
    .spare-parts-page__section {
        padding: 52px 0;
    }

    .spare-parts-page__intro {
        gap: 28px;
    }

    .spare-parts-page__highlight-card,
    .spare-parts-page__gallery-card,
    .spare-parts-page__intro-media {
        border-radius: 22px;
    }

    .spare-parts-page__highlight-card {
        padding: 24px 20px;
    }

    .spare-parts-page__gallery {
        gap: 16px;
    }

    .spare-parts-page__gallery-card,
    .spare-parts-page__gallery-card--large {
        min-height: 240px;
    }

    .spare-parts-page__intro-image {
        min-height: 260px;
    }
}
</style>
