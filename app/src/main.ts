import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faFloppyDisk,
  faPen,
  faTrash,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import moshaToast from "mosha-vue-toastify";
import { createApp } from "vue";

import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import store from "./store";

/* add jquery */
import $ from "jquery";
window.jQuery = window.$ = $;

/* add icons to the library */
library.add(faPen, faTrash, faFloppyDisk);

createApp(App)
  .component("font-awesome-icon", FontAwesomeIcon)
  .use(moshaToast)
  .use(store)
  .use(router)
  .mount("#app");
