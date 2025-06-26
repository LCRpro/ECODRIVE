<template>
  <div class=" min-h-screen">
    <section class="relative h-72 md:h-96 flex items-center justify-center mb-12">
      <img
        src="/img/header.jpg"
        alt="Nature"
        class="absolute inset-0 w-full h-full object-cover rounded-b-3xl shadow"
      />
      <div class="relative z-10 flex flex-col items-center text-center px-4">
        <h1 class="text-4xl md:text-6xl font-black text-white drop-shadow-lg mb-2">Bienvenue sur Ecodrive</h1>
        <p class="text-lg md:text-2xl text-white font-medium drop-shadow">La mobilité responsable, c'est maintenant.</p>
        <router-link
          to="/me"
          class="mt-6 inline-block px-6 py-3 rounded-lg bg-green-600 text-white font-bold shadow hover:bg-green-700 transition"
        >
          Commander une course
        </router-link>
      </div>
      <div class="absolute inset-0 bg-black/40 rounded-b-3xl"></div>
    </section>

    <section class="container mx-auto px-4 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center max-w-5xl mx-auto bg-white bg-opacity-90 rounded-2xl shadow-lg p-8">
        <div>
          <h2 class="text-3xl font-bold text-green-700 mb-4">Pourquoi Ecodrive ?</h2>
          <p class="text-lg text-gray-700 mb-6">
            Ecodrive vous accompagne vers une mobilité plus propre et plus efficace.<br />
            Suivez votre impact, gagnez des récompenses, et rejoignez la communauté des conducteurs responsables.
          </p>
          <ul class="list-disc marker:text-green-500 ml-5 text-gray-600 space-y-1">
            <li>Réduisez votre empreinte carbone facilement</li>
            <li>Analysez vos trajets et optimisez vos déplacements</li>
            <li>Participez à des challenges écoresponsables</li>
          </ul>
        </div>
        <div class="flex items-center justify-center">
          <img
            src="/img/ecodrive1.jpg"
            alt="Conduite écologique"
            class="max-w-xs w-full h-auto rounded-xl drop-shadow-lg"
          />
        </div>
      </div>
    </section>

    <section class="container mx-auto px-4 py-12">
      <h2 class="text-3xl font-bold text-center text-green-700 mb-10">Ecodrive en chiffres</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow flex flex-col items-center p-8">
          <span class="text-4xl font-black text-green-600 mb-2">4.3 t</span>
          <span class="text-gray-700 font-semibold text-lg">CO₂ économisées</span>
        </div>
        <div class="bg-white rounded-xl shadow flex flex-col items-center p-8">
          <span class="text-4xl font-black text-green-600 mb-2">2 400+</span>
          <span class="text-gray-700 font-semibold text-lg">Utilisateurs engagés</span>
        </div>
        <div class="bg-white rounded-xl shadow flex flex-col items-center p-8">
          <span class="text-4xl font-black text-green-600 mb-2">170 000 km</span>
          <span class="text-gray-700 font-semibold text-lg">Parcourus proprement</span>
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped>
</style>