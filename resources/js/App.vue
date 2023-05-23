<template>
    <div class="space-y-7">
      <div class="flex justify-center items-center space-x-4">
        <label for="label">Please Select a City</label>
        <select v-model="selectedCity" @change="loadData" class="border">
          <option value="">Select a city</option>
          <option v-for="city in cities" :value="city" :key="city">{{ city }}</option>
        </select>
      </div>

      <div class="flex justify-center items-center">
        <h2>Weather Forecast Information</h2>
      </div>
      <div class=" flex justify-center items-center overflow-x-auto">
        <table class="w-2/3 text-sm text-left text-gray-500 dark:text-gray-400 shadow-md sm:rounded-lg ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th v-for="header in headers" :key="header" scope="col" class="px-6 py-3">
                  {{ header }}
              </th>
            </tr>
          </thead>
          <tbody v-if="loading">
            <th scope="row" class="px-10 py-4">
              <BeatLoader
              :loading="true"
              :color="'blue'"
              :size="'10px'" />
            </th>
          </tbody>
          <tbody v-else>
            <tr v-if="dataLoaded && rowData" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
              <td v-for="cell in rowData" :key="cell" class="px-6 py-4">
                {{ cell }}
              </td>
            </tr>
            <tr v-else class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white font-bold">
                No city selected.
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>

<script>
  import axios from 'axios';
  import { BeatLoader } from "vue3-spinner";

  export default {
    name: "WeatherForecast",
    components: {
      BeatLoader
    },
    data() {
      return {
        selectedCity: '',
        cities: ['Brisbane', 'Gold Coast', 'Sunshine Coast'],
        headers: ['City', 'Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5'],
        rowData: [],
        loading: false,
        dataLoaded: false,
        api_key: import.meta.env.VITE_WEATHER_API_KEY,
      };
    },
    methods: {
      async loadData() {
        this.loading = true;
        this.rowData = [];

        if (!this.selectedCity) {
          this.dataLoaded = false;
          this.loading = false;
          return;
        }

        try {
          // Get data from API
          const url = `http://api.weatherbit.io/v2.0/forecast/daily?key=${this.api_key}&city=${this.selectedCity}`;
          const response = await axios.get(url);
          const data = response.data;

          // Filter array by slicing next 5 elements.
          let nextFiveDays = data.data.slice(0, 5);
          this.rowData = [data.city_name, ...nextFiveDays.map((day) => {
            return `Avg: ${day.temp}, Max: ${day.max_temp}, Min: ${day.min_temp}`
          })];

          this.dataLoaded = true;
          this.loading = false;
        } catch (error) {
          this.loading = false;
          console.error('Error loading data:', error);
        }
      },
    },
  };
</script>
