<template>
    <div class="mt-8 overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Nom
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Description
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Prix
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="toy in toys" :key="toy.id">
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ toy.nom }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ toy.description }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ toy.prix }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      toys: {
        type: Array,
        required: true
      },
      fetchToys: {
        type: Function,
        required: true
      }
    }
  };
  </script>
  