<script setup>
const breadcrumbItems = [
    { label: 'Безмасляные поршневые компрессоры', current: true },
];

const solutionCards = [
    {
        slug: '15-40-bar',
        title: '15 – 40 бар',
        subtitle: 'Безмасляные компрессоры для ПЭТ',
        description: 'Система AF обеспечивает минимальное энергопотребление, гарантируя прямую экономию для вашего предприятия.',
        image: '/img/copressors-bar/15-40-bar.png',
        href: '/solutions/15-40-bar',
        tone: 'secondary',
    },
    {
        slug: '8-10-bar',
        title: '8 и 10 бар',
        subtitle: 'Безмасляные компрессоры',
        description: 'Безмасляные компрессоры с давлением 8 и 10 бар представляют собой высокоэффективные двухступенчатые поршневые воздушные компрессоры с водяным охлаждением и двумя цилиндрами.',
        image: '/img/copressors-bar/8-10-bar.png',
        href: '/solutions/8-10-bar',
        tone: 'primary',
    },
];
</script>

<template>
    <div class="solutions-page">
        <site-hero
            :breadcrumbs="breadcrumbItems"
            title="Безмасляные поршневые компрессоры"
            description="В компании AF Compressors мы предлагаем индивидуальные решения, разработанные с учетом ваших конкретных потребностей, обеспечивая максимальную эффективность и производительность наших компрессорных систем."
            :min-height="400"
            copy-max-width="860px"
        />

        <section class="solutions-page__section">
            <div class="container mx-auto px-4">
                <div class="solutions-page__cards">
                    <a
                        v-for="card in solutionCards"
                        :key="card.slug"
                        :href="card.href"
                        class="solutions-page__card"
                        :class="[
                            `solutions-page__card--${card.tone}`,
                            { 'solutions-page__card--offset': card.slug === '8-10-bar' },
                        ]"
                    >
                        <span class="solutions-page__card-sweep" aria-hidden="true"></span>

                        <div class="solutions-page__card-media">
                            <img
                                :src="card.image"
                                :alt="card.subtitle"
                                class="solutions-page__card-image"
                            >
                        </div>

                        <div class="solutions-page__card-copy">
                            <span class="solutions-page__card-title">{{ card.title }}</span>
                            <span class="solutions-page__card-subtitle">{{ card.subtitle }}</span>
                            <span class="solutions-page__card-description">{{ card.description }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <options-newsletter-section />
    </div>
</template>

<style scoped>
.solutions-page {
    background: var(--color-white);
}

.solutions-page__section {
    padding: 78px 0 88px;
    background: var(--color-white);
}

.solutions-page__cards {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    align-items: start;
    gap: 34px;
}

.solutions-page__card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-height: 560px;
    padding: 22px;
    border-radius: 32px;
    overflow: hidden;
    text-decoration: none;
    background: #f8fbfd;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.solutions-page__card--secondary {
    border: 1px solid rgba(242, 138, 4, 0.45);
    background: linear-gradient(180deg, rgba(255, 247, 232, 0.82), rgba(255, 255, 255, 1));
}

.solutions-page__card--primary {
    border: 1px solid rgba(83, 165, 220, 0.38);
    background: linear-gradient(180deg, rgba(234, 247, 255, 0.96), rgba(255, 255, 255, 1));
}

.solutions-page__card--offset {
    margin-top: 70px;
}

.solutions-page__card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(11, 40, 59, 0);
    transition: background-color 0.3s ease;
    z-index: 1;
}

.solutions-page__card-sweep {
    position: absolute;
    top: 0;
    bottom: 0;
    left: -38%;
    width: 32%;
    opacity: 0;
    transform: skewX(-18deg) translateX(0);
    transition: transform 0.45s ease, opacity 0.3s ease;
    z-index: 2;
}

.solutions-page__card--secondary .solutions-page__card-sweep {
    background: linear-gradient(90deg, rgba(242, 138, 4, 0), rgba(242, 138, 4, 0.72), rgba(242, 138, 4, 0));
}

.solutions-page__card--primary .solutions-page__card-sweep {
    background: linear-gradient(90deg, rgba(83, 165, 220, 0), rgba(83, 165, 220, 0.72), rgba(83, 165, 220, 0));
}

.solutions-page__card-media {
    position: relative;
    z-index: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 360px;
    border-radius: 24px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.74);
}

.solutions-page__card-image {
    display: block;
    width: 100%;
    height: auto;
    max-height: 360px;
    object-fit: contain;
    transition: transform 0.35s ease, opacity 0.35s ease;
}

.solutions-page__card-copy {
    position: relative;
    z-index: 3;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 20px 10px 8px;
}

.solutions-page__card-title,
.solutions-page__card-subtitle,
.solutions-page__card-description {
    transition: color 0.25s ease, opacity 0.25s ease, transform 0.25s ease;
}

.solutions-page__card-title {
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1.35rem;
    font-weight: 600;
    line-height: 1;
}

.solutions-page__card--secondary .solutions-page__card-title {
    color: var(--color-secondary-500);
}

.solutions-page__card--primary .solutions-page__card-title {
    color: var(--color-primary-400);
}

.solutions-page__card-subtitle {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.5rem, 1.4210526316rem + 0.2105263158vw, 1.8rem);
    font-weight: 300;
    line-height: 1.08;
}

.solutions-page__card-description {
    max-width: 90%;
    color: rgba(255, 255, 255, 0);
    font-size: 0.98rem;
    line-height: 1.65;
    opacity: 0;
    transform: translateY(10px);
}

.solutions-page__card:hover {
    transform: translateY(-4px);
    box-shadow: 0 26px 50px rgba(11, 40, 59, 0.12);
}

.solutions-page__card:hover::before {
    background: rgba(11, 40, 59, 0.52);
}

.solutions-page__card:hover .solutions-page__card-sweep {
    opacity: 1;
    transform: skewX(-18deg) translateX(460%);
}

.solutions-page__card:hover .solutions-page__card-image {
    transform: scale(0.9);
    opacity: 0.26;
}

.solutions-page__card:hover .solutions-page__card-subtitle {
    color: var(--color-white);
}

.solutions-page__card:hover .solutions-page__card-description {
    color: rgba(255, 255, 255, 0.86);
    opacity: 1;
    transform: translateY(0);
}

@media (max-width: 991px) {
    .solutions-page__section {
        padding: 64px 0 72px;
    }

    .solutions-page__cards {
        grid-template-columns: 1fr;
    }

    .solutions-page__card--offset {
        margin-top: 0;
    }
}

@media (max-width: 767px) {
    .solutions-page__section {
        padding: 52px 0 56px;
    }

    .solutions-page__card {
        min-height: 0;
        padding: 18px;
        border-radius: 24px;
    }

    .solutions-page__card-media {
        min-height: 240px;
        border-radius: 18px;
    }

    .solutions-page__card-image {
        max-height: 240px;
    }

    .solutions-page__card-copy {
        padding: 18px 6px 4px;
    }

    .solutions-page__card-description {
        max-width: 100%;
    }
}
</style>
