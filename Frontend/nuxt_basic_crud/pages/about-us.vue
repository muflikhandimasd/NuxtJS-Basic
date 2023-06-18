<template>
    <div>
        <h1>About Us page</h1>
    </div>
</template>

<script setup lang="ts">
useHead({
  title: 'About Us',
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