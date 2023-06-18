<template>
    <div>
        <h1>Contact Us page</h1>
    </div>
</template>

<script setup lang="ts">
useHead({
  title: 'Contact Us',
  meta: [
    { name: 'description', content: 'My amazing site.' }
  ],
  bodyAttrs: {
    class: 'test'
  },
  script: [ { innerHTML: 'console.log(\'Hello world\')' } ]
})
</script>


<style></style>