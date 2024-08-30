/**
 * First, we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

/**
 * Next, we will create a fresh Vue application instance and register the
 * components with the application instance so they are ready to use in
 * your application's views.
 */

const app = createApp({});

// Register components
app.component('example-component', ExampleComponent);

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
