import RecetteDetails from "@/views/RecetteDetails.vue";
import RecetteAjout from "@/views/RecetteAjout.vue";
import RecetteList from "@/views/RecetteList.vue";
import { createRouter, createWebHistory } from "vue-router";
import Description from "@/views/Description.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      name: "recettesStore",
      path: "/",
      component: RecetteList,
    },
    {
      name: "RecetteDetails",
      path: "/details/:id",
      component: RecetteDetails,
    },
    {
      name: "NewRecette",
      path: "/NewRecette",
      component: RecetteAjout,
    },
    {
      name: "Description",
      path: "/Description",
      component: Description,
    },
  ],
});

export default router;
