<template>
  <div class="min-h-screen bg-gray-100 py-10 font-montserrat">
    <div class="container mx-auto px-4">

      <!-- Breadcrumb -->
      <nav class="mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 text-gray-400 text-sm">
          <li>
            <router-link to="/" class="hover:text-green-600 font-semibold transition-colors">Accueil</router-link>
          </li>
          <li>
            <svg class="w-4 h-4 mx-2 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
          </li>
          <li aria-current="page" class="text-green-700 font-bold">
            Compléter mon profil
          </li>
        </ol>
      </nav>

      <!-- Carte profil -->
      <div class="w-full max-w-lg mx-auto bg-white rounded-2xl shadow-lg border-t-4 border-green-500 p-8">
        <h2 class="text-3xl font-black mb-8 text-green-700 text-left font-montserrat tracking-tight">Compléter mon profil</h2>

        <form @submit.prevent="updateProfile" class="space-y-6">

          <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Date de naissance</label>
            <input
              v-model="form.birthday"
              type="date"
              class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 transition"
              required
            />
          </div>

          <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Genre</label>
            <select
              v-model="form.gender"
              class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 transition"
              required
            >
              <option value="" disabled>-- Choisir --</option>
              <option value="male">Homme</option>
              <option value="female">Femme</option>
              <option value="other">Autre</option>
            </select>
          </div>

          <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Adresse</label>
            <input
              v-model="form.address"
              type="text"
              class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 transition"
              required
            />
          </div>

          <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Rôle</label>
            <select
              v-model="form.role"
              class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 transition"
              required
            >
              <option value="" disabled>-- Choisir un rôle --</option>
              <option value="ROLE_PASSAGER">Passager</option>
              <option value="ROLE_DRIVER">Conducteur</option>
            </select>
          </div>

          <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 transition text-white font-semibold py-3 px-6 rounded-lg w-full shadow-lg text-lg mt-4"
          >
            Mettre à jour
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        birthday: '',
        gender: '',
        address: '',
        role: '',
      },
    }
  },
  async mounted() {
    const res = await fetch('http://localhost:8000/me', {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
    })
    if (res.ok) {
      const data = await res.json()
      this.form.name = data.name || ''
      this.form.birthday = data.birthday || ''
      this.form.gender = data.gender || ''
      this.form.address = data.address || ''
      this.form.role = data.roles?.[0] || ''
    } else {
      this.$router.push('/login')
    }
  },
  methods: {
    async updateProfile() {
      const res = await fetch('http://localhost:8000/me', {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        },
        body: JSON.stringify({
          ...this.form,
          roles: [this.form.role],
        }),
      })
      if (res.ok) {
        this.$router.push('/me')
      } else {
        alert('Erreur lors de la mise à jour')
      }
    },
    logout() {
      localStorage.removeItem('token')
      this.$router.push('/login')
    },
    async deleteAccount() {
      const res = await fetch('http://localhost:8000/delete-account', {
        method: 'DELETE',
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        },
      })
      if (res.ok) {
        localStorage.removeItem('token')
        this.$router.push('/login')
      } else {
        alert('Erreur lors de la suppression du compte')
      }
    },
  },
}
</script>

<style scoped>

</style>