<!-- eslint-disable prettier/prettier -->
<template>
  <div class="edit">
    <h1>Editar Produto: {{ product.name }}</h1>
    <form method="post" @submit.prevent="save">
      <table class="striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody v-if="product.hasOwnProperty('id')">
          <tr :key="product.id">
            <td>
              <input placeholder="Nome" type="text" name="name" class="validate" v-model="product.name">
            </td>
            <td>
              <input placeholder="Descrição" name="description" type="text" class="validate"
                v-model="product.description">
            </td>
            <td>
              <input placeholder="0.00" name="price" type="number" class="validate" step="0.01" v-model="product.price">
            </td>
            <td>
              <input placeholder="Categorias" name="category" type="text" class="validate" v-model="product.category">
            </td>
            <td>
              <button type="submit" class="btn">
                <font-awesome-icon :icon="['fas', 'floppy-disk']" />
              </button>
            </td>
          </tr>
        </tbody>
        <tbody v-if="!product.hasOwnProperty('id')">
          <tr>
            <td colspan="5" class="center">Carregando dados...</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</template>

<script lang="ts">
import { ToastContent, ToastOptions } from "mosha-vue-toastify";
import { defineComponent } from "vue";
let content: ToastContent = "";
let option: ToastOptions = {
  type: "success",
  timeout: 3000,
};

export default defineComponent({
  name: "EditProduct",
  methods: {
    getProduct: function (id: string) {
      this.$store.dispatch("getProduct", id);
    },
    save: async function () {
      const result = await this.$store.dispatch("editProduct", this.product);
      content = "Produto editado com sucesso";
      if (!result) {
        content = "Erro ao editar o produto";
        option.type = "danger";
      }
      this.$emit("displayToast", content, option);
      this.$router.push("/");
    },
  },
  computed: {
    product() {
      return this.$store.state.product;
    },
  },
  created() {
    this.$store.dispatch("getProduct", this.$route.params.id);
  },
});
</script>

<style lang="scss">
.edit {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  margin: 10px;
}
</style>
