<template>
  <div class=" min-h-screen py-10 font-montserrat">
    <div class="container mx-auto px-4">

      <nav class="mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 text-gray-400 text-sm">
          <li>
            <router-link to="/" class="hover:text-green-600 font-semibold transition-colors">Accueil</router-link>
          </li>
          <li>
            <svg class="w-4 h-4 mx-2 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
          </li>
          <li aria-current="page" class="text-green-700 font-bold">
            Mon profil
          </li>
        </ol>
      </nav>

      <div class="max-w-xl mx-auto rounded-2xl shadow-lg bg-gradient-to-r from-green-100 via-green-50 to-white p-8 flex flex-col items-center mb-10 border border-green-100">
        <div class="relative mb-4">
          <img
            :src="me?.avatar || '/assets/avatar.svg'"
            alt="Avatar"
            class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover bg-white"
          />
          <button
            @click="showEdit = true"
            class="absolute bottom-0 right-0 bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow hover:bg-green-700 transition"
            title="Modifier mon profil"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-2.121.879l-2.828.707.707-2.828a4 4 0 01.879-2.121z"/>
            </svg>
          </button>
        </div>
        <h1 class="text-3xl font-black text-green-700 mb-1 tracking-tight">{{ me?.name || "Utilisateur" }}</h1>
        <p class="text-gray-600 font-medium mb-1">{{ me?.email }}</p>
        <div class="flex gap-4 mt-2">
          <span class="inline-flex items-center text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full font-semibold">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
            Ecodriver vérifié
          </span>
          <span v-if="me?.roles?.[0]" class="inline-flex items-center text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-semibold capitalize">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
            {{ roleLabel(me?.roles?.[0]) }}
          </span>
        </div>
      </div>

      <div class="max-w-xl mx-auto grid grid-cols-3 gap-4 mb-10">
        <div class="bg-white rounded-xl shadow flex flex-col items-center py-4">
          <span class="text-lg font-bold text-green-600">12 500 km</span>
          <span class="text-gray-500 text-xs">Parcourus</span>
        </div>
        <div class="bg-white rounded-xl shadow flex flex-col items-center py-4">
          <span class="text-lg font-bold text-green-600">42</span>
          <span class="text-gray-500 text-xs">Trajets</span>
        </div>
        <div class="bg-white rounded-xl shadow flex flex-col items-center py-4">
          <span class="text-lg font-bold text-green-600">3.1 t</span>
          <span class="text-gray-500 text-xs">CO₂ économisées</span>
        </div>
      </div>

      <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg p-8 border-t-4 border-green-500">
        <h2 class="text-2xl font-extrabold text-green-700 mb-4 font-montserrat">Mes informations</h2>
        <div class="divide-y divide-green-50">
          <div class="py-4 flex items-center">
            <span class="w-24 text-gray-600 font-medium">Nom</span>
            <input :value="me?.name" type="text" disabled
              class="flex-1 border-0 rounded px-3 py-2 bg-gray-100 text-gray-700 shadow-inner hover:ring-2 hover:ring-green-100 transition" />
          </div>
          <div class="py-4 flex items-center">
            <span class="w-24 text-gray-600 font-medium">Email</span>
            <input :value="me?.email" type="text" disabled
              class="flex-1 border-0 rounded px-3 py-2 bg-gray-100 text-gray-700 shadow-inner hover:ring-2 hover:ring-green-100 transition" />
          </div>
          <div class="py-4 flex items-center">
            <span class="w-24 text-gray-600 font-medium">Naissance</span>
            <input :value="me?.birthday" type="text" disabled
              class="flex-1 border-0 rounded px-3 py-2 bg-gray-100 text-gray-700 shadow-inner hover:ring-2 hover:ring-green-100 transition" />
          </div>
          <div class="py-4 flex items-center">
            <span class="w-24 text-gray-600 font-medium">Genre</span>
            <input :value="displayGender(me?.gender)" type="text" disabled
              class="flex-1 border-0 rounded px-3 py-2 bg-gray-100 text-gray-700 shadow-inner hover:ring-2 hover:ring-green-100 transition" />
          </div>
          <div class="py-4 flex items-center">
            <span class="w-24 text-gray-600 font-medium">Adresse</span>
            <input :value="me?.address" type="text" disabled
              class="flex-1 border-0 rounded px-3 py-2 bg-gray-100 text-gray-700 shadow-inner hover:ring-2 hover:ring-green-100 transition" />
          </div>
          <div class="py-4 flex items-center">
            <span class="w-24 text-gray-600 font-medium">Rôle</span>
            <input :value="roleLabel(me?.roles?.[0])" type="text" disabled
              class="flex-1 border-0 rounded px-3 py-2 bg-gray-100 text-gray-700 shadow-inner hover:ring-2 hover:ring-green-100 transition capitalize" />
          </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3 justify-end">
          <button @click="showEdit = true"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2 rounded-lg font-semibold shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-2.121.879l-2.828.707.707-2.828a4 4 0 01.879-2.121z"/></svg>
            Modifier
          </button>
          <button @click="logout"
            class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 transition text-white px-5 py-2 rounded-lg font-semibold shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
            Déconnexion
          </button>
          <button @click="deleteAccount"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 transition text-white px-5 py-2 rounded-lg font-semibold shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
            Supprimer
          </button>
        </div>
      </div>

      <div v-if="showEdit" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full relative animate-fadeIn overflow-hidden">
          <div class="bg-green-600 text-white px-8 py-4 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
            <h2 class="text-xl font-bold font-montserrat">Modifier mon profil</h2>
          </div>
          <form @submit.prevent="updateProfile" class="space-y-5 px-8 py-6">
            <div>
              <label class="block text-gray-600 font-medium mb-1">Date de naissance</label>
              <input v-model="form.birthday" type="date" class="w-full border border-gray-300 rounded px-3 py-2 focus:border-green-500 focus:ring-green-100 focus:ring-2" />
            </div>
            <div>
              <label class="block text-gray-600 font-medium mb-1">Genre</label>
              <select v-model="form.gender" class="w-full border border-gray-300 rounded px-3 py-2 focus:border-green-500 focus:ring-green-100 focus:ring-2">
                <option value="">-- Choisir --</option>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
                <option value="other">Autre</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-600 font-medium mb-1">Adresse</label>
              <input v-model="form.address" type="text" class="w-full border border-gray-300 rounded px-3 py-2 focus:border-green-500 focus:ring-green-100 focus:ring-2" />
            </div>
            <div>
              <label class="block text-gray-600 font-medium mb-1">Rôle</label>
              <select v-model="form.roles" class="w-full border border-gray-300 rounded px-3 py-2 focus:border-green-500 focus:ring-green-100 focus:ring-2">
                <option disabled value="">-- Choisir un rôle --</option>
                <option value="ROLE_PASSAGER">Passager</option>
                <option value="ROLE_DRIVER">Conducteur</option>
              </select>
            </div>
            <div class="flex justify-between mt-8">
              <button type="submit" class="bg-green-600 hover:bg-green-700 transition text-white px-5 py-2 rounded-lg font-semibold">Enregistrer</button>
              <button type="button" @click="showEdit = false" class="bg-gray-400 hover:bg-gray-500 transition text-white px-5 py-2 rounded-lg font-semibold">Annuler</button>
            </div>
          </form>
          <button @click="showEdit = false" class="absolute top-2 right-2 bg-gray-200 hover:bg-gray-400 text-gray-600 rounded-full w-8 h-8 flex items-center justify-center text-xl font-bold shadow">&times;</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script>


