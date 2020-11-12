import Vue from 'vue'

require('./bootstrap');

Vue.component('posts-component', require('./components/posts/posts').default)

new Vue({
    el:'#app'
})
