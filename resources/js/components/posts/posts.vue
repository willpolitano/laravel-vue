<template>
    <div class="posts">
        <div class="post" v-for="(post, index) in posts.data" :key="index">
            <h3>{{ post.name }}</h3>
            <p>{{ post.description }}</p>
            <hr />
        </div>
        <div v-if="!hasNextPage" v-observe-visibility="visibilityChanged">
            ...
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    created() {
        this.fetchPosts();
    },

    computed: {
        hasNextPage() {
            return this.posts.meta.current_page === this.posts.meta.last_page;
        }
    },

    data() {
        return {
            posts: {
                data: [],
                meta: {
                    current_page: 1,
                    last_page: 1
                }
            },
            page: 1
        };
    },

    methods: {
        fetchPosts() {
            axios
                .get(`/api/v1/posts?page=${this.page}`)
                .then(response => {
                    this.posts.data.push(...response.data.data);
                    this.posts.meta = response.data.meta;
                })
                .catch(response => {
                    console.log(response);
                });
        },

        visibilityChanged(isVisible) {
            if (!isVisible) return;

            if (this.hasNextPage) return;

            this.page++;

            this.fetchPosts();
        }
    }
};
</script>
