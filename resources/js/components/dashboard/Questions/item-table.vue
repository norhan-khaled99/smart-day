<template>
  <div class="container">
     <div class="row page-header border align-items-baseline">
        <div class="col-md-6 col-sm-12">
            <div class="head-title ">
              {{ $t("questions") }}
            </div>
        </div>
        <div class="col-md-6 col-sm-12 text-right ">
            <router-link
              class="btn create-btn date-header"
              :to="`/admin/Add-questions`"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-plus"
              >
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              <span>
                {{ locale === 'ar' ? $t("اضافة سؤال") : $t("Add Question") }}

              </span>
            </router-link>
        </div>

     </div>

     <div class="table-responsive">
        <table class="table table-bordered" id="feedbackTable">
          <thead>
            <tr>
              <th scope="col">{{ $t("Question Arabic")}}</th>
              <th scope="col">{{ $t("Question English")}}</th>
              <th scope="col">{{ $t("Answer Arabic")}}</th>
              <th scope="col">{{ $t("Answer English") }}</th>
              <th scope="col">{{ $t("ACTIONS") }}</th>
            </tr>
          </thead>
          <tbody v-if="QuestionList.length">
            <tr v-for="(question) in QuestionList" :key="question.id">
              <td>{{ question.question_ar }}</td>
              <td>{{ question.question_en }}</td>
              <td>{{ question.answer_ar }}</td>
              <td>{{ question.answer_en }}</td>
              <td> <button @click="deleteQuestion(question.id)" class="btn btn-danger">
                {{ locale === 'ar' ? $t("حذف") : $t("Delete") }}
            </button></td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td class="no-result" colspan="5">{{ $t("No Questions available") }}</td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import questionsClient from "../../../http-clients/admin/questions-client.js";
import { useI18n } from "vue-i18n";
import { toast } from "vue3-toastify";

export default {
  setup() {
  const { t, locale } = useI18n({ useScope: "global" });

    const QuestionList = ref([]);

    const getAllQuestions = async () => {
      try {
        const response = await questionsClient.getAllQuestions();
        QuestionList.value = response.data.questions;
      } catch (error) {
        console.error('Error fetching Questions:', error);
      }
    };

    const deleteQuestion = async (questionId) => {
            try {
                console.log(questionId)
                await questionsClient.deleteQuestions(questionId);
                toast.success(t("DELETED_SUCCESSFULLY"), {
                autoClose: 2000,
                position: "top-center",
          });
                getAllQuestions();
            } catch (error) {
                console.error('Error deleting question:', error);
            }
        };

    onMounted(getAllQuestions());

    return {
        QuestionList,
        deleteQuestion,
        locale,
    };
  },
};
</script>

<style scoped>
/* Add your component styles here */
</style>
