<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Mes informations</h1>
    <pre class="bg-gray-100 p-4 rounded">{{ me }}</pre>

    <div class="mt-4 flex gap-4">
      <button @click="showEdit = true" class="bg-blue-600 text-white px-4 py-2 rounded">
        Modifier mes infos
      </button>
      <button @click="logout" class="bg-gray-600 text-white px-4 py-2 rounded">Déconnexion</button>
      <button @click="deleteAccount" class="bg-red-600 text-white px-4 py-2 rounded">Supprimer le compte</button>
    </div>

    <!-- Modal -->
    <div v-if="showEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded p-6 max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Modifier mon profil</h2>
        <form @submit.prevent="updateProfile" class="space-y-4">

          <div>
            <label class="block text-gray-700">Date de naissance</label>
            <input v-model="form.birthday" type="date" class="w-full border rounded p-2" />
          </div>

          <div>
            <label class="block text-gray-700">Genre</label>
            <select v-model="form.gender" class="w-full border rounded p-2">
              <option value="">-- Choisir --</option>
              <option value="male">Homme</option>
              <option value="female">Femme</option>
              <option value="other">Autre</option>
            </select>
          </div>

          <div>
            <label class="block text-gray-700">Adresse</label>
            <input v-model="form.address" type="text" class="w-full border rounded p-2" />
          </div>

          <div>
            <label class="block text-gray-700">Rôle</label>
            <select v-model="form.roles" class="w-full border rounded p-2">
              <option disabled value="">-- Choisir un rôle --</option>
              <option value="ROLE_PASSAGER">Passager</option>
              <option value="ROLE_DRIVER">Conducteur</option>
            </select>
          </div>

          <div class="flex justify-between mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Enregistrer</button>
            <button type="button" @click="showEdit = false" class="bg-gray-400 text-white px-4 py-2 rounded">Annuler</button>
          </div>
        </form>
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