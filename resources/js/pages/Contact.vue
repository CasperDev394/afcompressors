<script setup>
import { computed, reactive, ref } from 'vue';

const breadcrumbItems = [
    { label: 'Контакты', current: true },
];

const generalSubmitUrl = '/contact/general';
const quoteSubmitUrl = '/contact/quote-request';

const activeTab = ref('general');

const tabs = {
    general: {
        key: 'general',
        label: 'Общие контакты',
        heading: 'Общие контакты',
        submitUrl: generalSubmitUrl,
    },
    quote: {
        key: 'quote',
        label: 'Запросить ценовое предложение',
        heading: 'Запросить ценовое предложение',
        submitUrl: quoteSubmitUrl,
    },
};

const generalForm = reactive({
    lastName: '',
    firstName: '',
    email: '',
    phone: '',
    companyName: '',
    message: '',
    consent: false,
});

const quoteForm = reactive({
    lastName: '',
    firstName: '',
    email: '',
    phone: '',
    companyName: '',
    country: '',
    productType: 'Высокое давление',
    message: '',
    consent: false,
});

const baseFields = [
    { key: 'lastName', label: 'Фамилия *', type: 'text', autocomplete: 'family-name' },
    { key: 'firstName', label: 'Имя *', type: 'text', autocomplete: 'given-name' },
    { key: 'email', label: 'Электронная почта *', type: 'email', autocomplete: 'email' },
    { key: 'phone', label: 'Телефон *', type: 'tel', autocomplete: 'tel' },
    { key: 'companyName', label: 'Название компании *', type: 'text', autocomplete: 'organization' },
];

const activeTabConfig = computed(() => tabs[activeTab.value]);

const activeForm = computed(() => (activeTab.value === 'general' ? generalForm : quoteForm));

const activeFields = computed(() => {
    if (activeTab.value === 'quote') {
        return [
            ...baseFields,
            { key: 'country', label: 'Страна *', type: 'text', autocomplete: 'country-name' },
        ];
    }

    return baseFields;
});

const showProductType = computed(() => activeTab.value === 'quote');

const setActiveTab = (tabKey) => {
    activeTab.value = tabKey;
};

const submitGeneralContacts = () => {
    // TODO: wire general contacts form submission to /contact/general.
    console.info('TODO submit general contacts', generalForm);
};

const submitQuoteRequest = () => {
    // TODO: wire quote request form submission to /contact/quote-request.
    console.info('TODO submit quote request', quoteForm);
};

const handleSubmit = () => {
    if (activeTab.value === 'general') {
        submitGeneralContacts();
        return;
    }

    submitQuoteRequest();
};
</script>

