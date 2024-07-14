<template>
    <form @submit.prevent="register">
        <div>
            <label for="name">Name:</label>
            <input id="name" v-model="name" type="text" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input id="email" v-model="email" type="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input id="password" v-model="password" type="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input id="password_confirmation" v-model="password_confirmation" type="password" required>
        </div>
        <button type="submit">Register</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        }
    },
    methods: {
        async register() {
            try {
                await this.$store.dispatch('api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                });
                this.$router.push('/dashboard');
            } catch (error) {
                console.error('Registration failed', error);
                // Handle registration errors (e.g., display error messages)
            }
        },
    },
}
</script>
