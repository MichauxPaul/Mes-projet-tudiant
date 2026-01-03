import { ref } from "vue";
import { defineStore } from "pinia";
import fetchUtils from "@/utils/fetch.js";

export const useRecettesStore = defineStore("recettesStore", () => {
  const recettes = ref([]);

  // Récupérer toutes les recettes
  async function getAllRecettes() {
    try {
      const request = await fetchUtils.get("recettes/all");

      if (request.success) {
        recettes.value = request.data;
      } else {
        console.error("Erreur API :", request.message);
      }
    } catch (error) {
      console.error("Erreur réseau :", error);
    }
  }

  // Récupérer une recette selon ID
  function getRecette(id) {
    return recettes.value.find((r) => r.RC_Id == id);
  }

  // Ajouter une nouvelle recette
  async function addNewRecette(payload) {
    try {
      const request = await fetchUtils.post("recettes/add", payload);

      if (request.success) {
        await getAllRecettes();
      } else {
        console.error("Erreur API :", request.message);
      }
    } catch (error) {
      console.error("Erreur réseau :", error);
    }
  }

  // Modifier une recette
  async function updateRecette(id, payload) {
    const request = await fetchUtils.put("recettes/edit/" + id, payload);
  }

  // Supprimer une recette
  async function deleteRecette(id) {
    const data = await fetchUtils.delete("recettes/" + id);

    if (!data.success) {
      console.error("Erreur API :", data.message);
    } 
    return data;
  }

  return {
    recettes,
    getAllRecettes,
    getRecette,
    addNewRecette,
    updateRecette,
    deleteRecette
  };
});
