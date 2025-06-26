

<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
      <h1 class="text-3xl font-bold mb-4">Mentions Légales</h1>

      <section class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Éditeur du site</h2>
        <p>
          Raison sociale : <strong>[Nom de l'entreprise]</strong><br />
          Forme juridique : <strong>[SARL/SAS/EURL/etc.]</strong><br />
          Siège social : <strong>[Adresse complète]</strong><br />
          Capital social : <strong>[Montant]</strong><br />
          SIRET : <strong>[Numéro]</strong><br />
          RCS : <strong>[Ville d'immatriculation]</strong><br />
          Représentant légal : <strong>[Nom et prénom]</strong>
        </p>
      </section>

      <section class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Hébergement</h2>
        <p>
          Hébergeur : <strong>[Nom de l'hébergeur]</strong><br />
          Adresse : <strong>[Adresse complète de l'hébergeur]</strong><br />
          Téléphone : <strong>[Numéro de téléphone]</strong>
        </p>
      </section>

      <section class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Propriété intellectuelle</h2>
        <p>
          Le contenu du site (textes, images, graphismes, logo, etc.) est la propriété exclusive de <strong>[Nom de l'entreprise]</strong>, sauf mention contraire.
          Toute reproduction, distribution ou utilisation sans autorisation est strictement interdite.
        </p>
      </section>

      <section>
        <h2 class="text-xl font-semibold mb-2">Données personnelles</h2>
        <p>
          Conformément à la loi « Informatique et Libertés » et au RGPD, vous disposez d’un droit d’accès, de rectification et de suppression des données vous concernant.
          Pour exercer ce droit, contactez : <strong>[Adresse email de contact]</strong>
        </p>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MentionsLegales',
}
</script>