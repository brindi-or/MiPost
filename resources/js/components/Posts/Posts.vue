<template>
    <div>
        <h3>Liste des posts</h3>
        <button type="submit">Create post</button>
        <ul>
            <li class="posts" v-for="post in posts" :key="post.id">{{ post.content }}</li>
        </ul>

        <form @submit.prevent='createPost'>

            <input type="text" v-model="newPost.title" placeholder="Titre du post">
            <textarea rows="" cols="" v-model="newPost.content" placeholder="Contenu du post"></textarea>

            <button type="submit">Create post</button>
        </form>
    </div>
</template>


<script>
export default {
    data() {
        return {
            posts: [],
            newPost: {
                title: "",
                content: "",
            }
        }
    },
    methods: {
        getPosts() {
            axios.get('/api/posts').then(response => {
                this.posts = response.data;
            });
        },

        /**
         * Send a POST request to '/api/posts' with newPost data, then handle the response by adding the new post to the posts array and resetting the newPost object.
         *
         * @return {void}
         */
        createPost() {
            axios.post('/api/posts', this.newPost).then(response => {

                // this.posts.push(response.data);
                this.getPosts()
                this.newPost = {
                    title: "",
                    content: ""
                }
            }).catch(error => {
                console.log(error);
            });
        },
    },
    mounted() {
        this.getPosts();
    }

}
</script>

<style>
.posts{
        padding: 20px;
            list-style: none;
            border: 1px solid grey;
            background-color: transparent;
            border-radius: 10px;
}

ul{
        gap: 10px;
        display: grid;
}
</style>
