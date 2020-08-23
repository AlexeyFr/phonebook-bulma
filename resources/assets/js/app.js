import Vue from 'vue';

require('./bootstrap');

import HeaderComponent from './components/Header';
import FooterComponent from './components/Footer';
import HomeComponent from './components/Home';
import AboutComponent from './components/About';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

new Vue({
    el: '#app',

    components: {
        HeaderComponent,
        FooterComponent,
        HomeComponent,
        AboutComponent
    },

    router: new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/',
                name: 'home',
                component: HomeComponent
            },
            {
                path: '/about',
                name: 'about',
                component: AboutComponent
            }
        ]
    }),

    methods: {
        containerHeight() {
            this.$refs.container.style.minHeight =
                window.innerHeight -
                this.$refs.header.offsetHeight -
                this.$refs.footer.offsetHeight +
                "px";
        },
    },

    mounted() {
        this.containerHeight();
        window.addEventListener('resize', this.containerHeight);
    }

});