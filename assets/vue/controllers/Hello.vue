<template>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="name">Nom du Jouet:</label>
          <input type="text" v-model="toy.name" id="name" required />
        </div>
        <div>
          <label for="description">Description:</label>
          <textarea v-model="toy.description" id="description" required></textarea>
        </div>
        <div>
          <label for="price">Prix:</label>
          <input type="number" v-model="toy.price" id="price" required />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          Créer Jouet
        </button>
      </form>
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
          prix: 0
        }
      };
    },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post('https://votre-api-endpoint.com/toys', this.toy);
          console.log('Toy created successfully:', response.data);
          // Réinitialiser le formulaire après soumission réussie
          this.toy = { name: '', description: '', price: 0 };
        } catch (error) {
          console.error('Error creating toy:', error);
        }
      }
    }
  };
  </script>
  