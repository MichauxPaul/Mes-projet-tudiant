<script setup>
import { ref, watch } from 'vue'
const showDropdown = ref(false)
const showGenreDropdown = ref(false)



// Import images locales
import ac4 from '@/asset/images/ac-4-black-flag.webp'
import godOfWar from '@/asset/images/god-of-war-jaquette.jpg'
import godOfWarragnarok from '@/asset/images/god-of-war-ragnarok-jaquette.jpg'
import expedition from '@/asset/images/clair-obscure.webp'
import lis from '@/asset/images/jaquette-life-is-strange-2.jpg'

// Formulaire
const open = ref(false)
const openCardId = ref(null)
const form = ref({
  nom: '',
  genre: [],
  synopsis: '',
  jacquette: null,
  jacquettePreview: null,
  date: '',
  plateformes: []
})

// Bibliothèque de jeux présent de base
const jeux = ref([
  {
    titre: "Assassin's Creed IV Black Flag",
    plateformes: ["PC", "PlayStation 3", "PlayStation 4", "PlayStation 5", "XBOX 360", "Xbox One", "Xbox Series X|S", "Nintendo Switch", "Nintendo Switch 2"],
    description: "C'est l'histoire d'Edward Kenway, un corsaire britannique du XVIIIe siècle qui se retrouve plongé dans la guerre ancestrale entre Assassins et Templiers au cours de sa quête de richesse et de gloire lors de l'Âge d'or de la piraterie dans les Caraïbes.",
    image: ac4,
    parution: "29/10/2013",
    genre: "Action, Aventure, Solo, narratif, Monde ouvert"
  },
  {
    titre: "God of War (2018)",
    plateformes: ["PC", "PlayStation 4", "PlayStation 5"],
    description: "God of War (2018) suit un Kratos plus âgé et son fils, Atreus, dans un voyage pour réaliser le dernier souhait de sa défunte épouse Faye : disperser ses cendres du plus haut sommet des Neuf Royaumes nordiques.",
    image: godOfWar,
    parution: "20/04/2018",
    genre: "Solo, narratif, RPG, Monde fermé",
  },
  {
    titre: "God of War Ragnarök",
    plateformes: ["PC", "PlayStation 4", "PlayStation 5"],
    description: "God of War Ragnarök suit Kratos et son fils adolescent Atreus alors qu'ils voyagent à travers les Neuf Royaumes pour empêcher le Ragnarök prophétisé.",
    image: godOfWarragnarok,
    parution: "09/11/2022",
    genre: "Solo, narratif, RPG, Monde fermé",
  },
  {
    titre: "Clair Obscure : Expédition 33",
    plateformes: ["PC", "PS5", "Xbox Series X|S"],
    description: "Dans Clair Obscur : Expédition 33, les survivants de la ville de Lumière partent en expédition pour détruire la Peintresse, une entité qui efface chaque année les personnes dont l'âge correspond à un nombre qu'elle peint sur un monolithe. L'Expédition 33 est la 33ème tentative de mettre fin à ce phénomène appelé le «Gommage» annuel, survenu 67 ans après la «Fracture». Le jeu suit un groupe d'explorateurs, menés par le protagoniste Gustave, dans leur quête pour affronter la Peintresse et mettre fin au cycle de mort. #Expedition33GOTY ",
    image: expedition,
    parution: "24/04/2025",
    genre: "Solo, narratif, JRPG, Monde ouvert",
  },
  {
    titre: "Life is strange 2 ",
    plateformes: ["PC", "PS4", "PS5", "Xbox One", "Xbox Series X|S", "Nintendo Switch", "Nintendo Switch 2"],
    description: "L'histoire suit les frères Sean et Daniel Diaz après qu'un tragique incident les a contraints à fuir leur domicile de Seattle. Au cours de l'incident, leur père est abattu par un policier et les pouvoirs télékinétiques latents de Daniel se réveillent. Les frères se lancent alors dans un voyage à travers le pays jusqu'au Mexique. Sean, l'aîné, prend en charge la sécurité et l'éducation de Daniel tout en essayant de lui apprendre à contrôler ses pouvoirs. ",
    image: lis,
    parution: "27/10/2018",
    genre: "Solo, narratif, A choix",
  }
])

// Chargement depuis le localStorage 
const sauvegarde = localStorage.getItem('jeux')
if (sauvegarde) {
  try {
    jeux.value = JSON.parse(sauvegarde)
  } catch (e) {
    console.error("Erreur lors du chargement du localStorage :", e)
  }
}

// tableau des genres pour le formulaire d'ajout d'un jeu
const genres = [
  "Action",
  "Aventure",
  "Narratif",
  "RPG",
  "JRPG",
  "MMORPG",
  "FPS",
  "TPS",
  "Simulation",
  "Gestion",
  "Stratégie",
  "Infiltration",
  "Jeu de sport",
  "Course automobile",
  "Survival horror",
  "Plateforme",
  "Puzzle",
  "Beat them all",
  "Versus fighting",
  "Monde ouvert",
  "Monde fermé",
  "Shoot them up",
  "Hack'n'slash",
  "Rogue-like",
  "Tactical RPG",
  "Réflexion",
  "Labyrinthe",
  "A choix"
]


