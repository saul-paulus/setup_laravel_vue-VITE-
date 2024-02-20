<template>
  <div class="container mx-auto px-4">
    <div>
      {{ title }}
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
