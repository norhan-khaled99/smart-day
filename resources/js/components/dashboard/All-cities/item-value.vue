<template>
  <div class="container">
    <div
    v-if="!usedAsComponent"
    class="page-header border"
    style="margin-top: 10px"
  >
    <div class="col-md-6 col-sm-12">
        <div class="head-title">
          {{ $t("All Cities") }}
        </div>
      </div>
    </div>




    <div class="row d-flex px-3">
      <ul >
        <li v-for="city in cities" :key="city.id" class="d-flex">
          <div class="col-8 ">
            <div class="">
            {{ getCurrentCityName(city)}}
          </div>
          </div>
          <div class="col-4">
          <label>
            <input
              type="checkbox"
              @change="updateCityStatus(city.id)"
              v-model="city.status" />
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
import { toast } from "vue3-toastify";

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
        const cityToUpdate = cities.value.find((city) => city.id === cityId);
        await installClient.updateCityStatus(cityId, cityToUpdate.status);
        toast.success(t("UPDATED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
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

