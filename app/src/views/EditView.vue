<template>
  <EditProduct @displayToast="displayToast" />
</template>

<script lang="ts">
import EditProduct from "@/components/Product/Edit.vue";
import { ToastContent, ToastOptions, createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
import { defineComponent } from "vue";

export default defineComponent({
  name: "EditView",
  components: {
    EditProduct,
  },
  methods: {
    displayToast: function (content: ToastContent, options: ToastOptions) {
      createToast(content, options);
    },
  },
});
</script>