// bloque scroll du body quand pop-up formulaire ouvert
watch(open, (val) => {
  document.body.style.overflow = val ? 'hidden' : ''
})

// bloque scroll du body quand pop-up jeu ouvert
watch(openCardId, (val) => {
  document.body.style.overflow = val !== null ? 'hidden' : ''
})

// Sauvegarde automatique à chaque changement
watch(jeux, (nouvelleValeur) => {
  localStorage.setItem('jeux', JSON.stringify(nouvelleValeur))
}, { deep: true })




// Upload image et conversion en Base64
const UploadImg = (event) => {
  const file = event.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = () => {
      form.value.jacquette = reader.result // base64
      form.value.jacquettePreview = reader.result
    }
    reader.readAsDataURL(file)
  }
}

// Ajouter un jeu
const submitForm = () => {
  const nouveauJeu = {
    titre: form.value.nom,
    plateformes: [...form.value.plateformes],
    description: form.value.synopsis,
    genre: [...form.value.genre],
    parution: form.value.date,
    image: form.value.jacquettePreview || ac4
  }
  jeux.value.push(nouveauJeu)

  // Reset formulaire
  form.value = {
    nom: '',
    genre: [],
    synopsis: '',
    jacquette: null,
    jacquettePreview: null,
    date: '',
    plateformes: []
  }
  open.value = false
}


// Supprimer un jeu 
const supprimerJeu = (index) => {
  jeux.value.splice(index, 1)
  openCardId.value = null
}


</script>

