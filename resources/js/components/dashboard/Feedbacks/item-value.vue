<template>
    <div class="container">
        <div
        v-if="!usedAsComponent"
        class="page-header border"
        style="margin-top: 10px"
      >
        <div class="col-md-6 col-sm-12">
            <div class="head-title">
              {{ $t("All Feedbacks") }}
            </div>
          </div>
        </div>
      <div class="table-responsive">
        <table class="table" id="feedbackTable">
          <thead>
            <tr>
              <th scope="col">{{ $t("Point 1") }}</th>
              <th scope="col">{{ $t("Point 2") }}</th>
              <th scope="col">{{ $t("Point 3") }}</th>
              <th scope="col">{{ $t("Point 4") }}</th>
              <th scope="col">{{ $t("Comments") }}</th>
              <th scope="col">{{ $t("name") }}</th>
            </tr>
          </thead>
          <tbody v-if="feedbackList.length">
            <tr v-for="(feedback, index) in feedbackList" :key="feedback.id">
              <td>{{ feedback.point1 }}</td>
              <td>{{ feedback.point2 }}</td>
              <td>{{ feedback.point3 }}</td>
              <td>{{ feedback.point4 }}</td>
              <td>{{ feedback.comments }}</td>
              <td>{{ feedback.install ? feedback.install.name : 'No Name' }}</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td class="no-result" colspan="6">{{ $t("No feedback available") }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import feedbackClient from "../../../http-clients/web/feedback-client.js";
  import { useI18n } from "vue-i18n";

  export default {
    setup() {
    const { t, locale } = useI18n({ useScope: "global" });

      const feedbackList = ref([]);

      const getAllFeedback = async () => {
        try {
          const response = await feedbackClient.getfeedbacks();
          feedbackList.value = response.data.feedbacks;
          console.log(feedbackList.value)
        } catch (error) {
          console.error('Error fetching feedback:', error);
        }
      };

      onMounted(getAllFeedback);

      return {
        feedbackList,
      };
    },
  };
  </script>

  <style scoped>
  /* Add your component styles here */
  </style>
