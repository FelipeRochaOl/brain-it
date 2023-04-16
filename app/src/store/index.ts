import { Product } from "@/interfaces/Product";
import axios from "axios";
import { createStore } from "vuex";

type State = {
  product: Product;
  productList: Product[];
};

const api = axios.create({
  baseURL: process.env.VUE_APP_SERVER,
});

export default createStore({
  state: {
    product: {} as Product,
    productList: [],
  },
  mutations: {
    updateProductList(state: State, data: Product[]) {
      state.productList = data;
    },
    updateProduct(state: State, data: Product) {
      state.product = data;
    },
  },
  actions: {
    async getProducts(context) {
      try {
        const result = await api.get("/product");
        context.commit("updateProductList", result.data.response.data);
      } catch (error) {
        process.env.NODE_ENV !== "production" ? console.error(error) : null;
      }
    },
    async getProduct(context, id) {
      try {
        const result = await api.get(`/product/${id}`);
        context.commit("updateProduct", result.data.response);
      } catch (error) {
        process.env.NODE_ENV !== "production" ? console.error(error) : null;
      }
    },
    async createProduct(context, product: Product) {
      try {
        const result = await api.post("/product/", product);
        if (result.status !== 200) {
          return false;
        }
        const newProduct = result.data.response;
        context.state.productList.push(newProduct);
        context.commit("updateProductList", context.state.productList);
        return true;
      } catch (error) {
        process.env.NODE_ENV !== "production" ? console.error(error) : null;
        return false;
      }
    },
    async editProduct(context, product: Product) {
      try {
        const result = await api.put(`/product/${product.id}`, product);
        if (result.status !== 200) {
          return false;
        }
        const productUp = result.data.response;
        const productIndex = context.state.productList.findIndex(
          (product) => product.id === productUp.id
        );
        if (productIndex) {
          context.state.productList[productIndex] = productUp;
        }
        context.commit("updateProduct", productUp);
        context.commit("updateProductList", context.state.productList);
        return true;
      } catch (error) {
        process.env.NODE_ENV !== "production" ? console.error(error) : null;
        return false;
      }
    },
    async deleteProduct(context, id: number) {
      try {
        const result = await api.delete(`/product/${id}`);
        if (result.status !== 200) {
          return false;
        }
        const productIndex = context.state.productList.findIndex(
          (product) => product.id === id
        );
        if (productIndex) {
          delete context.state.productList[productIndex];
        }
        context.commit("updateProductList", context.state.productList);
        return true;
      } catch (error) {
        process.env.NODE_ENV !== "production" ? console.error(error) : null;
        return false;
      }
    },
  },
});
