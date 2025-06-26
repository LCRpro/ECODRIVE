<template>
  <div class="bg-white min-h-screen ">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto  rounded-2xl  p-0 md:p-8">
        <div class="flex flex-col justify-between p-8">
          <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-1 text-gray-400 text-sm">
              <li>
                <router-link to="/" class="hover:text-green-600 font-semibold transition-colors">Accueil</router-link>
              </li>
              <li>
                <svg class="w-4 h-4 mx-2 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
              </li>
              <li aria-current="page" class="text-green-700 font-bold">
                Mentions légales
              </li>
            </ol>
          </nav>

          <header class="mb-10">
            <h1 class="text-5xl font-black tracking-tight text-green-700 mb-1">Mentions légales</h1>
            <p class="text-base text-gray-500 font-medium">Toutes les informations officielles de Ecodrive</p>
          </header>

          <section class="mb-8">
            <h2 class="text-xl font-semibold text-green-600 mb-2">Éditeur du site</h2>
            <ul class="text-gray-700 leading-relaxed space-y-1 ml-3 list-disc marker:text-green-400">
              <li><span class="font-semibold">Raison sociale :</span> Ecodrive</li>
              <li><span class="font-semibold">Forme juridique :</span> Société par actions simplifiée</li>
              <li><span class="font-semibold">Siège social :</span> 22 PLACE HENRI GADEAU DE KERVILLE, 76100 ROUEN France</li>
              <li><span class="font-semibold">Capital social :</span> 10 000 €</li>
              <li><span class="font-semibold">SIRET :</span> 82392759500020</li>
              <li><span class="font-semibold">RCS :</span> RCS de Rouen</li>
              <li><span class="font-semibold">Représentant légal :</span> Liam Cariou</li>
            </ul>
          </section>
          <div class="border-t border-gray-200 my-8"></div>

          <section class="mb-8">
            <h2 class="text-xl font-semibold text-green-600 mb-2">Hébergement</h2>
            <ul class="text-gray-700 leading-relaxed space-y-1 ml-3 list-disc marker:text-green-400">
              <li><span class="font-semibold">Hébergeur :</span> OVH</li>
              <li><span class="font-semibold">Adresse :</span> 2 rue Kellermann, 59100 Roubaix, France</li>
            </ul>
          </section>
          <div class="border-t border-gray-200 my-8"></div>

          <section class="mb-8">
            <h2 class="text-xl font-semibold text-green-600 mb-2">Propriété intellectuelle</h2>
            <p class="text-gray-700 leading-relaxed ml-3">
              Le contenu du site (textes, images, graphismes, logo, etc.) est la propriété exclusive de <span class="font-semibold">Ecodrive</span>, sauf mention contraire.
              Toute reproduction, distribution ou utilisation sans autorisation est strictement interdite.
            </p>
          </section>
          <div class="border-t border-gray-200 my-8"></div>

          <section>
            <h2 class="text-xl font-semibold text-green-600 mb-2">Données personnelles</h2>
            <p class="text-gray-700 leading-relaxed ml-3">
              Conformément à la loi « Informatique et Libertés » et au RGPD, vous disposez d’un droit d’accès, de rectification et de suppression des données vous concernant.
              Pour exercer ce droit, contactez : <span class="font-semibold">cariou.liam[a]orange.fr</span>
            </p>
          </section>
        </div>
        <div class="flex items-center justify-center p-8">
          <img 
            src="/logo-ecodrive.png" 
            alt="Illustration Ecodrive" 
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