/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import MonacoEditor from './components/MonacoEditor.vue';
import AttachmentInput from './components/AttachmentInput.vue';
import PropsComponent from './components/PropsComponent.vue';
app.component('monaco-editor', MonacoEditor);
app.component('attachment-input', AttachmentInput);
app.component('props-component', PropsComponent);


app.mount('#app');
