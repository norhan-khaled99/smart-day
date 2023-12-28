<template>
 
  <router-view />
</template>
<script>
import { onMounted } from 'vue';

export default {
  components: {
  },
  setup() {
    onMounted(()=>{
      localStorage.removeItem("protectionTypeValues");
      localStorage.removeItem("premiseTypeValue");
      localStorage.removeItem("premiseFeatures");
      localStorage.removeItem("currentStep");
    })
  },
};
</script>
<style lang="scss">
</style>