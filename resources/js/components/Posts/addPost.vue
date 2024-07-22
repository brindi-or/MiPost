<!-- components/AddPostModal.vue -->
<template>
  <div class="modal-backdrop">
    <div class="modal">
      <h2>Add a post</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="title">Title:</label>
          <input v-model="newPost.title" id="title" required />
        </div>
        <div class="form-group">
          <label for="content">Content:</label>
          <textarea v-model="newPost.content" id="content" required></textarea>
        </div>
        <div class="button-group">
          <button type="submit" class="submit-btn">Add</button>
          <button type="button" @click="$emit('close')" class="cancel-btn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "AddPostModal",
  props: {
    newPost: Object,
  },
  data() {
    return {
      title: "",
      content: "",
    };
  },
  methods: {
    submitForm() {
      this.$emit("add-post", { title: this.title, content: this.content });
      this.title = "";
      this.content = "";
    },
  },
};
</script>

<style scoped>
.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background: white;
  border-radius: 8px;
  padding: 20px;
  max-width: 500px;
  width: 90%;
}

h2 {
  color: #3498db;
  margin-top: 0;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input,
textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

textarea {
  height: 100px;
}

.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.submit-btn,
.cancel-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.submit-btn {
  background-color: #2ecc71;
  color: white;
}

.cancel-btn {
  background-color: #e74c3c;
  color: white;
}

@media (max-width: 768px) {
  .modal {
    width: 95%;
  }
}
</style>
