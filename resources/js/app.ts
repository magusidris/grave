import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { Vue3Mq } from 'vue3-mq';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            //set mixins
            .mixin({
                methods: {
                    //method "hasAnyPermission"
                    hasAnyPermission: function (permissions) {
                        //get permissions from props
                        const allPermissions = this.$page.props.auth.permissions;

                        let hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });

                        return hasPermission;
                    },

                    //format price
                    formatNumber(value) {
                        return new Intl.NumberFormat('id-ID').format(value);
                    },

                    //format price
                    formatPrice(value) {
                        return new Intl.NumberFormat('id-ID', {
                            currency: 'IDR',
                        }).format(value);
                    },
                    formatPrice2(value) {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                        }).format(value);
                    },

                    //format date
                    formatDate(value, options = {}) {
                        const defaultOptions = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        };
                        const formatOptions = {
                            ...defaultOptions,
                            ...options,
                        };
                        return new Intl.DateTimeFormat('id-ID', formatOptions).format(new Date(value));
                    },

                    //format date time
                    formatDateTime(value, options = {}) {
                        const defaultOptions = {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                        };
                        const formatOptions = {
                            ...defaultOptions,
                            ...options,
                        };
                        return new Intl.DateTimeFormat('en-GB', formatOptions).format(new Date(value));
                    },
                },
            })
            .use(plugin)
            .use(Vue3Mq, {
                breakpoints: {
                    mobile: 0,
                    desktop: 1280,
                },
            })
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
