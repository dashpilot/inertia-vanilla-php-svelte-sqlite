// resources/js/app.js
import { createInertiaApp } from '@inertiajs/svelte';
import { mount } from 'svelte';

import './style.css';
import './backend.css';

// Debug output for development
console.log('Inertia Svelte Blog starting');

createInertiaApp({
    progress: {
        color: '#4f46e5',
        showSpinner: true,
    },
    resolve: (name) => {
        console.log('Resolving page:', name);

        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true });
        const page = pages[`./Pages/${name}.svelte`];

        if (!page) {
            console.error(`Page not found: ${name}`);
        }

        return page;
    },
    setup({ el, App, props }) {
        console.log('Mounting Svelte app with props:', props);

        // Use Svelte 5's mount function
        return mount(App, {
            target: el,
            props: props || {},
        });
    },
});
