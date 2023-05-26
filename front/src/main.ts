import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { useProjectStore } from './stores/project'

const app = createApp(App)

app.use(createPinia())
await useProjectStore().refresh();
app.use(router)


app.mount('#app')
