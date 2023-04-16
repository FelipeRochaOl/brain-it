<!-- eslint-disable prettier/prettier -->
<template>
  <ListProduct @displayToast="displayToast" @showModal="openModal" />
  <Teleport to="body">
    <Modal :show="showModal" @close="showModal = false" :headerMessage="headerModal" :bodyMessage="bodyModal"
      :actionYes="actionModalYes">
      <template #header>
        <h4>{{ titleModal }}</h4>
      </template>
    </Modal>
  </Teleport>
</template>

<script lang="ts">
import ListProduct from "@/components/Product/List.vue";
import Modal from "@/components/Shared/Modal.vue";
import { ToastContent, ToastOptions, createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
import { defineComponent } from "vue";

export default defineComponent({
  name: "HomeView",
  data() {
    return {
      showModal: false,
      titleModal: "",
      headerModal: "",
      bodyModal: "",
      actionModalYes: Function,
    };
  },
  components: {
    ListProduct,
    Modal,
  },
  methods: {
    displayToast: function (content: ToastContent, options: ToastOptions) {
      createToast(content, options);
    },
    openModal: function (
      value: boolean,
      title: string,
      header: string,
      body: string,
      action: FunctionConstructor
    ) {
      this.showModal = value;
      this.titleModal = title;
      this.headerModal = header;
      this.bodyModal = body;
      this.actionModalYes = action;
    },
  },
});
</script>
