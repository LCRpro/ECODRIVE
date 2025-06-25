<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Compléter mon profil</h2>

      <form @submit.prevent="updateProfile" class="space-y-4">
   

        <div>
          <label class="block text-sm font-medium text-gray-700">Date de naissance</label>
          <input
            v-model="form.birthday"
            type="date"
            class="w-full mt-1 border rounded p-2 focus:outline-none focus:ring focus:ring-green-500"
            required
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Genre</label>
          <select
            v-model="form.gender"
            class="w-full mt-1 border rounded p-2 focus:outline-none focus:ring focus:ring-green-500"
            required
          >
            <option value="" disabled>-- Choisir --</option>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
            <option value="other">Autre</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Adresse</label>
          <input
            v-model="form.address"
            type="text"
            class="w-full mt-1 border rounded p-2 focus:outline-none focus:ring focus:ring-green-500"
            required
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Rôle</label>
          <select
            v-model="form.role"
            class="w-full mt-1 border rounded p-2 focus:outline-none focus:ring focus:ring-green-500"
            required
          >
            <option value="" disabled>-- Choisir un rôle --</option>
            <option value="ROLE_PASSAGER">Passager</option>
            <option value="ROLE_DRIVER">Conducteur</option>
          </select>
        </div>

        <button
          type="submit"
          class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded w-full"
        >
          Mettre à jour
        </button>
      </form>

      <hr class="my-6" />

     
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