<template>
  <div class="login-page">
    <h1>Connexion Google</h1>
    <div id="g_id_onload"
         :data-client_id="clientId"
         data-context="signin"
         data-ux_mode="popup"
         data-callback="handleCredentialResponse">
    </div>
    <div class="g_id_signin"
         data-type="standard"
         data-shape="rectangular"
         data-theme="outline"
         data-text="signin_with"
         data-size="large"
         data-logo_alignment="left">
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

const clientId = '270305609094-u1rgafse5f6q2sdqamnoovnqi6k7c804.apps.googleusercontent.com' 

// Callback global pour Google
window.handleCredentialResponse = async (response) => {
const id_token = response.credential

const res = await fetch('http://localhost:8000/auth/google', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ id_token })
})

const data = await res.json()
  console.log('Réponse backend :', data)

  if (res.ok && data.token) {
    localStorage.setItem('token', data.token)
    alert('Connexion réussie !')
  } else {
    alert('Échec de la connexion')
  }
}

onMounted(() => {
  const script = document.createElement('script')
  script.src = 'https://accounts.google.com/gsi/client'
  script.async = true
  script.defer = true
  document.head.appendChild(script)
})
</script>

<style scoped>
.login-page {
  max-width: 400px;
  margin: 100px auto;
  text-align: center;
}
</style>