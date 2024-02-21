<template>
  <div class="container mx-auto px-4">
    <div class="py-2" >
      <h1>{{ title }}</h1>
    </div>
    <main>
      <slot></slot>
    </main>
  </div>
</template>

<script setup>
const props = defineProps({
  title: String,
});
</script>
