import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { i18n } from './i18n'

import '../css/app.css'

const pages = import.meta.glob('./Pages/**/*.vue')

createInertiaApp({
	                 resolve: (name) => pages[`./Pages/${name}.vue`]().then(m => m.default),
	                 setup({ el, app, props, plugin }) {
		                 createApp({ render: () => h(app, props) })
			                 .use(plugin)
						     .use(i18n)
			                 .mount(el)
	                 },
                 });
