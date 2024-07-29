<template>
    <div class="container mx-auto p-4">
      <!-- Bouton Ajouter un jouet -->
      <button @click="showSidebar = true" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Ajouter un jouet
      </button>
  
      <!-- Sidebar -->
      <transition name="slide">
        <div v-if="showSidebar" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-end">
          <div class="bg-white w-full md:w-1/3 p-6 h-full shadow-xl">
            <button @click="showSidebar = false" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded">
              X
            </button>
            <div class="form_area">
              <p class="title">Ajouter un Jouet</p>
              <form class="w-3/4" @submit.prevent="submitForm">
                <div class="form_group">
                  <v-text-field label="Label" variant="outlined"></v-text-field>
                  <label class="sub_title" for="nom">Nom du Jouet</label>
                  <input v-model="toy.nom" placeholder="Nom du jouet" class="form_style w-full" type="text" id="nom" required />
                </div>
                <div class="form_group">
                  <label class="sub_title" for="description">Description</label>
                  <textarea v-model="toy.description" placeholder="Description du jouet" class="form_style w-full" id="description" required></textarea>
                </div>
                <div class="form_group">
                  <label class="sub_title" for="prix">Prix</label>
                  <input v-model="toy.prix" placeholder="Prix du jouet" class="form_style w-full" type="number" id="prix" required />
                </div>
                <button type="submit" class="btn bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded w-full">
                  Créer Jouet
                </button>
              </form>
              <!-- Flash Message -->
              <div v-if="flashMessage" class="mt-4 p-4 bg-green-100 text-green-800 border border-green-400 rounded">
                {{ flashMessage }}
              </div>
            </div>
          </div>
        </div>
      </transition>
  
      <!-- Toys Table Component -->
      <div class="w-full">
        <toys-table :toys="toys" :fetchToys="fetchToys"></toys-table>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import ToysTable from './vue/controllers/Tabs.vue';
  
  export default {
    components: {
      ToysTable
    },
    data() {
      return {
        showSidebar: false, // State for sidebar visibility
        toy: {
          nom: '',
          description: '',
          prix: 10
        },
        flashMessage: '', // Initialize flash message
        toys: [] // Initialize toys array
      };
    },
    mounted() {
      this.fetchToys(); // Fetch toys when the component mounts
    },
    methods: {
      async fetchToys() {
        try {
          const response = await axios.get('https://127.0.0.1:8000/api/jouets');
          this.toys = response.data['hydra:member']; // Adjust based on your API response structure
        } catch (error) {
          console.error('Error fetching toys:', error);
        }
      },
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
          // Refresh the toys list
          this.fetchToys();
          // Hide the sidebar
          this.showSidebar = false;
        } catch (error) {
          console.error('Error creating toy:', error);
        }
      }
    }
  };
  </script>
  
  <style>
  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
  }
  .form_area {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #EDDCD9;
    height: auto;
    width: auto;
    border: 2px solid #264143;
    border-radius: 20px;
    box-shadow: 3px 4px 0px 1px #E99F4C;
  }
  .title {
    color: #264143;
    font-weight: 900;
    font-size: 1.5em;
    margin-top: 20px;
  }
  .sub_title {
    font-weight: 600;
    margin: 5px 0;
  }
  .form_group {
    display: flex;
    flex-direction: column;
    align-items: baseline;
    margin: 10px;
  }
  .form_style {
    outline: none;
    border: 2px solid #264143;
    box-shadow: 3px 4px 0px 1px #E99F4C;
    width: 100%;
    padding: 12px 10px;
    border-radius: 4px;
    font-size: 15px;
  }
  .form_style:focus, .btn:focus {
    transform: translateY(4px);
    box-shadow: 1px 2px 0px 0px #E99F4C;
  }
  .btn {
    padding: 15px;
    margin: 25px 0px;
    width: 100%;
    font-size: 15px;
    background: #DE5499;
    border-radius: 10px;
    font-weight: 800;
    box-shadow: 3px 3px 0px 0px #E99F4C;
  }
  .btn:hover {
    opacity: .9;
  }
  .link {
    font-weight: 800;
    color: #264143;
    padding: 5px;
  }
  </style>
  