export const featuredMenuItems = [
    {
        label: 'Безмасляные поршневые компрессоры',
        href: '/solutions',
        className: 'site-header__menu-link--primary',
    },
    {
        label: 'Безмасляные компрессоры для ПЭТ',
        href: '/solutions/15-40-bar',
        eyebrow: '15 - 40 бар',
        eyebrowClass: 'site-header__featured-eyebrow--secondary',
        className: 'site-header__menu-link--subitem',
    },
    {
        label: 'Безмасляные компрессоры',
        href: '/solutions/8-10-bar',
        eyebrow: '8 & 10 бар',
        eyebrowClass: 'site-header__featured-eyebrow--primary',
        className: 'site-header__menu-link--subitem site-header__menu-link--subitem-blue',
    },
    {
        label: 'Компрессоры промежуточного давления',
        href: '#',
        className: 'site-header__menu-link--subitem',
    },
];

export const secondaryMenuItems = [
    { label: 'Новости и события', href: '#' },
    { label: 'Контакты', href: '/contact' },
];

export const menuSections = [
    {
        title: 'Компания',
        href: '/our-company',
        items: [
            { label: 'о нас', href: '/our-company' },
            { label: 'история', href: '/our-company/#history' },
        ],
    },
    {
        title: 'Инновации',
        href: '#',
        items: [
            { label: 'Технология AF', href: '/af-technology' },
            { label: 'Energy- and cost-saving options', href: '/options' },
            { label: 'Regulation', href: '#', nested: true },
            { label: 'Recovery', href: '#', nested: true },
            { label: 'Control and Monitoring', href: '#', nested: true },
            { label: 'Design', href: '#', nested: true },
            { label: 'Technical features', href: '#' },
        ],
    },
    {
        title: 'развитие',
        href: '#',
        items: [
            { label: 'Engineered for sustainable efficiency', href: '#' },
            { label: 'Responsible operations', href: '#' },
        ],
    },
    {
        title: 'Услуги',
        href: '#',
        items: [
            { label: 'Presale', href: '#' },
            { label: 'Technical support and aftersale', href: '#' },
            { label: 'Predictive maintenance', href: '#' },
        ],
    },
];

export const socialItems = [
    { label: 'Telegram', short: 'tg', href: '#' },
    { label: 'VK', short: 'vk', href: '#' },
    { label: 'YouTube', short: 'yt', href: '#' },
];

export const hotline = {
    href: 'tel:+79999999999',
    label: 'Помощь по горячей линии',
    number: '+7 999 999 99 99',
};

export const certificateItems = [
    { src: '/img/certificats/apragaz_logo_2.jpg', alt: 'Apragaz' },
    { src: '/img/certificats/logo-ecovadis-white.svg', alt: 'Ecovadis' },
    { src: '/img/certificats/logo-fsc-bg.svg', alt: 'FSC' },
    { src: '/img/certificats/logo-iso-1.svg', alt: 'ISO' },
    { src: '/img/certificats/logo-trendstop.svg', alt: 'Trendstop' },
];
