<!-- eslint-disable prettier/prettier -->
<template>
  <div class="list">
    <h1>Produtos</h1>
    <div class="row">
      <button class="btn" @click="createProduct">Novo</button>
    </div>
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

      <tbody v-if="products.length > 0">
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.category }}</td>
          <td>
            <button @click="editProduct(product.id)" class="btn">
              <font-awesome-icon :icon="['fas', 'pen']" />
            </button>
            <button data-target="confirmDelete" class="btn modal-trigger" @click="confirmModal(product.name, product.id)">
              <font-awesome-icon :icon="['fas', 'trash']" />
            </button>
          </td>
        </tr>
      </tbody>
      <tbody v-if="!products.length">
        <tr>
          <td colspan="5" class="center">Carregando dados...</td>
        </tr>
      </tbody>
    </table>
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
  name: "ListProduct",
  data() {
    return {
      interval: setTimeout(() => console.log(), 0),
    };
  },
  emits: ["displayToast", "showModal"],
  methods: {
    createProduct: function () {
      this.$router.push("/create");
    },
    editProduct: function (id: number) {
      this.$router.push(`/edit/${id}`);
    },
    deleteProduct: async function (id: number) {
      const result = await this.$store.dispatch("deleteProduct", id);
      content = "Produto excluido com sucesso";
      if (!result) {
        content = "Erro ao excluir o produto";
        option.type = "danger";
      }
      this.$emit("displayToast", content, option);
      this.$store.dispatch("getProducts");
    },
    confirmModal: function (name: string, id: number) {
      this.$emit(
        "showModal",
        true,
        "Alerta de Confirmação",
        `Deletar o produto ${name}`,
        "Você confirma a ação de deletar o produto?",
        () => this.deleteProduct(id)
      );
    },
  },
  computed: {
    products() {
      return this.$store.state.productList;
    },
  },
  created() {
    this.interval = setInterval(() => {
      this.$store.dispatch("getProducts");
    }, 3000);
  },
  mounted() {
    this.$store.dispatch("getProducts");
  },
  unmounted() {
    clearInterval(this.interval);
  },
});
</script>

<style scoped lang="scss">
.list {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  margin: 10px;
}
</style>
