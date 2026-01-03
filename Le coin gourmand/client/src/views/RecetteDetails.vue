<script setup>
import { useRecettesStore } from "@/stores/recettesStore.js";
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const recettesStore = useRecettesStore();
const route = useRoute();
const router = useRouter();

const recetteDetails = reactive({ data: null });
const isEditing = ref(false);
const showDeletePopup = ref(false);

// Formulaire de modification
const editData = reactive({
    RC_Titre: "",
    RC_Description: "",
    RC_Temps: "",
    RC_Ingredient: "",
    RC_Etape: "",
    RC_Image: ""
});

// Charge les données
onMounted(async () => {
    if (recettesStore.recettes.length === 0) {
        await recettesStore.getAllRecettes();
    }

    recetteDetails.data = recettesStore.getRecette(route.params.id);

    // pre-remplir le formulaire
    Object.assign(editData, recetteDetails.data);
});

function home() {
    router.push("/");
}

// Activer le mode édition
function editRecette() {
    isEditing.value = true;
}

// Modifier l’image en base64
function convertedImage(event) {
    const file = event.target.files[0];

    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        editData.RC_Image = reader.result;
    };
}

// Enregistrer les modifications
async function saveEdit() {
    const id = route.params.id;

    await recettesStore.updateRecette(id, editData);

    isEditing.value = false;
    Object.keys(editData).forEach(key => {
        recetteDetails.data[key] = editData[key];
    });
}

// Supprimer la recette
async function confirmDelete() {
    const id = route.params.id;

    await recettesStore.deleteRecette(id);

    showDeletePopup.value = false;
    router.push("/");
}
</script>

<template>
    <div class="mb-6 text-center">
        <h3 class="text-3xl text-white font-content">
            <span v-if="isEditing">Modification de la recette</span>
            <span v-else>Détails de la recette</span>
        </h3>
    </div>


    <!-- Popup de suppression -->
    <div v-if="showDeletePopup" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 font-content ">
        <div class="bg-white p-6 rounded-xl shadow-xl w-80 text-center space-y-4 dark:bg-black">
            <h3 class="text-xl font-semibold text-slate-800 dark:text-white">Supprimer cette recette ?</h3>
            <p class="text-slate-600 dark:text-white">Cette action est irréversible.</p>

            <div class="flex gap-3 mt-4">
                <button @click="confirmDelete"
                    class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 cursor-pointer">
                    Supprimer
                </button>
                <button @click="showDeletePopup = false"
                    class="flex-1 bg-gray-300 text-slate-800 py-2 rounded-lg hover:bg-gray-400 cursor-pointer">
                    Annuler
                </button>
            </div>
        </div>
    </div>

    <!-- Mode Edition -->
    <div v-if="isEditing"
        class="bg-white rounded-xl shadow-lg p-6 space-y-6 max-w-2xl mx-auto dark:bg-black font-content">
        <label class="block">
            <span class="font-semibold dark:text-white">Titre</span>
            <input v-model="editData.RC_Titre" class="border p-2 w-full rounded dark:border-white dark:text-white"
                type="text">
        </label>

        <label class="block">
            <span class="font-semibold dark:text-white">Description</span>
            <textarea v-model="editData.RC_Description"
                class="border p-2 w-full rounded h-24 dark:border-white dark:text-white"></textarea>
        </label>

        <label class="block">
            <span class="font-semibold dark:text-white">Temps (min)</span>
            <input v-model.number="editData.RC_Temps" type="number"
                class="border p-2 w-full rounded dark:border-white dark:text-white">
        </label>

        <label class="block">
            <span class="font-semibold dark:text-white">Ingrédients</span>
            <textarea v-model="editData.RC_Ingredient"
                class="border p-2 w-full rounded h-24 dark:border-white dark:text-white"></textarea>
        </label>

        <label class="block">
            <span class="font-semibold dark:text-white">Étapes</span>
            <textarea v-model="editData.RC_Etape"
                class="border p-2 w-full rounded h-24 dark:border-white dark:text-white"></textarea>
        </label>

        <div class="space-y-2">
            <span class="font-semibold dark:text-white">Image</span>
            <input type="file" accept="image/*" @change="convertedImage"
                class="border p-2 rounded dark:border-white dark:text-white">
            <img v-if="editData.RC_Image" :src="editData.RC_Image" class="w-40 rounded shadow">
        </div>

        <div class="flex gap-3 mt-4">
            <button @click="saveEdit"
                class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 cursor-pointer">
                Enregistrer
            </button>

            <button @click="isEditing = false"
                class="flex-1 bg-gray-300 text-slate-800 py-2 rounded-lg hover:bg-gray-400 cursor-pointer">
                Annuler
            </button>
        </div>
    </div>

    <!-- Détail de la recette -->
    <div v-else-if="recetteDetails.data"
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row gap-6 md:gap-8 dark:bg-black font-content ">


        <div class="w-full md:w-1/3">
            <img class="w-full h-auto rounded-xl shadow-md object-cover" :src="recetteDetails.data.RC_Image"
                alt="Image recette">
        </div>


        <div class="flex-1 space-y-6 ">
            <h4 class="text-3xl font-title text-slate-800 dark:text-white">
                {{ recetteDetails.data.RC_Titre }}
            </h4>

            <p class="text-slate-700 text-lg dark:text-white">
                {{ recetteDetails.data.RC_Description }}
            </p>

            <div class="bg-slate-100 p-4 rounded-lg inline-block dark:bg-gray-700">
                <h5 class="text-lg font-semibold text-slate-800 dark:text-white">
                    Temps de préparation :
                    <span class="font-bold">{{ recetteDetails.data.RC_Temps }} min</span>
                </h5>
            </div>

            <div>
                <h4 class="font-semibold text-xl text-slate-800 dark:text-white"> Ingrédients</h4>
                <p class="whitespace-pre-line text-slate-700 dark:text-white">{{ recetteDetails.data.RC_Ingredient }}
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-xl text-slate-800 dark:text-white">Étapes</h4>
                <p class="whitespace-pre-line text-slate-700 dark:text-white">{{ recetteDetails.data.RC_Etape }}</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 mt-4">
                <button @click="editRecette"
                    class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 cursor-pointer">
                    Modifier
                </button>

                <button @click="showDeletePopup = true"
                    class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 cursor-pointer">
                    Supprimer
                </button>

                <button @click="home"
                    class="flex-1 bg-gray-500 text-white py-2 rounded-lg hover:bg-gray-600 cursor-pointer">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</template>