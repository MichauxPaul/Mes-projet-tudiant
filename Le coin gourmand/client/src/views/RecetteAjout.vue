<script setup>
import { reactive } from 'vue';

const formData = reactive({
    RC_Titre: "",
    RC_Description: "",
    RC_Temps: 0,
    RC_Image: "",
    RC_Ingredient: "",
    RC_Etape: ""
});

function isFormValid() {
    return (
        formData.RC_Titre !== "" &&
        formData.RC_Description !== "" &&
        formData.RC_Temps > 0 &&
        !isNaN(formData.RC_Temps) &&
        formData.RC_Image !== "" &&
        formData.RC_Ingredient !== "" &&
        formData.RC_Etape !== ""
    );
}


// Convertir l'image en base64
function convertedImage(event) {
    const file = event.target.files[0];

    const reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onload = () => {
        formData.RC_Image = reader.result;
    };
}

// Envoi au backend
async function submitForm() {
    if (!isFormValid()) return;

    const response = await fetch("http://127.0.0.1:3005/recettes/add", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData)
    });

    const data = await response.json();

    //si l'envoie au backend est un succes alors on remet tous les champs du formulaire vide sauf celui du temps qui revient à 0
    if (data.success) {
        alert("Recette enregistrée !");

        Object.keys(formData).forEach(key => {
            if (key === "RC_Temps") {
                formData[key] = 0;
            } else {
                formData[key] = "";
            }
        });

    } else {
        alert("Erreur : " + data.message);
    }

};

function activatableButton() {
    if (isFormValid()) {
        return 'bg-green-600 hover:bg-green-500 cursor-pointer';
    } else {
        return 'bg-gray-400 cursor-not-allowed';
    }
}


</script>

<template>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 bg-white rounded-xl shadow-lg dark:bg-black font-content">
        <h3 class="text-3xl font-title text-slate-800 mb-6 text-center dark:text-white">Ajouter une recette</h3>

        <form @submit.prevent="submitForm" class="flex flex-col gap-5">
            <label class="flex flex-col gap-1">
                <span class="font-semibold text-slate-700 dark:text-white">Titre de la recette</span>
                <input v-model="formData.RC_Titre"
                    class="border border-slate-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 dark:text-white"
                    type="text" placeholder="Ex: Pâtes carbonara">
            </label>

            <label class="flex flex-col gap-1">
                <span class="font-semibold text-slate-700 dark:text-white">Description</span>
                <textarea v-model="formData.RC_Description"
                    class="border border-slate-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 h-24 dark:text-white"
                    placeholder="Description de la recette"></textarea>
            </label>

            <div class="flex flex-col sm:flex-row gap-4">

                <label class="flex-1 flex flex-col gap-1">
                    <span class="font-semibold text-slate-700 dark:text-white">Temps (minutes)</span>
                    <input v-model.number="formData.RC_Temps"
                        class="border border-slate-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 dark:text-white"
                        type="number" min="1" placeholder="Ex: 45">
                </label>

                <label class="flex-1 flex flex-col gap-2">
                    <span class="font-semibold text-slate-700 dark:text-white">Photo de la recette</span>
                    <label for="rcImage"
                        class="bg-zinc-800 text-white p-2 rounded-lg cursor-pointer hover:bg-zinc-600 text-center">
                        Choisir une image
                    </label>
                    <input id="rcImage" type="file" class="hidden" accept="image/*" @change="convertedImage">
                    <img v-if="formData.RC_Image" :src="formData.RC_Image"
                        class="w-full sm:w-40 rounded-lg shadow mt-2 mx-auto" alt="aperçu image">
                </label>

            </div>

            <label class="flex flex-col gap-1">
                <span class="font-semibold text-slate-700 dark:text-white">Ingrédients</span>
                <textarea v-model="formData.RC_Ingredient"
                    class="border border-slate-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 h-24 dark:text-white"
                    placeholder="Liste des ingrédients"></textarea>
            </label>

            <label class="flex flex-col gap-1">
                <span class="font-semibold text-slate-700 dark:text-white">Étapes</span>
                <textarea v-model="formData.RC_Etape"
                    class="border border-slate-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 h-24 dark:text-white"
                    placeholder="Étapes de préparation"></textarea>
            </label>

            <button type="submit" :disabled="!isFormValid()" :class="[
                'p-3 rounded-lg text-white font-semibold transition-all',
                activatableButton()]">Enregistrer
            </button>

        </form>
    </div>
</template>