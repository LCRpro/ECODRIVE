<template>
  <div class="h-screen w-full" id="map"></div>
</template>

<script>
export default {
  name: 'Course',
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
        () => {
          alert('Impossible de récupérer la position')
        }
      )
    } else {
      alert('La géolocalisation n’est pas supportée par ce navigateur.')
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