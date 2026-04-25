import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import Login from './pages/auth/Login.vue';
// import Register from './pages/auth/Register.vue';
import Home from './pages/Home.vue';
import ContactPage from './pages/Contact.vue';
import OptionPage from './pages/Option.vue';
import OptionsPage from './pages/Options.vue';

import AdminHeader from './components/admin/Header.vue';
import AdminSidebar from './components/admin/Sidebar.vue';
import AdminInfo from './pages/admin/AdminInfo.vue';
import AdminCompressors from './pages/admin/AdminCompressors.vue';
import AdminCompressor from './pages/admin/AdminCompressor.vue';
import AdminOptions from './pages/admin/AdminOptions.vue';
import AdminOption from './pages/admin/AdminOption.vue';

import AttachmentGallery from './components/core/AttachmentGallery.vue';
import Breadcrumbs from './components/core/Breadcrumbs.vue';
import HeaderApp from './components/core/Header.vue';
import FooterApp from './components/core/Footer.vue';
import OptionsGridBlock from './components/core/OptionsGridBlock.vue';
import ServicesSection from './components/core/ServicesSection.vue';

import SvgIcon from "vue3-icon";
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import AppModal from "./components/core/AppModal.vue";


// import Loader from "./components/Loader.vue";
// import Pagination from "./components/Pagination.vue";

app
    .component('Login', Login)
    // .component('Register', Register)
    .component('Home', Home)
    .component('ContactPage', ContactPage)
    .component('OptionPage', OptionPage)
    .component('OptionsPage', OptionsPage)

    .component('AdminHeader', AdminHeader)
    .component('AdminSidebar', AdminSidebar)
    .component('AttachmentGallery', AttachmentGallery)
    .component('AdminInfo', AdminInfo)
    .component('AdminCompressors', AdminCompressors)
    .component('AdminCompressor', AdminCompressor)
    .component('AdminOptions', AdminOptions)
    .component('AdminOption', AdminOption)

    .component('Breadcrumbs', Breadcrumbs)
    .component('HeaderApp', HeaderApp)
    .component('FooterApp', FooterApp)
    .component('OptionsGridBlock', OptionsGridBlock)
    .component('ServicesSection', ServicesSection)

    .component("svg-icon", SvgIcon)
    .component('data-table', Vue3EasyDataTable)
    // .component("loader", Loader)
    // .component("pagination", Pagination)
    .component("app-modal", AppModal)


;

app.mount('#app');
