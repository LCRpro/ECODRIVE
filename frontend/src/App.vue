<script setup>
import { ref, onMounted } from 'vue'

const userName = ref('')

function logout() {
  localStorage.removeItem('token')
  window.location.reload()
}

onMounted(async () => {
  const token = localStorage.getItem('token')
  if (token) {
    try {
      const res = await fetch('http://localhost:8000/me', {
        headers: {
          Authorization: 'Bearer ' + token,
        },
      })
      const data = await res.json()
      userName.value = data.name || 'Utilisateur'
    } catch (e) {
      userName.value = 'Utilisateur'
    }
  }
})
</script>

<template>
  <div class="min-h-screen flex flex-col bg-gray-100 text-gray-900">
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4  flex justify-between items-center">
        <div class="flex items-center space-x-4">
          <img src="/logo-ecodrive.png" alt="ECODRIVE Logo" class="h-12 sm:h-16 md:h-20 lg:h-24 w-auto" />
          <router-link to="/" class="text-gray-700 hover:text-blue-700">Accueil</router-link>
          <router-link to="/me" class="text-gray-700 hover:text-blue-700">Profil</router-link>
        </div>
        <div v-if="userName" class="relative group">
          <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ userName }}
          </button>
          <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-md opacity-0 group-hover:opacity-100 transition-opacity">
            <router-link to="/me" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</router-link>
            <button
              @click="logout"
              class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
            >
              Déconnexion
            </button>
          </div>
        </div>
      </div>
    </nav>

    <main class="flex-grow p-4">
      <router-view />
    </main>

    <footer class="bg-white text-center text-sm text-gray-600 py-4 shadow-inner">
      &copy; 2025 ECODRIVE. Tous droits réservés.
    </footer>
  </div>
</template>

<style>
</style>