<template>
  <router-view></router-view>
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
