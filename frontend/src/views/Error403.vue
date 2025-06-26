

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 text-center px-4">
    <h1 class="text-6xl font-bold text-red-600 mb-4">403</h1>
    <h2 class="text-2xl font-semibold mb-2">Accès interdit</h2>
    <p class="text-gray-700 mb-6">
      Vous n'avez pas l'autorisation d'accéder à cette page.
    </p>
    <router-link to="/" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
      Retour à l'accueil
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'Error403'
}
</script>