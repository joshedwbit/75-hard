<template>
    <footer>
    <h2>{{ title }}</h2>
    <p>{{ message }}</p>
    <ol>
        <li v-for="(social,index) in socialsArray" :key="index">{{ social }}</li>
    </ol>
    <h3>Website rating:</h3>
    <slot>Website not rated</slot>
    </footer>

    <slot name="HomeLink">
        Default content
    </slot>
</template>

<script>
export default {
    props: [
        'message',
        'socials-array',
        'dummyProp'
    ],
    data() {
        return {
            title: 'FOOTER TITLE',
        }
    },
}
</script>

<style>
footer {
    background-color: paleturquoise;
}
</style>