require('./bootstrap');
import { createApp } from 'vue'
import Test from './Components/Test'
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
const app = createApp({})
app.use(LoadingPlugin)
app.component('test', Test)

app.mount('#app')
