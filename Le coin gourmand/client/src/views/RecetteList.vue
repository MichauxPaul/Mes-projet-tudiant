<script setup>
import { useRecettesStore } from '@/stores/recettesStore.js';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const recettesStore = useRecettesStore();
const router = useRouter();

function showDetails(id) {
    router.push(`/details/${id}`);
}

onMounted(async () => {
    await recettesStore.getAllRecettes();
});

</script>

<template>
    <h2 class="text-center text-4xl font-content text-white mb-5">
        Liste des recettes
    </h2>

    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 font-content">
        <li v-for="RecetteCuisine in recettesStore.recettes" :key="RecetteCuisine.RC_Id"
            class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg hover:scale-110 transition-all duration-300 w-full dark:bg-black dark:border-black">

            <div class="relative h-56 overflow-hidden text-white rounded-t-lg">
                <img :src="RecetteCuisine.RC_Image" alt="image recette" class="w-full h-full object-cover" />
            </div>

            <!-- Titre + description + temps -->
            <div class="p-4 flex-1 flex flex-col justify-between">
                <div>
                    <h6 class="font-content mb-2 text-slate-800 text-xl font-semibold dark:text-white">
                        {{ RecetteCuisine.RC_Titre }}
                    </h6>
                    <p class="text-slate-600 leading-normal font-content line-clamp-3 dark:text-gray-400">
                        {{ RecetteCuisine.RC_Description }}
                    </p>
                </div>
                <p class="text-slate-600 font-semibold mt-2 dark:text-gray-300">
                    {{ RecetteCuisine.RC_Temps }} min
                </p>
            </div>

            <!-- Bouton pour voir la recette -->
            <div class="p-4 pt-0 mt-2 ">
                <button @click.stop="showDetails(RecetteCuisine.RC_Id)"
                    class="w-full rounded-md bg-slate-800 py-2 px-4 text-sm text-white hover:bg-slate-700 transition cursor-pointer">
                    Voir la recette
                </button>
            </div>
        </li>
    </ul>
</template>
