<script setup>
import { faArrowRight } from '@fortawesome/free-solid-svg-icons';
import { reactive } from 'vue';

const form = reactive({
    email: '',
    consent: false,
});

const errors = reactive({
    email: '',
    consent: '',
});

const validateForm = () => {
    const email = form.email.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    errors.email = email && emailPattern.test(email) ? '' : 'Введите корректный email.';
    errors.consent = form.consent ? '' : 'Нужно согласие на обработку данных.';

    return !errors.email && !errors.consent;
};

const resetForm = () => {
    form.email = '';
    form.consent = false;
    errors.email = '';
    errors.consent = '';
};

const submitNewsletter = () => {
    if (!validateForm()) {
        return;
    }

    // TODO: implement newsletter subscription request.
    resetForm();
};
</script>

<template>
    <section class="options-newsletter">
        <div class="container mx-auto px-4">
            <div class="options-newsletter__panel">
                <div class="options-newsletter__left">
                    <form class="options-newsletter__form" @submit.prevent="submitNewsletter">
                        <h2 class="options-newsletter__title">Подпишитесь на нашу рассылку</h2>

                        <div class="options-newsletter__field-wrap">
                            <input
                                v-model="form.email"
                                type="email"
                                class="options-newsletter__input"
                                placeholder="Email"
                                autocomplete="email"
                                @input="errors.email = ''"
                            >

                            <button type="submit" class="options-newsletter__submit" aria-label="Подписаться">
                                <svg-icon size="18" :fa-icon="faArrowRight" />
                            </button>
                        </div>

                        <p v-if="errors.email" class="options-newsletter__error">{{ errors.email }}</p>

                        <label class="options-newsletter__consent">
                            <input
                                v-model="form.consent"
                                type="checkbox"
                                class="options-newsletter__checkbox"
                                @change="errors.consent = ''"
                            >
                            <span>
                                Я согласен с тем, что компания AF Compressors может использовать мои персональные
                                данные для предоставления информации по электронной почте в соответствии со своей
                                политикой защиты данных, с
                                <a href="/privacy-policy" class="options-newsletter__consent-link">
                                    которой можно ознакомиться здесь
                                </a>
                            </span>
                        </label>

                        <p v-if="errors.consent" class="options-newsletter__error">{{ errors.consent }}</p>
                    </form>
                </div>

                <div class="options-newsletter__divider" aria-hidden="true">
                    <span class="options-newsletter__divider-dot"></span>
                </div>

                <a href="#" class="options-newsletter__right">
                    <p class="options-newsletter__lead">
                        Для решения, адаптированного к вашим потребностям.
                    </p>

                    <span class="options-newsletter__cta">
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
.options-newsletter {
    padding: 0 0 88px;
    background: var(--color-white);
}

.options-newsletter__panel {
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

.options-newsletter__left {
    display: flex;
    align-items: center;
}

.options-newsletter__form {
    display: flex;
    flex-direction: column;
    gap: 18px;
    width: 100%;
    max-width: 460px;
}

.options-newsletter__title {
    margin: 0 0 8px;
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(2rem, 1.8157894737rem + 0.4912280702vw, 2.7rem);
    font-weight: 300;
    line-height: 1;
}

.options-newsletter__field-wrap {
    display: flex;
    align-items: stretch;
    width: 100%;
}

.options-newsletter__input {
    width: 100%;
    min-width: 0;
    height: 64px;
    padding: 0 24px;
    border: 1px solid rgba(145, 211, 255, 0.34);
    border-right: 0;
    border-radius: 999px 0 0 999px;
    background: rgba(83, 165, 220, 0.12);
    color: var(--color-white);
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.25s ease, background-color 0.25s ease;
}

.options-newsletter__input::placeholder {
    color: rgba(255, 255, 255, 0.52);
}

.options-newsletter__input:focus {
    border-color: rgba(145, 211, 255, 0.72);
    background: rgba(83, 165, 220, 0.18);
}

.options-newsletter__submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 64px;
    height: 64px;
    border: 1px solid rgba(145, 211, 255, 0.34);
    border-left: 0;
    border-radius: 0 999px 999px 0;
    margin-left: 0;
    background: rgba(83, 165, 220, 0.2);
    color: var(--color-primary-300);
    cursor: pointer;
    transition: transform 0.25s ease, background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
}

.options-newsletter__submit:hover {
    background: var(--color-primary-400);
    color: var(--color-white);
    transform: translateX(4px);
}

.options-newsletter__field-wrap:focus-within .options-newsletter__submit {
    border-color: rgba(145, 211, 255, 0.72);
    background: rgba(83, 165, 220, 0.28);
}

.options-newsletter__consent {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    color: rgba(255, 255, 255, 0.86);
    font-size: 0.92rem;
    line-height: 1.55;
    cursor: pointer;
}

.options-newsletter__checkbox {
    width: 18px;
    height: 18px;
    margin: 2px 0 0;
    accent-color: var(--color-primary-400);
    flex: 0 0 auto;
}

.options-newsletter__consent-link {
    color: var(--color-secondary-400);
    text-decoration: none;
    transition: color 0.25s ease;
}

.options-newsletter__consent-link:hover {
    color: var(--color-white);
}

.options-newsletter__error {
    margin: -4px 0 0;
    color: var(--color-error-soft);
    font-size: 0.88rem;
    line-height: 1.4;
}

.options-newsletter__divider {
    position: relative;
    display: flex;
    justify-content: center;
}

.options-newsletter__divider::before {
    content: "";
    width: 1px;
    height: 100%;
    background: rgba(255, 255, 255, 0.16);
}

.options-newsletter__divider-dot {
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

.options-newsletter__right {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 28px;
    color: var(--color-white);
    text-decoration: none;
}

.options-newsletter__lead {
    max-width: 585px;
    color: currentColor;
    font-family: stolzl, Helvetica, Arial, sans-serif;
    font-size: clamp(2rem, 1.7368421053rem + 0.701754386vw, 3rem);
    font-weight: 300;
    line-height: 1.02;
    transition: color 0.25s ease;
}

.options-newsletter__cta {
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

.options-newsletter__right:hover {
    color: var(--color-secondary-400);
}

.options-newsletter__right:hover .options-newsletter__cta {
    background: var(--color-secondary-500);
    color: var(--color-white);
    transform: translateX(4px);
}

.options-newsletter__cta svg {
    width: 30px;
    height: 30px;
}

@media (max-width: 991px) {
    .options-newsletter__panel {
        grid-template-columns: 1fr;
        gap: 32px;
        padding: 40px 28px;
    }

    .options-newsletter__divider {
        display: none;
    }

    .options-newsletter__right {
        align-items: flex-start;
    }
}

@media (max-width: 767px) {
    .options-newsletter {
        padding: 0 0 64px;
    }

    .options-newsletter__panel {
        gap: 28px;
        padding: 32px 20px;
        border-radius: 24px;
    }

    .options-newsletter__field-wrap {
        align-items: center;
    }

    .options-newsletter__input {
        height: 58px;
        padding: 0 18px;
    }

    .options-newsletter__submit {
        width: 58px;
        height: 58px;
    }

    .options-newsletter__right {
        flex-direction: column;
    }

    .options-newsletter__cta {
        width: 84px;
        height: 84px;
    }
}
</style>
