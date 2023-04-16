<template>
  <header>
    <img alt="Vue logo" src="./assets/logo.png" />
  </header>
  <router-view />
</template>

<script lang="ts">
import M from "materialize-css";
import "materialize-css/dist/css/materialize.min.css";

export default {
  name: "app",
  mounted: function () {
    M.AutoInit();
  },
};
</script>

<style lang="scss">
button {
  border: 0;
  background: none;
  cursor: pointer;
  margin: 2px;
}

header {
  display: flex;
  align-items: center;
  justify-content: center;
}

form {
  width: 100%;
}
</style>
