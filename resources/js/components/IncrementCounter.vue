<template>
<section class="vue-playabout">
  <div>
    <button @click="toggleDetails">Hide Details</button>
  </div>
  <div v-if="showDetails">
    <p :class="{ 'highlight': highlightTitle }" class="my-title">{{ title }}</p>
    <button @click="toggleHighlight">Higlight title</button>
    <p>
        <a :href="url">cr7</a>
    </p>
  </div>

</section>

</template>
<script>
export default {
    data() {
        return {
            title: 'hello world',
            showDetails: true,
            url: 'https://en.wikipedia.org/wiki/Cristiano_Ronaldo',
            highlightTitle: false,
        };
    },
    methods: {
        toggleDetails() {
            this.showDetails = !this.showDetails;
        },
        toggleHighlight() {
            this.highlightTitle = !this.highlightTitle;
        },
    }
}
</script>

<style>
.highlight {
    background-color: red;
}
.vue-playabout {
    background-color: pink;
}
</style>