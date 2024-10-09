<template>
  <button
    type="button"
    @click="counter++"
    class="p-2 text-white bg-gray-500 rounded"
  >
    Counter is: {{ counter }}
  </button>

  <div v-if="showDetails">
    <p :class="{ 'highlight': highlightTitle }" class="my-title">{{ title }}</p>
    <button @click="toggleHighlight">Higlight title</button>
    <p>
        <a :href="url">cr7</a>
    </p>
  </div>

  <div>
    <button @click="toggleDetails">Show Details</button>
  </div>
</template>

<script>
import { ref } from 'vue'

export default {
    data() {
        return {
            counter: ref(0),
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
        }
    }
}
</script>

<style>
.highlight {
    background-color: red;
}
</style>