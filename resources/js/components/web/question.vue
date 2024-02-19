<template>
  <div>
    <div
    class="breadcrumbs d-flex align-items-center"
    style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
   >
    <div
      class="container position-relative d-flex flex-column align-items-center"
      data-aos="fade"
    >
      <ol>
        <li>
          <router-link to="/home">{{ $t("HOME") }}</router-link>
        </li>
        <li>{{ $t("questions") }}</li>
      </ol>
    </div>
  </div>
    <section class="container">
    <div class="row my-5 col-8 mx-auto">
      <div class="accordion" id="accordionExample">
        <div v-for="(question, index) in AllQuestions" :key="question.id">
          <div class="accordion-item my-5">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse' + index" aria-expanded="true"
                :aria-controls="'collapse' + index">

                {{ $i18n.locale === 'ar' ? question.question_ar : question.question_en }}
              </button>
            </h2>
            <div :id="'collapse' + index" class="accordion-collapse collapse" :class="{'show': index === 0}" aria-labelledby="headingOne" data-bs-parent=".accordion">
              <div class="accordion-body">
                <strong>{{ $i18n.locale === 'ar' ? question.answer_ar : question.answer_en }}</strong>
              </div>
            </div>
          </div>
        </div>
      </div>

      <nav>
        <ul class="pagination">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" @click="changePage(currentPage - 1)" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: currentPage === page }"  >
            <a class="page-link" @click="changePage(page)">{{ page }}</a>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <a class="page-link" @click="changePage(currentPage + 1)" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
    </nav>

    </div>

</section>
  </div>
</template>

<script>
import { useI18n } from "vue-i18n";
import { onMounted, ref ,computed} from "vue";
import questionsClient from "../../http-clients/admin/questions-client";

export default {
  setup() {
    const { t, locale } = useI18n({ useScope: "global" });
    const AllQuestions = ref([]);
    const activeIndex = ref(0);
    const itemsPerPage = 10; // Number of items per page
    const currentPage = ref(1);

    const totalQuestions = computed(() => AllQuestions.value.length);
    const totalPages = computed(() => Math.ceil(totalQuestions.value / itemsPerPage));
    const paginatedQuestions = computed(() => {
      const startIndex = (currentPage.value - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      return AllQuestions.value.slice(startIndex, endIndex);
    });

    const getAllQuestions = async () => {
      try {
        const response = await questionsClient.getAllQuestions();
        AllQuestions.value = response.data.questions;
      } catch (error) {
        console.error("Error fetching questions:", error);
      }
    };

    const toggleAccordion = (index) => {
      activeIndex.value = activeIndex.value === index ? -1 : index;
    };

    const changePage = (page) => {
      currentPage.value = page;
    };


    onMounted(() => {
      getAllQuestions();
    });

    return {
      AllQuestions: paginatedQuestions,
      toggleAccordion,
      locale,
      currentPage,
      totalPages,
      changePage,
    };
  },
};
</script>

<style>
.accordion-body{
    color:black;
}
.accordion-button {
    color:black;
}
.accordion-button:hover,:focus-visible{
    color:#5ae4aa;
}
.pagination .page-link {
    background-color:#5ae4aa;
    border-color: #5ae4aa;
    color: #FFFFFF;
  }

  .pagination .page-link:hover {
    background-color: #5ae4aa;
    border-color: #5ae4aa;
    color: #FFFFFF;
  }

  .pagination .page-item.active .page-link {
    background-color: #5ae4aa;
    border-color: #5ae4aa;
    color: #FFFFFF;
  }

</style>

