import './bootstrap';
import { createApp } from 'vue';
import chat from './/components/ChatComponent.vue';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

createApp(chat).mount('#app')