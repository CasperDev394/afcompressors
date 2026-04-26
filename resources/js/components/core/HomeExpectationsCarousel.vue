<script setup>
import { computed, ref } from 'vue';

const activeIndex = ref(null);

const items = [
    {
        label: 'Энергоэффективность',
        title: 'Энергоэффективность',
        description: 'В наших конструкциях компрессоров мы уделяем приоритетное внимание низкому энергопотреблению, сочетая продуманную механику, эффективные режимы работы и решения, которые помогают снижать стоимость владения на протяжении всего жизненного цикла оборудования.',
        image: '/img/home/carousel/Energy-Efficiency.jpg',
    },
    {
        label: 'Надежность',
        title: 'Надежность и долговечность',
        description: 'Наши компрессоры созданы для долгой и надежной работы, обеспечивая стабильную производительность, прогнозируемое обслуживание и высокую эксплуатационную устойчивость даже в условиях интенсивной промышленной нагрузки.',
        image: '/img/home/carousel/Reliability.jpg',
    },
    {
        label: 'Устойчивое развитие',
        title: 'Устойчивое развитие',
        description: 'Мы привержены принципам устойчивого развития, интегрируя энергоэффективность, снижение эксплуатационных потерь и продуманное использование ресурсов в каждое решение AF Compressors.',
        image: '/img/home/carousel/Sustainability.jpg',
    },
    {
        label: 'Расширенное управление',
        title: 'Расширенный мониторинг и управление',
        description: 'Благодаря нашим интеллектуальным системам управления компрессорные установки получают более высокий уровень контроля, прозрачности рабочих параметров и гибкости в оптимизации производственного процесса.',
        image: '/img/home/carousel/Advanced-control.jpg',
    },
];

const activeItem = computed(() => items[activeIndex.value]);

const setActive = (index) => {
    activeIndex.value = index;
};

const resetActive = () => {
    activeIndex.value = null;
};
</script>

<template>
    <section class="expectations-carousel">
        <div class="container mx-auto px-4">
            <div class="expectations-carousel__head">
                <div class="expectations-carousel__rail" aria-hidden="true">
                    <span class="expectations-carousel__rail-line"></span>
                    <span class="expectations-carousel__rail-dot"></span>
                </div>

                <div class="expectations-carousel__heading">
                    <h2 class="site-h2 expectations-carousel__title">Чего вы можете ожидать</h2>
                    <p class="expectations-carousel__subtitle">от решений AF</p>
                </div>
            </div>

            <div class="expectations-carousel__desktop" @mouseleave="resetActive">
                <div class="expectations-carousel__cards">
                    <article
                        v-for="(item, index) in items"
                        :key="item.title"
                        class="expectations-carousel__card"
                        :class="{ 'is-active': activeIndex === index, 'is-inactive': activeIndex !== null && activeIndex !== index }"
                        @mouseenter="setActive(index)"
                    >
                        <img :src="item.image" :alt="item.title" class="expectations-carousel__image">
                        <div class="expectations-carousel__overlay" aria-hidden="true"></div>
                        <span
                            class="expectations-carousel__label"
                            :class="{ 'is-hidden': activeIndex !== null && activeIndex !== index }"
                        >
                            {{ item.label }}
                        </span>
                    </article>
                </div>

                <div class="expectations-carousel__copy-shell" :class="{ 'has-active': activeItem }">
                    <div v-if="activeItem" :key="activeItem.title" class="expectations-carousel__copy">
                        <h3 class="expectations-carousel__copy-title">{{ activeItem.title }}</h3>
                        <p class="expectations-carousel__copy-text">{{ activeItem.description }}</p>
                    </div>
                </div>
            </div>

            <div class="expectations-carousel__mobile">
                <article
                    v-for="(item, index) in items"
                    :key="item.title"
                    class="expectations-carousel__mobile-item"
                >
                    <button
                        type="button"
                        class="expectations-carousel__mobile-card"
                        :class="{ 'is-active': activeIndex === index }"
                        @click="setActive(index)"
                    >
                        <img :src="item.image" :alt="item.title" class="expectations-carousel__image">
                        <div class="expectations-carousel__overlay" aria-hidden="true"></div>
                        <span class="expectations-carousel__label">{{ item.label }}</span>
                    </button>

                    <div v-if="activeIndex === index" class="expectations-carousel__mobile-copy">
                        <h3 class="expectations-carousel__copy-title">{{ item.title }}</h3>
                        <p class="expectations-carousel__copy-text">{{ item.description }}</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>

<style scoped>
.expectations-carousel {
    padding: 0 0 88px;
    background: var(--color-white);
}

