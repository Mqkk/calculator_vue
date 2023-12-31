import { createApp } from "vue";
import App from "./App.vue";
import store from "./vuex/store.js";
import router from "./router/router.js";
// fontawesome
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
import { dom } from "@fortawesome/fontawesome-svg-core";
// rich-accordion
import { useAccordion } from "vue3-rich-accordion";
import "vue3-rich-accordion/accordion-library-styles.scss";
// tabs-component
import { Tabs, Tab } from "vue3-tabs-component";
// vue-select
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.scss";
// mask
import VueTheMask from "vue-the-mask";
// Уведомления
import Notifications from "@kyvg/vue3-notification";

dom.watch();

library.add(fas, fab, far);
createApp(App)
  .component("font-awesome-icon", FontAwesomeIcon)
  .component("tabs", Tabs)
  .component("tab", Tab)
  .component("Multiselect", Multiselect)
  .use(VueTheMask)
  .use(store)
  .use(router)
  .use(useAccordion)
  .use(Notifications)
  .mount("#app");
