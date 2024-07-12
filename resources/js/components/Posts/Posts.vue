<template>
    <div>
        <h3>Liste des posts</h3>

        <ul>
            <li v-for="post in posts" :key="post.id">{{ post.content }}</li>
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
                content: ""
            }
        }
    },
    methods: {
        getPosts() {
            axios.get('/api/posts').then(response => {
                this.posts = response.data;
            });
        },
        createPost() {
            axios.post('/api/posts', this.newPost).then(response => {
                this.posts.push(response.data);
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
