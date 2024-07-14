<template>
    <div id="app">
        <Posts></Posts>

    </div>

</template>

<script>
import Posts from './components/Posts/Posts.vue';
    export default {
        name: "App",
        components: { Posts }
        }
</script>

<style>
    body{
        background-color: beige;
        font-family: 'Times New Roman';
    }
    #app{
       padding-left: 10%;
        padding-right: 10%;
        overflow: auto;
    }
</style>