<template>
    <div class="contact-page">
        <section class="contact-page__hero">
            <div class="container mx-auto px-4 h-full">
                <div class="contact-page__hero-inner">
                    <breadcrumbs :items="breadcrumbItems" />

                    <div class="contact-page__hero-copy">
                        <h1 class="contact-page__title">Контакты</h1>
                        <p class="contact-page__description">
                            Ниже вы найдете контактные данные вашего специалиста по обслуживанию.
                            Наша команда готова помочь вам с сервисным обслуживанием, запчастями и технической экспертизой.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-page__section">
            <div class="container mx-auto px-4">
                <div class="contact-page__section-head">
                    <h2 class="site-h2">Выберите свое контактное лицо</h2>
                </div>

                <div class="contact-page__tabs-wrap">
                    <div class="contact-page__tabs-line"></div>
                    <div class="contact-page__tabs" role="tablist" aria-label="Контактные формы">
                        <button
                            v-for="tab in Object.values(tabs)"
                            :key="tab.key"
                            type="button"
                            class="contact-page__tab"
                            :class="{ 'is-active': activeTab === tab.key }"
                            :aria-selected="activeTab === tab.key ? 'true' : 'false'"
                            :tabindex="activeTab === tab.key ? 0 : -1"
                            @click="setActiveTab(tab.key)"
                        >
                            {{ tab.label }}
                        </button>
                    </div>
                </div>

                <div class="contact-page__panel">
                    <div class="contact-page__aside">
                        <h3 class="contact-page__aside-title">
                            {{ activeTabConfig.heading }}
                        </h3>

                        <div class="contact-page__hotline">
                            <span class="contact-page__hotline-icon" aria-hidden="true">
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

                            <div class="contact-page__hotline-copy">
                                <p class="contact-page__hotline-label">ПОМОЩЬ ПО ГОРЯЧЕЙ ЛИНИИ</p>
                                <p class="contact-page__hotline-meta">7/24 По всему миру</p>
                                <a href="tel:+3242399660" class="contact-page__hotline-phone">+32 4 239 96 60</a>
                            </div>
                        </div>
                    </div>

                    <div class="contact-page__form-shell">
                        <form
                            class="contact-page__form"
                            :action="activeTabConfig.submitUrl"
                            method="post"
                            @submit.prevent="handleSubmit"
                        >
                            <div class="contact-page__form-section">
                                <p class="contact-page__form-section-title">КОНТАКТНАЯ ИНФОРМАЦИЯ</p>

                                <div class="contact-page__grid">
                                    <label
                                        v-for="field in activeFields"
                                        :key="field.key"
                                        class="contact-page__field"
                                    >
                                        <span class="contact-page__label">{{ field.label }}</span>
                                        <input
                                            v-model="activeForm[field.key]"
                                            :type="field.type"
                                            :name="field.key"
                                            :autocomplete="field.autocomplete"
                                            class="contact-page__input"
                                        >
                                    </label>

                                    <label v-if="showProductType" class="contact-page__field contact-page__field--full">
                                        <span class="contact-page__label">Тип продукта *</span>
                                        <select
                                            v-model="activeForm.productType"
                                            name="productType"
                                            class="contact-page__input contact-page__select"
                                        >
                                            <option value="Высокое давление">Высокое давление</option>
                                            <option value="Низкое давление">Низкое давление</option>
                                            <option value="Прочее">Прочее</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="contact-page__form-section">
                                <p class="contact-page__form-section-title">СООБЩЕНИЕ</p>

                                <label class="contact-page__field contact-page__field--full">
                                    <span class="contact-page__label">Напишите ваше сообщение *</span>
                                    <textarea
                                        v-model="activeForm.message"
                                        name="message"
                                        class="contact-page__input contact-page__textarea"
                                    ></textarea>
                                </label>
                            </div>

                            <label class="contact-page__consent">
                                <input
                                    v-model="activeForm.consent"
                                    type="checkbox"
                                    name="consent"
                                    class="contact-page__checkbox"
                                >
                                <span>
                                    Я согласен с тем, что компания AF Compressors может использовать мои персональные данные
                                    в соответствии со своей политикой конфиденциальности.
                                </span>
                            </label>

                            <div class="contact-page__actions">
                                <button type="submit" class="contact-page__submit">
                                    <span>ОТПРАВЛЯТЬ</span>
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path
                                            d="M5 12h14M13 6l6 6-6 6"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-page__map-section">
            <div class="container mx-auto px-4">
                <div class="contact-page__map-wrap">
                    <img src="/img/map.jpg" alt="Карта AF Compressors" class="contact-page__map-image">
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
.contact-page__hero {
    min-height: 490px;
    background: var(--color-primary-800);
}

.contact-page__hero-inner {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 36px;
    min-height: 490px;
    padding: 48px 0 56px;
}

.contact-page__hero-copy {
    max-width: 760px;
}

.contact-page__title {
    margin: 0 0 24px;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(3rem, 2.4rem + 1.6vw, 4.6rem);
    font-weight: 300;
    line-height: 0.98;
}

.contact-page__description {
    max-width: 700px;
    color: var(--color-white);
    font-size: 1rem;
    line-height: 1.6;
    white-space: pre-line;
}

.contact-page__section {
    padding: 72px 0 88px;
    background: var(--color-white);
}

.contact-page__map-section {
    padding: 0 0 88px;
    background: var(--color-white);
}

.contact-page__section-head {
    margin-bottom: 32px;
}

.contact-page__tabs-wrap {
    position: relative;
    margin-bottom: -1px;
}

.contact-page__tabs-line {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--color-primary-400);
}

.contact-page__tabs {
    position: relative;
    z-index: 1;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.contact-page__tab {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 56px;
    padding: 14px 24px;
    border: 1px solid var(--color-secondary-500);
    border-bottom-color: var(--color-primary-400);
    border-radius: 18px 18px 0 0;
    background: var(--color-white);
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1;
    text-align: center;
    transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
}

.contact-page__tab.is-active {
    border-color: var(--color-primary-400);
    background: var(--color-primary-400);
    color: var(--color-white);
}

.contact-page__panel {
    display: grid;
    grid-template-columns: minmax(260px, 0.9fr) minmax(0, 1.7fr);
    gap: 0;
    border-top: 1px solid var(--color-primary-400);
}

.contact-page__aside {
    padding: 42px 36px 42px 0;
}

.contact-page__aside-title {
    margin: 0 0 36px;
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(1.9rem, 1.7684210526rem + 0.350877193vw, 2.4rem);
    font-weight: 300;
    line-height: 1;
}

.contact-page__hotline {
    display: flex;
    align-items: flex-start;
    gap: 16px;
}

.contact-page__hotline-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    border: 1px solid rgba(83, 165, 220, 0.35);
    border-radius: 999px;
    color: var(--color-secondary-500);
    flex: 0 0 auto;
}