.expectations-carousel__head {
    display: grid;
    grid-template-columns: 72px minmax(0, 1fr);
    align-items: start;
    gap: 22px;
    margin-bottom: 40px;
}

.expectations-carousel__rail {
    position: relative;
    width: 72px;
    height: 100%;
    min-height: 122px;
}

.expectations-carousel__rail-line {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 22px;
    width: 1px;
    background: linear-gradient(180deg, rgba(83, 165, 220, 0.18), rgba(83, 165, 220, 0.5), rgba(83, 165, 220, 0.18));
}

.expectations-carousel__rail-dot {
    position: absolute;
    top: 14px;
    left: 22px;
    width: 14px;
    height: 14px;
    border: 1px solid rgba(242, 138, 4, 0.8);
    border-radius: 999px;
    background: rgba(83, 165, 220, 0.12);
    transform: translateX(-50%);
}

.expectations-carousel__heading {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    padding-left: clamp(0rem, 6vw, 8rem);
}

.expectations-carousel__title {
    margin: 0;
    max-width: 520px;
}

.expectations-carousel__subtitle {
    margin: 0;
    color: var(--color-primary-400);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.35rem, 1.1657894737rem + 0.4912280702vw, 2.05rem);
    font-weight: 300;
    line-height: 1.05;
}

.expectations-carousel__desktop {
    display: flex;
    gap: 0;
    align-items: stretch;
}

.expectations-carousel__cards {
    display: flex;
    flex: 1 1 auto;
    gap: 12px;
    min-height: 520px;
    height: 520px;
    min-width: 0;
}

.expectations-carousel__card {
    position: relative;
    flex: 1 1 0;
    height: 100%;
    border-radius: 30px;
    overflow: hidden;
    transition: flex-grow 0.34s ease, transform 0.34s ease, filter 0.34s ease;
}

.expectations-carousel__card.is-active {
    flex-grow: 2.3;
}

.expectations-carousel__card.is-inactive {
    flex-grow: 0.82;
}

.expectations-carousel__image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.expectations-carousel__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(10, 33, 48, 0.12), rgba(10, 33, 48, 0.46));
}

.expectations-carousel__label {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 1;
    display: flex;
    align-items: flex-start;
    padding: 10px 16px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.96);
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    line-height: 1.2;
    text-align: left;
    text-transform: uppercase;
    word-break: normal;
    overflow-wrap: normal;
    hyphens: none;
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.22s ease, transform 0.22s ease;
}

.expectations-carousel__label.is-hidden {
    opacity: 0;
    transform: translateY(-8px);
}

.expectations-carousel__copy-shell {
    width: 0;
    min-width: 0;
    overflow: hidden;
    transition: width 0.34s ease;
}

.expectations-carousel__copy-shell.has-active {
    width: min(100%, 1000px);
}

.expectations-carousel__copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 18px;
    width: min(100%, 1000px);
    min-height: 520px;
    padding: 24px 6px 24px 20px;
    opacity: 1;
    transform: translateX(0);
    transition: opacity 0.28s ease, transform 0.28s ease;
}

.expectations-carousel__copy-title {
    margin: 0;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.8rem, 1.6157894737rem + 0.4912280702vw, 2.5rem);
    font-weight: 300;
    line-height: 1.04;
}

.expectations-carousel__copy-text {
    margin: 0;
    color: rgba(11, 40, 59, 0.8);
    font-size: 1rem;
    line-height: 1.72;
}

.expectations-carousel__mobile {
    display: none;
}

@media (max-width: 1199px) {
    .expectations-carousel__desktop {
        flex-direction: column;
        gap: 22px;
    }

    .expectations-carousel__copy-shell,
    .expectations-carousel__copy-shell.has-active {
        width: 100%;
    }

    .expectations-carousel__copy {
        width: 100%;
        min-height: 0;
        padding: 0;
    }
}

@media (max-width: 767px) {
    .expectations-carousel {
        padding: 0 0 56px;
    }

    .expectations-carousel__head {
        grid-template-columns: 44px minmax(0, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .expectations-carousel__rail {
        min-height: 92px;
        width: 44px;
    }

    .expectations-carousel__rail-line,
    .expectations-carousel__rail-dot {
        left: 14px;
    }

    .expectations-carousel__heading {
        padding-left: 0;
    }

    .expectations-carousel__desktop {
        display: none;
    }

    .expectations-carousel__mobile {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .expectations-carousel__mobile-item {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .expectations-carousel__mobile-card {
        position: relative;
        display: block;
        width: 100%;
        min-height: 220px;
        height: 220px;
        border: 0;
        border-radius: 24px;
        overflow: hidden;
        padding: 0;
        background: transparent;
    }

    .expectations-carousel__mobile-copy {
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 0 6px 4px;
    }
}
</style>