<template>
  <header class="h-32 flex items-center justify-center bg-blue-400 p-6">
    <h1 class="text-4xl text-orange-500 cursor-pointer transform transition duration-300 hover:scale-110">
      PassionJV
    </h1>
  </header>


  <main class="relative">
    <section class="bg-gradient-to-b from-blue-400 to-orange-600">
      <div class="flex flex-col items-center justify-center py-6">
        <h2 class="text-2xl text-white font-bold">Votre bibliothèque</h2>
        <button @click="open = true"
          class="mt-4 bg-amber-600 rounded-2xl px-6 py-3 text-white hover:bg-amber-700 transition">
          Ajouter un nouveau jeu vidéo
        </button>
      </div>
    </section>

    <!-- Pop-up formulaire ajout jeu vidéo -->
    <section v-if="open" class="fixed inset-0 z-50 flex items-start justify-center pt-10 pb-10 bg-black/60"
      @click.self="open = false">
      <section
        class="bg-white/0 backdrop-blur-md  text-white rounded-2xl shadow-lg p-6 w-full max-w-lg max-h-[90vh] overflow-auto relative">
        <button @click="open = false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">✖</button>
        <h2 class="text-2xl font-bold text-amber-700 mb-6 text-center">Ajouter un nouveau jeu</h2>
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label class="block mb-1 font-medium">Nom du jeu</label>
            <input v-model="form.nom" type="text"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
              required />
          </div>
          <!-- Sélection du genre -->
          <div class="relative">
            <label class="block mb-1 font-medium">Genres</label>
            <div @click="showGenreDropdown = !showGenreDropdown"
              class="w-full border rounded-lg px-3 py-2 bg-white/0 backdrop-blur-md text-white cursor-pointer focus:ring-2 focus:ring-amber-500 flex justify-between items-center">
              <span>
                {{ form.genre.length > 0 ? form.genre.join(', ') : 'Sélectionner un ou plusieurs genres' }}
              </span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>

            <!-- Menu déroulant genres -->
            <div v-if="showGenreDropdown"
              class="absolute mt-1 w-full bg-white/40 backdrop-blur-md border rounded-lg shadow-lg z-50 max-h-48 overflow-y-auto">
              <label v-for="genre in genres" :key="genre"
                class="flex items-center px-3 py-2 hover:bg-blue-400 cursor-pointer">
                <input type="checkbox" :value="genre" v-model="form.genre" class="accent-amber-600 mr-2" />
                {{ genre }}
              </label>
            </div>
          </div>

          <div class="relative">
            <label class="block mb-1 font-medium">Plateformes</label>
            <div @click="showDropdown = !showDropdown"
              class="w-full border rounded-lg px-3 py-2 bg-white/0 backdrop-blur-md text-white cursor-pointer focus:ring-2 focus:ring-amber-500 flex justify-between items-center">
              <span>
                {{ form.plateformes.length > 0 ? form.plateformes.join(', ') : 'Sélectionner des plateformes' }}
              </span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>

            <!-- Menu déroulant -->
            <div v-if="showDropdown"
              class="absolute mt-1 w-full bg-white/20 backdrop-blur-md border rounded-lg shadow-lg z-50 max-h-48 overflow-y-auto">
              <label
                v-for="plat in ['PC', 'PlayStation 1', 'PlayStation 2', 'PlayStation 3', 'PlayStation 4', 'PlayStation 5', 'PlayStation Vita', 'Xbox Series X|S', 'Xbox One', 'Xbox 360', 'Xbox', 'Nintendo Switch', 'Nintendo Switch 2', 'Mobile', 'Magnavox Odyssey', 'Ping-O-Tronic', 'Atari Game Brain', 'Atari 2600', 'Game and Watch', 'Atari 7800', 'Nintendo Entertainment System', 'Mega Drive', 'Game Gear', 'Neo-Geo', 'Game Boy', 'Super Nintendo', 'Atari Jaguar', 'Game Boy Color', 'Nintendo 64', 'Dreamcast', 'GameCube', 'PSP', 'Wii', 'Wii U', 'Nintendo DS', 'Nintendo 3DS', 'Nintendo 2DS']"
                :key="plat" class="flex items-center px-3 py-2 cursor-pointer">
                <input type="checkbox" :value="plat" v-model="form.plateformes" class="accent-amber-600 mr-2" />
                {{ plat }}
              </label>
            </div>
          </div>


          <div>
            <label class="block mb-1 font-medium">Synopsis</label>
            <textarea v-model="form.synopsis" rows="3"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 resize-none"
              required></textarea>
          </div>
          <div>
            <label class="block mb-1 font-medium">Jacquette (image)</label>
            <input type="file" accept="image/*" @change="UploadImg" class="w-full text-sm text-gray-600" />
            <div v-if="form.jacquettePreview" class="mt-3 flex justify-center">
              <img :src="form.jacquettePreview" class="w-32 h-32 object-cover rounded-lg shadow" />
            </div>
          </div>
          <div>
            <label class="block mb-1 font-medium">Date de parution</label>
            <input v-model="form.date" type="date"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
              required />
          </div>
          <button type="submit"
            class="w-full bg-amber-600 text-white rounded-lg py-2 hover:bg-amber-700 transition">Enregistrer le
            jeu</button>
        </form>
      </section>
    </section>

    <!-- Bibliothèque cartes -->
    <section class="w-full min-h-screen relative">
      <div class="absolute inset-0 bg-[url('@/asset/images/banniere_jv.jpg')] bg-cover bg-center z-0"></div>
      <div class="relative z-10 flex flex-wrap justify-center gap-6 py-5 px-6">
        <div v-for="(jeu, index) in jeux" :key="index"
          class="max-w-sm bg-white/0 backdrop-blur-md rounded-lg shadow-lg overflow-hidden text-white">
          <img :src="jeu.image" :alt="jeu.titre" class="w-full h-48 object-cover rounded-t-lg" />
          <div class="p-5 flex flex-col items-start gap-2">
            <h5 class="text-2xl font-bold">{{ jeu.titre }}</h5>
            <p class="text-white/80 text-sm">Plateforme : {{ jeu.plateformes.join(', ') }}</p>
            <button @click="openCardId = index"
              class="bg-amber-600 rounded-2xl px-3 py-2 text-white hover:bg-amber-700 transition mt-2 self-start">
              Plus d'informations
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Pop-up carte + info -->
    <section v-if="openCardId !== null" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4"
      @click.self="openCardId = null">
      <section
        class="text-white relative flex flex-col md:flex-row w-full max-w-3xl bg-white/0 backdrop-blur-md rounded-xl shadow-lg overflow-auto">
        <!-- Image -->
        <div class="md:w-2/5 shrink-0">
          <img :src="jeux[openCardId].image" :alt="jeux[openCardId].titre"
            class="h-64 md:h-full w-full object-cover rounded-t-xl md:rounded-l-xl md:rounded-tr-none" />
        </div>
        <!-- Contenu texte -->
        <div class="p-6 flex flex-col justify-between md:w-3/5">
          <div>
            <div class="flex flex-wrap gap-2 mb-4">
              <span v-for="(plat, i) in jeux[openCardId].plateformes" :key="i"
                class="rounded-full bg-amber-600 py-0.5 px-3 text-xs text-white">{{ plat }}</span>
            </div>
            <h2 class="text-2xl font-bold mb-2">{{ jeux[openCardId].titre }}</h2>
            <p class="mb-2"><strong>Genre :</strong> {{ Array.isArray(jeux[openCardId].genre) ?
              jeux[openCardId].genre.join(', ') : jeux[openCardId].genre }}</p>
            <p class=" mb-2"><strong>Parution :</strong> {{ jeux[openCardId].parution }}</p>
            <h3 class=" font-semibold mt-4 mb-1">Synopsis</h3>
            <p class=" whitespace-pre-line">{{ jeux[openCardId].description }}</p>

            <div class="flex justify-end gap-3">
              <button @click="supprimerJeu(openCardId)"
                class="bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 transition">
                Supprimer
              </button>
              <button @click="openCardId = null"
                class="bg-gray-500 hover:bg-gray-600 text-white rounded-lg px-4 py-2 transition">
                Fermer
              </button>
            </div>
          </div>
        </div>
        <button @click="openCardId = null"
          class="absolute top-3 right-3 text-gray-800 hover:text-amber-600 font-bold text-xl">✖</button>
      </section>
    </section>

  </main>

  <footer class="text-center bg-green-300">
    <p>&copy; 2025 - Paul Michaux </p>
  </footer>
</template>


<style scoped></style>