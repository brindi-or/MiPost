<template>
  <button @click="showModal = true" class="add-post-btn">Add a post</button>
  <div class="post-list">
    <h3 class="post-title">List of posts</h3>
    <div class="post">
      <article v-for="post in posts" :key="post.id" class="post">
        <h4><button></button>{{ post.user.name }}</h4>
        <div class="content">
          <p>{{ post.content }}</p>
          <button @click="likePost(post.id)">
            <font-awesome-icon icon="thumbs-up" />
            ({{ post.likes_count ?? 0 }})
          </button>
        </div>

        <comments-list
          :comments="post.comments"
          v-if="post.comments.length != 0"
        ></comments-list>
      </article>
    </div>

    <transition name="modal">
      <add-post-modal
        v-if="showModal"
        @close="showModal = false"
        @add-post="addPost"
        :newPost="newPost"
      ></add-post-modal>
    </transition>
  </div>
</template>

<script>
import CommentsList from "./Comment.vue";
import { useAuthStore } from "../../store";
import AddPostModal from "./addPost.vue";

export default {
  components: {
    CommentsList,
    AddPostModal,
  },
  data() {
    return {
      showModal: false,
      posts: [],
      likesCount: 0,
      newPost: {
        title: "",
        content: "",
      },
    };
  },
  methods: {
    async getPosts() {
      await axios.get("/sanctum/csrf-cookie");
      axios.get("/api/posts").then((response) => {
        console.log("Length of posts:", response.data[1].comments.length);
        this.posts = response.data;
        this.listenForUpdates();
      });
    },
    /**
     * Send a POST request to '/api/posts' with newPost data, then handle the response by adding the new post to the posts array and resetting the newPost object.
     *
     * @return {void}
     */
    async addPost() {
      const authStore = useAuthStore();
      let user = authStore.user.id;
      await axios.get("/sanctum/csrf-cookie");
      axios
        .post(`/api/posts/${user}`, this.newPost)
        .then((response) => {
          // this.posts.push(respnse.data);
          this.getPosts();
          this.newPost = {
            title: "",
            content: "",
          };
          this.showModal = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    listenForUpdates() {
      console.log("testi", this.posts, "listenForUpdates");
      Object.keys(this.posts).forEach((post) => {
        Echo.channel(`post.${post.id}`).listen("NewLike", (e) => {
          // Update likes count for the specific publication
          console.log("test", this.post);
          this.$set(this.post[post.id], "likes_count", e.likesCount);
        });
      });
    },
    async likePost(id) {
      const authStore = useAuthStore();
      let user = authStore.user.id;
      console.log("user", user, authStore);
      try {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post(`api/post/${id}/${user}`).then((response) => {
          const post = this.posts.find((p) => p.id === id);
          if (post) {
            Object.assign(post, response.data);
          }
          this.posts[id].likes_count = response.data.likes_count;
        });
      } catch (error) {
        console.log(error, "error");
      }
    },
  },
  mounted() {
    this.getPosts();
    this.listenForUpdates();
  },
};
</script>

<style scoped>
.content {
  padding-left: 15px;
}
.post-title {
  text-align: center;
}
.post {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 13px;
  margin-bottom: 2rem;
}

.post h2 {
  color: #2c3e50;
  margin-top: 0;
  font-size: 1.8rem;
}

@media (max-width: 768px) {
  .post {
    padding: 1rem;
  }

  .post h2 {
    font-size: 1.5rem;
  }
}
.add-post-btn {
  background-color: #3498db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1rem;
  margin-bottom: 1rem;
  transition: background-color 0.3s;
}

.add-post-btn:hover {
  background-color: #2980b9;
}
h4 {
  display: flex;
  align-items: center;
}
h4 button {
  padding: 7px;
  border-radius: 10px;
  border-color: red;
}
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s;
}

.modal-enter,
.modal-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .add-post-btn {
    width: 100%;
    padding: 15px;
  }
}
</style>
