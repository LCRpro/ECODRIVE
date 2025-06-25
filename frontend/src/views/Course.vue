<template>
  <div class="h-screen w-full" id="map"></div>
  <div
    v-if="showLocationError"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
  >
    <div class="bg-white p-6 rounded shadow-md text-center max-w-md w-full">
      <h2 class="text-xl font-bold mb-4">Accès à la localisation requis</h2>
      <p class="mb-4">
        Pour utiliser le service ECODRIVE, vous devez autoriser l’accès à votre position.
      </p>
      <a
        href="https://support.google.com/chrome/answer/142065?hl=fr"
        target="_blank"
        class="text-blue-600 underline"
      >
        Comment autoriser la géolocalisation ?
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Course',
  data() {
    return {
      showLocationError: false,
    }
  },
  mounted() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const lat = position.coords.latitude
          const lng = position.coords.longitude

          const map = L.map('map').setView([lat, lng], 15)

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
          }).addTo(map)

          L.marker([lat, lng]).addTo(map).bindPopup('Vous êtes ici').openPopup()
        },
        (error) => {
          this.showLocationError = true
        }
      )
    } else {
      this.showLocationError = true
    }
  },
}
</script>

<style>
#map {
  height: 100vh;
  width: 100%;
}
</style>