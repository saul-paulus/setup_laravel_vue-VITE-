<template>
  <router-view></router-view>

  <pre>{{ user }}</pre>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "App",
  computed: {
    ...mapState(["user"]),
  },
};
</script>
