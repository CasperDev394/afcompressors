<template>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-head">
            <button
                type="button"
                class="sidebar-toggle"
                :title="isCollapsed ? 'Развернуть меню' : 'Свернуть меню'"
                @click="toggleSidebar"
            >
                <svg-icon size="18" :fa-icon="isCollapsed ? faAnglesRight : faAnglesLeft" />
            </button>
        </div>

        <ul>
            <li
                v-for="item in menuItems"
                :key="item.key"
                class="tab"
                :class="checkActive(item.key) ? 'active' : ''"
            >
                <a :href="item.href" :title="item.label">
                    <span class="tab-main">
                        <svg-icon size="18" :fa-icon="item.icon" />
                        <span v-if="!isCollapsed" class="tab-label">{{ item.label }}</span>
                    </span>
                    <span v-if="item.badgeKey && badges[item.badgeKey] > 0" class="sidebar-badge">
                        {{ badges[item.badgeKey] }}
                    </span>
                </a>
            </li>
        </ul>

    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import {
    faAnglesLeft,
    faAnglesRight,
    faGaugeHigh,
    faLandmark,
    faSliders,
} from "@fortawesome/free-solid-svg-icons";

const badges = ref({
    orders_new: 0,
    reviews_unmoderated: 0,
})
const isCollapsed = ref(false);
const storageKey = 'admin-sidebar-collapsed';

const menuItems = [
    { key: 'info', href: '/admin/info', label: 'Dashboard', icon: faLandmark },
    { key: 'compressors', href: '/admin/compressors', label: 'Компрессоры', icon: faGaugeHigh },
    { key: 'options', href: '/admin/options', label: 'Опции', icon: faSliders },
];

const currentUrl = () => {
    return window.location.pathname;
}
const checkActive = (hrefPart) => {
    return currentUrl().includes(hrefPart)
}

const applyCollapsedState = (value) => {
    isCollapsed.value = value;
    document.body.classList.toggle('admin-sidebar-collapsed', value);
};

const toggleSidebar = () => {
    const nextValue = !isCollapsed.value;
    localStorage.setItem(storageKey, nextValue ? '1' : '0');
    applyCollapsedState(nextValue);
};

onMounted(() => {
    applyCollapsedState(localStorage.getItem(storageKey) === '1');

    axios.get('/admin/sidebar-badges').then((resp) => {
        badges.value = {
            orders_new: Number(resp.data.orders_new || 0),
            reviews_unmoderated: Number(resp.data.reviews_unmoderated || 0),
        }
    }).catch(() => {})
})

</script>
<style lang="scss">
@use '/resources/sass/_variables.scss' as variables;

.sidebar{
    display: flex;
    flex-direction: column;

    & svg {
        vertical-align: middle;
    }

    .sidebar-head {
        display: flex;
        justify-content: flex-end;
        padding: 10px 14px 6px;
    }

    .sidebar-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border: 1px solid rgb(255 255 255 / 10%);
        border-radius: 12px;
        background: rgb(255 255 255 / 4%);
        color: variables.$t-color-200;
        transition: background-color 0.2s ease, color 0.2s ease;

        &:hover {
            background: rgb(255 255 255 / 8%);
            color: #fff;
        }
    }

    .tab {
        list-style-type: none;
        position: relative;

        &:hover {
            &>a{
                color: #fff;
            }

        }
    }
    .tab.active {
        border-right: solid #fff 2px;

        &>a{
            color: variables.$color-emerald-500;
        }
    }
    .tab > a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        text-decoration: none;
        font-family: revert;
        color: variables.$t-color-200;
        font-size: 21px;

        padding: 6px 20px;
        position: relative;

        .tab-main {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .tab-label {
            white-space: nowrap;
            overflow: hidden;
        }

        .href-icon-negate{
            width: 20px;
        }
    }

    .sidebar-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
        height: 24px;
        padding: 0 8px;
        border-radius: 999px;
        background-color: color-mix(in oklab, var(--color-cyan-700) 70%, transparent);
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
        pointer-events: none;
        flex-shrink: 0;
    }
}

#sidebar {
    top: 0;
    left: 0;
    padding-top: calc(var(--admin-header-height) + 8px);
    height: 100dvh;
    width: var(--admin-sidebar-width);
    z-index: 9;
    position: fixed;
    background-color: variables.$color-bg-300;
    box-shadow: 0 1px 6px 0 rgb(187, 187, 187);
    transition: width 0.2s ease;
    overflow-y: auto;
    overflow-x: hidden;
    overscroll-behavior: contain;
    -webkit-overflow-scrolling: touch;


    > ul {
        margin: 0;
        padding: 0;

            > li {

        }
    }
}

body.admin-sidebar-collapsed {
    #sidebar {
        .sidebar-head {
            justify-content: center;
            padding: 10px 8px 6px;
        }

        .tab > a {
            justify-content: center;
            padding: 10px 8px;
        }

        .tab-main {
            justify-content: center;
        }

        .sidebar-badge {
            position: absolute;
            top: 4px;
            right: 8px;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            font-size: 11px;
        }
    }
}

@media (max-height: 500px) and (orientation: landscape) {
    .sidebar {
        .sidebar-head {
            padding-top: 6px;
            padding-bottom: 4px;
        }

        .sidebar-toggle {
            width: 34px;
            height: 34px;
        }

        .tab > a {
            font-size: 17px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
    }
}
</style>
