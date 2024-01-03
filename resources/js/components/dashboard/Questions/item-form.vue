<template>
    <div class="container">
        <div
        v-if="!usedAsComponent"
        class="page-header border"
        style="margin-top: 10px"
      >
      <div class="col-md-6 col-sm-12">
        <div class="head-title ">
          {{ $t("questions") }}
        </div>
    </div>
    </div>
        <div class="row justify-content-center my-5">
           <div class="col-md-10">
               <div class="card mt-5">
                   <div class="card-body">
                <form  @submit.prevent="submitForm()" method="post" class="feedback-form">

               <div class="form-group my-3">
                   <label for="point1" class="form-label">
                    {{ $t("Question")}}
                    </label>
                   <input type="text" v-model="form.question_ar" class="form-control" required>
               </div>

               <div class="form-group my-3">
                <label for="point1" class="form-label">
                 {{ $t("Question")}}
                 </label>
                <input type="text" v-model="form.question_en" class="form-control" required>
            </div>

               <div class="form-group my-3">
                <label for="point2" class="form-label">
                 {{ $t("Answer")}}
                </label>
                <input type="text" v-model="form.answer_ar" class="form-control"  required>
                </div>

               <div class="form-group my-3">
                   <label for="point2" class="form-label">
                    {{ $t("Answer")}}
                   </label>
                   <input type="text" v-model="form.answer_en" class="form-control"  required>
               </div>


               <div class="text-center">
               <button class="btn btn-secondary" type="submit">
                {{ $t("submit")}}
               </button>
               </div>
           </form>
           </div>
           </div>
           </div>
        </div>
       </div>
</template>

<script>
import { onMounted,ref } from "vue";
import { useI18n } from "vue-i18n";
import questionsClient from "../../../http-clients/admin/questions-client.js";
import { toast } from "vue3-toastify";

export default {

setup(){
    const { t, locale } = useI18n({ useScope: "global" });
    const form=ref({
        question_ar:"",
        question_en:"",
        answer_ar:"",
        answer_en:"",
    });


    const submitForm = async () => {
      try {
        console.log(form.value);
        const response = await questionsClient.store(form.value);
        console.log('Question submitted successfully:', response);
        toast.success(t("CREATED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
        form.value = "";

      } catch (error) {
        console.error('Error submitting question:', error);
      }
    };

    return{
        form,
        submitForm,
    };
}

}
</script>

<style>

</style>
