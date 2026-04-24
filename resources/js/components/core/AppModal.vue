<template>
    <div class="modalShadow bg-zinc-900/60" :class="{visible}" :id="id+'Shadow'" @click="hideShadow">
        <dialog
            :id="id"
            v-if="visible"
            style="visibility: visible; display: flex;"
            class="app-dialog pt-2"
        >
            <button class="hidden md:block absolute top-2 right-2 text-white cursor-pointer hover:text-zinc-500"  @click="hide">
                <svg-icon size="20" :fa-icon="faXmark" />
            </button>
            <div class="modal-dialog-content">
                <div :id="id+'Body'" class="modal-dialog-body text-white" :class="{body_overflow: overflow}">

                    <div class="md:hidden flex flex-row justify-between py-3 px-3 border-b border-white/10">
                        <slot name="mobile-title-left" class="mob-only"><div></div></slot>
                        <slot name="mobile-title" class="mob-only"></slot>
                        <button class="top-2 right-2 text-white cursor-pointer hover:text-zinc-500"  @click="hide">
                            <svg-icon size="20" :fa-icon="faXmark" />
                        </button>
                    </div>

                    <slot></slot>
                </div>
                <footer>
                    <slot name="footer"></slot>
                </footer>
            </div>
        </dialog>
    </div>
</template>
<script setup>
import { ref, nextTick } from "vue";
import {faXmark} from "@fortawesome/free-solid-svg-icons";

defineProps({
    id: {
        type: String,
        default: "vdialog",
    },
    overflow: {
        type: Boolean,
        default: false,
    },
    hideClose: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["shown", "hidden"]);
const visible = ref(false);

const show = () => {
    return new Promise((resolve) => {
        nextTick().then(() => {
            visible.value = true;
            document.body.style.overflow = "hidden";
            emit("shown");
            resolve();
        });
    });
};

const hide = () => {
    return new Promise((resolve) => {
        visible.value = false;
        document.body.style.overflow = "";
        emit("hidden");
        resolve();
    });
};

const toggle = () => {
    return visible.value ? hide() : show();
};

const hideShadow = (e) => {
    if(e.target.classList.contains('modalShadow') ){hide()}
}

defineExpose({ show, hide });
</script>
<style lang="scss">
@use '/resources/sass/_variables.scss' as vars;

.modalShadow {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: none;
    visibility: hidden;
    margin: 0;
    padding: 0;
    text-align: center;
    z-index: 1000;
    //background-color: rgba(255, 255, 255, 0.8);
    & dialog {
        background-color: vars.$color-bg-200;
        box-shadow: 0 0 5px 0 rgba(37, 77, 66, 0.6);
        border: none;

        min-width: 40%;
        flex-direction: column;
        overflow: auto;
    }
}
.modalShadow.visible {
    visibility: visible;
    display: block;
}
.modalShadow.visible dialog {
    transition: all 0.2s ease-in;
    opacity: 1;
    top: 7%;
    margin: 0 auto;
    max-height: 85vh;
    padding: 12px;
}

.body_overflow {
    overflow: visible !important;
}
.modalShadow {
    /*z-index: 10000;*/

    .visible {
        & dialog {
            max-height: 95vh;
            max-width: 90%;
            align-items: flex-end;
            padding: 15px 10px;
        }
    }

    & dialog .modal-dialog-content {
        display: flex;
        flex-direction: column;
        height: auto;
        width: 100%;

        & footer {
            height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
    }

    dialog .modal-dialog-content .modal-dialog-body {
        overflow-x: auto;
    }

    &._without-overflow {
        dialog {
            overflow: unset !important;
        }

        .modal-dialog-body {
            overflow: unset !important;
        }
    }
}

table.grid > tr > td {
    border: 5px solid transparent;
}

/* МОБИЛКА */
@media (max-device-width: 767px) {
    .modalShadow.visible{
        & dialog{
            margin: 0;
            width: 100% !important;
            height: 100%;
            padding: 0 0 0 0;
            top: 0;

            & .modal-dialog-body{
                height: auto;
            }

            & .modal-dialog-content{
                margin: 0;
                height: 100%;

                justify-content: space-between;
            }
        }
    }
    .btn-close-dialog{
        position: absolute;
        top: 0;
        right: 0;
        margin: 8px;
        border: none;
        border-radius: 12px;
        background-color: #fff;
        padding: 0 !important;
        width: 30px;
        height: 30px;
    }
}
</style>
