<!-- eslint-disable prettier/prettier -->
<template>
  <div class="create">
    <h1>Adicionar Produto: {{ product.name }}</h1>
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
        <tbody>
          <tr>
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
              <input placeholder="Categoria" name="category" type="text" class="validate" v-model="product.category">
            </td>
            <td>
              <button type="submit" class="btn">
                <font-awesome-icon :icon="['fas', 'floppy-disk']" />
              </button>
            </td>
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
  name: "CreateProduct",
  data() {
    return {
      product: {
        name: "",
        description: "",
        category: "",
        price: 0,
      },
    };
  },
  methods: {
    save: async function () {
      const result = await this.$store.dispatch("createProduct", this.product);
      content = "Produto cadastrado com sucesso";
      if (!result) {
        content = "Erro ao cadastrar o produto";
        option.type = "danger";
      }
      this.$emit("displayToast", content, option);
      this.$router.push("/");
    },
  },
});
</script>

<style lang="scss">
.create {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  margin: 10px;
}
</style>