.contact-page__hotline-icon svg {
    width: 22px;
    height: 22px;
}

.contact-page__hotline-copy {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-page__hotline-label {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    line-height: 1.2;
}

.contact-page__hotline-meta {
    color: rgba(11, 40, 59, 0.72);
    font-size: 0.95rem;
    line-height: 1.5;
}

.contact-page__hotline-phone {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1.35rem;
    font-weight: 400;
    line-height: 1.2;
    text-decoration: none;
}

.contact-page__form-shell {
    background: #eaf7ff;
    padding: 42px;
}

.contact-page__form {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.contact-page__form-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.contact-page__form-section-title {
    color: var(--color-primary-800);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    line-height: 1.2;
}

.contact-page__grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px 20px;
}

.contact-page__field {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-page__field--full {
    grid-column: 1 / -1;
}

.contact-page__label {
    color: rgba(11, 40, 59, 0.84);
    font-size: 0.95rem;
    line-height: 1.4;
}

.contact-page__input {
    width: 100%;
    min-height: 56px;
    padding: 16px 18px;
    border: 1px solid rgba(83, 165, 220, 0.3);
    border-radius: 16px;
    background: var(--color-white);
    color: var(--color-primary-800);
    font-size: 1rem;
    line-height: 1.4;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}

.contact-page__input:focus {
    outline: none;
    border-color: var(--color-primary-400);
    box-shadow: 0 0 0 3px rgba(83, 165, 220, 0.15);
}

.contact-page__select {
    appearance: none;
    background-image:
        linear-gradient(45deg, transparent 50%, var(--color-primary-800) 50%),
        linear-gradient(135deg, var(--color-primary-800) 50%, transparent 50%);
    background-position:
        calc(100% - 24px) calc(50% - 3px),
        calc(100% - 18px) calc(50% - 3px);
    background-size: 6px 6px, 6px 6px;
    background-repeat: no-repeat;
    padding-right: 42px;
}

.contact-page__textarea {
    min-height: 160px;
    resize: vertical;
}

.contact-page__consent {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    color: rgba(11, 40, 59, 0.84);
    font-size: 0.95rem;
    line-height: 1.5;
}

.contact-page__checkbox {
    width: 18px;
    height: 18px;
    margin-top: 2px;
    border-radius: 4px;
    flex: 0 0 auto;
}

.contact-page__actions {
    display: flex;
    justify-content: flex-end;
}

.contact-page__submit {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    min-height: 56px;
    padding: 12px 24px;
    border: 1px solid var(--color-secondary-500);
    border-radius: 999rem;
    color: var(--color-secondary-500);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 400;
    line-height: 1;
    letter-spacing: 0.04em;
    transition: background-color 0.25s ease, color 0.25s ease;
}

.contact-page__submit:hover {
    background: var(--color-secondary-500);
    color: var(--color-white);
}

.contact-page__submit svg {
    width: 20px;
    height: 20px;
}

.contact-page__map-wrap {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.contact-page__map-image {
    display: block;
    width: 100%;
    height: auto;
}

@media (max-width: 991px) {
    .contact-page__panel {
        grid-template-columns: 1fr;
    }

    .contact-page__aside {
        padding: 32px 0 28px;
    }

    .contact-page__form-shell {
        padding: 32px 24px;
    }
}

@media (max-width: 767px) {
    .contact-page__hero {
        min-height: 420px;
    }

    .contact-page__hero-inner {
        min-height: 420px;
        gap: 28px;
        padding: 32px 0 40px;
    }

    .contact-page__section {
        padding: 52px 0 64px;
    }

    .contact-page__map-section {
        padding: 0 0 64px;
    }

    .contact-page__tabs {
        gap: 8px;
    }

    .contact-page__tab {
        width: 100%;
        border-radius: 16px 16px 0 0;
        justify-content: flex-start;
        text-align: left;
    }

    .contact-page__form-shell {
        padding: 24px 18px;
    }

    .contact-page__grid {
        grid-template-columns: 1fr;
    }

    .contact-page__actions {
        justify-content: stretch;
    }

    .contact-page__submit {
        width: 100%;
        justify-content: center;
    }
}
</style>
