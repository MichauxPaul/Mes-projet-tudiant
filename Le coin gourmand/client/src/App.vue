<script setup>

import { ref } from "vue";

// Mode sombre activé par défaut
const darkMode = ref(true);
const darkModeIsActive = ref("Clair Obscur");

// fonction pour changer le thème
function switchDarkMode() {
  darkMode.value = !darkMode.value;
  if (darkMode.value === true) {
    darkModeIsActive.value = "Clair Obscur";
  } else {
    darkModeIsActive.value = "Clair";
  }
}



</script>

<template>
  <div class="flex flex-col min-h-screen" :class="{ 'dark': darkMode }">
    <header class="min-h-48 p-10 bg-cover bg-[url(./images/baniere.jpg)] text-center">

      <h1 class="text-center text-5xl text-yellow-400 p-3 w-fit mx-auto mb-3 font-title">Le
        coin Gourmand</h1>

      <h2 class="text-xl font-content text-zinc-200 drop-shadow-sm bg-zinc-700 rounded-2xl p-3 w-fit mx-auto">Des
        recettes
        simples,
        des saveurs grandioses</h2>
      <nav class="font-content bg-zinc-800/50 text-zinc-100 w-fit mt-5 p-4 rounded-4xl mx-auto">
        <ul class="flex gap-2">
          <li>
            <router-link to="/" class="hover:underline">Liste des recettes/Accueille</router-link>
          </li>
          <li>
            <router-link to="/NewRecette" class="hover:underline">Ajouter une recette</router-link>
          </li>
          <li>
            <router-link to="/Description" class="hover:underline">Description du projet</router-link>
          </li>
        </ul>
      </nav>

      <button @click="switchDarkMode"
        class="rounded-2xl bg-black/80 text-white dark:bg-gray-600 mt-5 p-4 cursor-pointer text-xs hover:scale-110 transition-all duration-300 font-content">
        Mode : {{ darkModeIsActive }}
      </button>

    </header>
    <main class="grow p-10 bg-[url(./images/bkg-cuisine.jpg)]">
      <RouterView></RouterView>
    </main>
    <footer class="dark:bg-zinc-800 p-5 dark:text-zinc-100  text-center">&copy; Le
      coin Gourmand - Paul Michaux - 2025
    </footer>
  </div>
</template>