export default {
  data() {
    return {
      me: null,
      showEdit: false,
      form: {
        name: '',
        birthday: '',
        gender: '',
        address: '',
        roles: '',
      },
    }
  },
  async mounted() {
    await this.fetchMe()
  },

  methods: {
    roleLabel(role) {
      if (role === 'ROLE_DRIVER') return 'Conducteur';
      if (role === 'ROLE_PASSAGER') return 'Passager';
      return role || '-';
    },
      displayGender(gender) {
    if (gender === 'male') return 'Homme';
    if (gender === 'female') return 'Femme';
    if (gender === 'other') return 'Autre';
    return gender || '-';
  },
    async fetchMe() {
      const token = localStorage.getItem('token')
      const res = await fetch('http://localhost:8000/me', {
        headers: { Authorization: 'Bearer ' + token },
      })
      const data = await res.json()
      this.me = data
      this.form.name = data.name || ''
      this.form.birthday = data.birthday || ''
      this.form.gender = data.gender || ''
      this.form.address = data.address || ''
      this.form.roles = Array.isArray(data.roles) ? data.roles[0] || '' : ''
    },
    async updateProfile() {
      const payload = {
        ...this.form,
        roles: [this.form.roles],
      }

      const res = await fetch('http://localhost:8000/me', {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        },
        body: JSON.stringify(payload),
      })

      if (res.ok) {
        alert('Profil mis à jour')
        this.showEdit = false
        await this.fetchMe()
      } else {
        alert('Erreur lors de la mise à jour')
      }
    },
    logout() {
      localStorage.removeItem('token')
      this.$router.push('/login')
    },
    async deleteAccount() {
      const token = localStorage.getItem('token')
      await fetch('http://localhost:8000/delete-account', {
        method: 'DELETE',
        headers: { Authorization: 'Bearer ' + token },
      })
      this.logout()
    },
  },
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap');
.font-montserrat {
  font-family: 'Montserrat', 'Segoe UI', Arial, sans-serif;
}
.animate-fadeIn {
  animation: fadeIn .2s;
}
@keyframes fadeIn {
  from { opacity:0; transform: translateY(16px);}
  to { opacity:1; transform: translateY(0);}
}
</style>