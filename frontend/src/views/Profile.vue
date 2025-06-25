<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Mes informations</h1>
    <pre class="bg-gray-100 p-4 rounded">{{ me }}</pre>
    <div class="mt-4 flex gap-4">
      <button @click="logout" class="bg-gray-600 text-white px-4 py-2 rounded">Déconnexion</button>
      <button @click="deleteAccount" class="bg-red-600 text-white px-4 py-2 rounded">Supprimer le compte</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return { me: null }
  },
  async mounted() {
    const token = localStorage.getItem('token')
    const res = await fetch('http://localhost:8000/me', {
      headers: { Authorization: 'Bearer ' + token },
    })
    this.me = await res.json()
  },
  methods: {
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