<template>
  <div class="container">
    <h1 class="my-3 ">{{ $t('All Cities') }}</h1>
    <div class="row d-flex">
      <ul >
        <li v-for="city in cities" :key="city.id" class="d-flex">
          <div class="col-6">
            {{ getCurrentCityName(city)}}
          </div>
          <div class="col-4">
          <label>
            <input
              type="checkbox"
              @change="updateCityStatus(city.id)"
              v-model="city.status" class="test"/>
          </label>

        </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import installClient from '../../../http-clients/web/install-client';
import { useI18n } from 'vue-i18n';

export default {
  setup() {
    const cities = ref([]);
    const { t, locale } = useI18n({ useScope: 'global' });

    const fetchCities = async () => {
      try {
        const response = await installClient.getCities();
        cities.value = response.data;
      } catch (error) {
        console.error('Error fetching cities:', error);
      }
    };

    const updateCityStatus = async (cityId) => {
      try {
        // Find the city in the array
        const cityToUpdate = cities.value.find((city) => city.id === cityId);

        // Make an API call to update the status in the database
        await installClient.updateCityStatus(cityId, cityToUpdate.status);

        console.log(`Status for city ${cityToUpdate.name} updated to ${cityToUpdate.status}`);
      } catch (error) {
        console.error(`Error updating status for city with ID ${cityId}:`, error);
      }
    };

    onMounted(fetchCities);

    const getCurrentCityName = (city) => {
      return locale.value === 'ar' ? city.name : city.name_e;
    };

    return {
      cities,
      getCurrentCityName,
      updateCityStatus,
    };
  },
};
</script>

<style>


.test:checked {
  background-color: #4eb529;
}

</style>
