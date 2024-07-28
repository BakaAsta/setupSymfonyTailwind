<template>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="nom">Nom du Jouet:</label>
          <input type="text" v-model="toy.nom" id="nom" required class="border p-2 rounded" />
        </div>
        <div>
          <label for="description">Description:</label>
          <textarea v-model="toy.description" id="description" required class="border p-2 rounded"></textarea>
        </div>
        <div>
          <label for="prix">Prix:</label>
          <input type="number" v-model="toy.prix" id="prix" required class="border p-2 rounded" />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
          Créer Jouet
        </button>
      </form>
  
      <!-- Flash Message -->
      <div v-if="flashMessage" class="mt-4 p-4 bg-green-100 text-green-800 border border-green-400 rounded">
        {{ flashMessage }}
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        toy: {
          nom: '',
          description: '',
          prix: 10
        },
        flashMessage: '' // Initialize flash message
      };
    },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post(
            'https://127.0.0.1:8000/api/jouets',
            this.toy,
            {
              headers: {
                'Content-Type': 'application/ld+json'
              }
            }
          );
          console.log('Toy created successfully:', response.data);
          // Set flash message on successful submission
          this.flashMessage = 'Le jouet a été créé avec succès!';
          // Clear flash message after 3 seconds
          setTimeout(() => {
            this.flashMessage = '';
          }, 3000);
          // Réinitialiser le formulaire après soumission réussie
          this.toy = { nom: '', description: '', prix: 10 };
        } catch (error) {
          console.error('Error creating toy:', error);
        }
      }
    }
  };
  </script>
  