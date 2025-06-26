<template>
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white bg-opacity-90 rounded-2xl shadow-lg max-w-md w-full p-8 flex flex-col items-center">
      <h1 class="text-3xl md:text-4xl font-black text-green-700 mb-8 font-montserrat tracking-tight">Connexion</h1>
      <p class="text-gray-600 mb-6 text-center">Connecte-toi pour rejoindre la communauté Ecodrive.</p>
      <div id="g_id_signin" class="w-full flex justify-center"></div>
    </div>
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
        width: 300,
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

<style scoped>

</style>