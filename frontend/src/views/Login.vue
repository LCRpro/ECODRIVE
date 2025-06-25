<template>
  <div class="flex flex-col items-center justify-center min-h-screen p-4">
    <h1 class="text-3xl font-bold mb-6">Connexion</h1>
    <div id="g_id_signin"></div>
  </div>
</template>

<script>
export default {
  mounted() {
    window.google.accounts.id.initialize({
      client_id: '270305609094-u1rgafse5f6q2sdqamnoovnqi6k7c804.apps.googleusercontent.com',
      callback: this.handleCredentialResponse,
    });

    window.google.accounts.id.renderButton(
      document.getElementById('g_id_signin'),
      {
        theme: 'outline',
        size: 'large',
        text: 'signin_with',
      }
    );
  },
  methods: {
   async handleCredentialResponse(response) {
  const res = await fetch('http://localhost:8000/auth/google', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id_token: response.credential }),
  });

  const data = await res.json();
  if (data.token) {
    localStorage.setItem('token', data.token);

    const meRes = await fetch('http://localhost:8000/me', {
      headers: { Authorization: `Bearer ${data.token}` },
    });

    if (!meRes.ok) {
      alert("Erreur lors de la récupération du profil");
      return;
    }

    const me = await meRes.json();

    if (!me.birthday || !me.gender || !me.address) {
      this.$router.push('/profile/complete');
    } else {
      this.$router.push('/me');
    }
  } else {
    alert('Échec de la connexion');
  }
},
  },
};
</script>