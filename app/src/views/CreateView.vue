<template>
  <CreateProduct @displayToast="displayToast" />
</template>

<script lang="ts">
import CreateProduct from "@/components/Product/Create.vue";
import { ToastContent, ToastOptions, createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
import { defineComponent } from "vue";

export default defineComponent({
  name: "EditView",
  components: {
    CreateProduct,
  },
  methods: {
    displayToast: function (content: ToastContent, options: ToastOptions) {
      createToast(content, options);
    },
  },
});
</script>
