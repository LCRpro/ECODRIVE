<template>
  <div class="min-h-screen py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-3xl md:max-w-4xl mx-auto bg-white bg-opacity-90 rounded-2xl  p-0 md:p-8">
        <div class="flex flex-col justify-center p-8">
          <h1 class="text-7xl font-black text-green-700 mb-2 tracking-tight">404</h1>
          <p class="text-2xl font-semibold text-gray-700 mb-4">Oups, cette page n’existe pas.</p>
          <p class="text-gray-500 mb-6">Il semblerait que vous soyez perdu. Retournez à l’accueil pour continuer à naviguer sur Ecodrive.</p>
          <router-link 
            to="/"
            class="inline-block px-6 py-3 rounded-lg bg-green-600 text-white font-bold shadow hover:bg-green-700 transition"
          >
            Retour à l’accueil
          </router-link>
        </div>
        <div class="flex items-center justify-center p-8">
          <img
            src="/img/404.jpg"
            alt="Page non trouvée"
            class="max-w-xs w-full h-auto mx-auto drop-shadow-lg"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>

</style>