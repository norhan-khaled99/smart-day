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
                    {{ $t("Question Arabic")}}
                    </label>
                   <input type="text" v-model="form.question_ar"
                   :class="{
                    'is-invalid': v$.question_ar.$error,
                  }"
                   class="form-control" >
                   <div v-for="error in v$.question_ar.$errors" :key="error">
                    {{ $t("Question Arabic") + " " + $t(error.$validator) }}
                </div>

               </div>

               <div class="form-group my-3">
                <label for="point1" class="form-label">
                 {{ $t("Question English")}}
                 </label>
                <input type="text" v-model="form.question_en"
                :class="{
                    'is-invalid': v$.question_en.$error,
                  }"
                class="form-control" >
                <div v-for="error in v$.question_en.$errors" :key="error">
                    {{ $t("Question English") + " " + $t(error.$validator) }}
                </div>
            </div>

               <div class="form-group my-3">
                <label for="point2" class="form-label">
                 {{ $t("Answer Arabic")}}
                </label>
                <input type="text" v-model="form.answer_ar"
                :class="{
                    'is-invalid': v$.answer_ar.$error,
                  }"
                class="form-control"  >
                <div v-for="error in v$.answer_ar.$errors" :key="error">
                    {{ $t("Answer Arabic") + " " + $t(error.$validator) }}
                </div>
                </div>

               <div class="form-group my-3">
                   <label for="point2" class="form-label">
                    {{ $t("Answer English")}}
                   </label>
                   <input type="text" v-model="form.answer_en"
                   :class="{
                    'is-invalid': v$.answer_en.$error,
                  }"
                   class="form-control" >

                   <div v-for="error in v$.answer_en.$errors" :key="error">
                    {{ $t("Answer English") + " " + $t(error.$validator) }}
                </div>
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
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import questionsClient from "../../../http-clients/admin/questions-client.js";
import { toast } from "vue3-toastify";
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
export default {

setup(){
    const { t, locale } = useI18n({ useScope: "global" });
    const form=ref({
        question_ar:"",
        question_en:"",
        answer_ar:"",
        answer_en:"",
    });

    const rules={
        question_ar:{required},
        question_en:{required},
        answer_ar:{required},
        answer_en:{required},
    };

    const v$ = useVuelidate(rules, form);

    const submitForm = async () => {
        if (v$.value.$invalid) {
            v$.value.$touch();
            return;
        }
      try {
        const response = await questionsClient.store(form.value);
        v$.value.$reset();
        form.question_ar="",
        form.question_en="",
        form.answer_ar="",
        form.answer_en="",

        toast.success(t("CREATED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
          router.push("/")
        form.value = "";

      } catch (error) {
        console.error('Error submitting question:', error);
      }
    };

    return{
        form,
        submitForm,
        locale,
        v$,
    };
}

}
</script>

<style>
.is-invalid input {
    border: 1px solid #dc3545 !important;
  }
</style>
