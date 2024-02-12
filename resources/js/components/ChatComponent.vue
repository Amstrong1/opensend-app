<template>
    <div class="min-h-screen flex flex-col">
        <div class="dark:text-white overflow-y-auto flex-1 text-sm">
            <div v-for="message in messages" :key="message.id">
                <div class="my-2 p-2 rounded bg-slate-400 w-3/4">
                    {{ message.content }}
                </div>
                <div class="my-2 p-2 rounded w-3/4 relative left-12" style="background-color: #f7951d" v-if="message.reply !== null">{{ message.reply }}</div>
            </div>
        </div>
        <div class="fixed left-0 right-0 bottom-20 rounded w-full bg-gray-100 dark:bg-gray-900 mx-1">
            <div class="flex items-center justify-center w-full">
                <input class="bg-transparent w-10/12 p-2 rounded-lg" v-model="newMessage" placeholder="Type your message">
                <div class="flex items-center justify-center w-2/12">
                    <button class="p-2 rounded-full" @click="sendMessage" style="background-color: #f7951d">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#fff" class="w-5 h-5 block mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import Echo from 'laravel-echo';
import axios from 'axios';

const messages = ref([]);
const newMessage = ref('');

const echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});

onMounted(() => {

    echo.channel('chat')
        .listen('MessageSent', (event) => {
            messages.value.push(event.message);
        });

    axios.get('/messages').then(response => {
        messages.value = response.data;
    });
});

const sendMessage = () => {

    console.log('ok')

    axios.post('/messages', { content: newMessage.value })
        .then(response => {
            window.location.reload();
        })
        .catch(error => {
            console.error('Erreur Axios :', error);
        });

    newMessage.value = '';
}
</script>