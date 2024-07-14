<template>
    <form @submit.prevent="login">
        <input v-model="email" type="email" required>
        <input v-model="password" type="password" required>
        <button type="submit">Login</button>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('/api/login', {
                    email: this.email,
                    password: this.password,
                });
                const token = response.data.token;
                // Store token in Vuex or local storage
                this.$store.commit('setToken', token);
                // Redirect to dashboard or home page
                this.$router.push('/dashboard');
            } catch (error) {
                console.error('Login failed', error);
            }
        },
    },
};
</script>
