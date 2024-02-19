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
        <table class="table table-bordered" id="feedbackTable">
          <thead>
            <tr>
              <th scope="col">{{ $t("Punctuality") }}</th>
              <th scope="col">{{ $t("installation programming and training") }}</th>
              <th scope="col">{{ $t("Employee Style") }}</th>
              <th scope="col">{{ $t("Work cleanliness") }}</th>
              <th scope="col">{{ $t("Notes") }}</th>
              <th scope="col">{{ $t("Client_name") }}</th>
            </tr>
          </thead>

          <tbody v-if="feedbackList.length">
            <tr v-for="(feedback, index) in feedbackList" :key="feedback.id">
              <td>{{ feedback.point1 }}</td>
              <td>{{ feedback.point2 }}</td>
              <td>{{ feedback.point3 }}</td>
              <td>{{ feedback.point4 }}</td>
              <td>{{ feedback.comments }}</td>
              <td>{{ feedback.install_name ? feedback.install_name : 'No Name' }}</td>

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

  </style>
