<template>
  <div>{{ title }}</div>
  <p>{{ message }}</p>
  <ol>
    <li v-for="(social,index) in socialsArray" :key="index">{{ social }}</li>
  </ol>
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

</style>