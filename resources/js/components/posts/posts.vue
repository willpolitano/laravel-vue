<template>
    <div class="posts">
        <div class="post" v-for="(post, index) in posts.data" :key="index">
            <h3>{{ post.name }}</h3>
            <p>{{ post.description }}</p>
            <hr>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        created() {
            this.fetchPosts()
        },

        data() {
            return {
                posts: {
                    data: [],
                    meta: {
                        current_page: 1,
                        last_page: 1,
                    }
                }
            }
        },

        methods: {
            fetchPosts() {
                axios.get('/api/v1/posts')
                    .then(response => {
                        this.posts = response.data
                    })
                    .catch(response => {
                        console.log(response)
                    })
            }
        },
    }
</script>
