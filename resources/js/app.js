import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue/dist/vue.esm-bundler.js";
import FollowButton from './components/FollowButton.vue';

const app = createApp({
    mounted() {
        console.log("The app is working");
    },
});

app.component("follow-button", FollowButton); //global registration
app.mount("#main");


// there were a lot of issues while setting up the Vue file 
// first issue was to not adding this line of code -
// @vite(['resources/css/app.css', 'resources/js/app.js'])
// secondly the issue with the props being undefined 
// Its because you need to register the component globally 
// the third issue was to import vue like this - 
// import { createApp } from "vue/dist/vue.esm-bundler.js";

// Do all the things that are shown in the above 
