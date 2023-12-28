<template>
    <div class="container">
     <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
             <form action="route('feedback.store')" @submit.prevent="submitForm()" method="get" class="feedback-form">

            <div class="form-group my-3">
                <label for="point1" class="form-label">١ - الالتزام بالموعد</label>
                <input type="number" v-model="form.point1" class="form-control" name="point1" min="1" max="5" required>
            </div>

            <div class="form-group my-3">
                <label for="point2" class="form-label">٢ - التركيب والبرمجة والتدريب</label>
                <input type="number" v-model="form.point2" class="form-control" name="point2" min="1" max="5" required>
            </div>

            <div class="form-group my-3">
                <label for="point3" class="form-label">٣ - اسلوب تعامل الفني</label>
                <input type="number" v-model="form.point3" class="form-control" name="point3" min="1" max="5" required>
            </div>

            <div class="form-group my-3">
                <label for="point4" class="form-label">٤ - نظافة العمل</label>
                <input type="number" v-model="form.point4" class="form-control" name="point4" min="1" max="5" required>
            </div>

            <div class="form-group my-3">
                <label for="comments" class="form-label">اضف ملاحظاتك</label>
                <textarea name="comments" v-model="form.comments" class="form-control"></textarea>
            </div>
            <div class="text-center">
            <button class="btn btn-secondary" type="submit">ارسال</button>
            </div>
        </form>
        </div>
        </div>
        </div>
     </div>
    </div>
 </template>

 <script>
     import { onMounted , ref,} from "vue";
     import feedbackClient from "../../http-clients/web/feedback-client.js";

    export default {
    setup(){
        const form=ref({
            point1:"",
            point2:"",
            point3:"",
            point4:"",
            comments:"",
        });


    const submitForm = async () => {
      try {
        console.log(form.value);
        const response = await feedbackClient.store(form.value);
        console.log('Feedback submitted successfully:', response);
      } catch (error) {
        console.error('Error submitting feedback:', error);
      }
    };

    return{
        form,
        submitForm

    }

  },
 }
 </script>

 <style scoped>
 *{
    direction: rtl;
 }

 </style>
