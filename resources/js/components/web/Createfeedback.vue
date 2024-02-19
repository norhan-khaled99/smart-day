<template>
    <div class="container-fluid px-5">
        <div class="row d-flex justify-content-between mt-5">
            <div class="col-md-7 ">
                <img src="../../../../public/images/feedback.svg">
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form action="route('feedback.store')" @submit.prevent="submitForm()" method="post "
                            class="feedback-form">

                            <div class="form-group my-3">
                                <label for="point1" class="form-label">١ - الالتزام بالموعد</label>
                                <input type="number" min="0" max="5" v-model="form.point1" :class="{
                                    'is-invalid': v$.point1.$error,
                                }" class="form-control" name="point1">

                                <div class="invalid-feedback">
                                    <div v-for="error in v$.point1.$errors" :key="error">
                                        {{ $t("Punctuality") + " " + $t(error.$validator) }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="point2" class="form-label">٢ - التركيب والبرمجة والتدريب</label>
                                <input type="number" min="0" max="5" v-model="form.point2" :class="{
                                    'is-invalid': v$.point2.$error,
                                }" class="form-control" name="point2">
                                <div v-for="error in v$.point2.$errors" :key="error">
                                    {{ $t("installation programming and training") + " " + $t(error.$validator) }}
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="point3" class="form-label">٣ - اسلوب تعامل الفني</label>
                                <input type="number" min="0" max="5" v-model="form.point3" :class="{
                                    'is-invalid': v$.point3.$error,
                                }" class="form-control" name="point3">
                                <div v-for="error in v$.point3.$errors" :key="error">
                                    {{ $t("Employee Style") + " " + $t(error.$validator) }}
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="point4" min="0" max="5" class="form-label">٤ - نظافة العمل</label>
                                <input type="number" v-model="form.point4" min="1" max="5" :class="{
                                    'is-invalid': v$.point4.$error,
                                }" class="form-control" name="point4">
                                <div v-for="error in v$.point4.$errors" :key="error">
                                    {{ $t("Work cleanliness") + " " + $t(error.$validator) }}
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="">رقم الطلبية</label>
                                <input type="text" v-model="form.serial" :class="{
                                    'is-invalid': v$.serial.$error,
                                }" class="form-control">
                                <div v-for="error in v$.serial.$errors" :key="error">
                                    {{ $t("SERIAL") + " " + $t(error.$validator) }}
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="comments" class="form-label">اضف ملاحظاتك</label>
                                <textarea name="comments" v-model="form.comments" class="form-control"></textarea>
                            </div>



                            <div class="text-center">
                                <button class="btn send-button" type="submit">ارسال</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, } from "vue";
import feedbackClient from "../../http-clients/web/feedback-client.js";
import useVuelidate from "@vuelidate/core";
import { required, minValue, maxValue } from "@vuelidate/validators";
import { toast } from "vue3-toastify";
import { useI18n } from "vue-i18n";

export default {
    setup() {

        const { t, locale } = useI18n({ useScope: "global" });
        locale.value = "ar";

        const form = ref({
            point1: "",
            point2: "",
            point3: "",
            point4: "",
            serial: "",
            comments: "",
        });

        const rules = {
            point1: { required, minValue: minValue(1), maxValue: maxValue(5) },
            point2: { required, minValue: minValue(1), maxValue: maxValue(5) },
            point3: { required, minValue: minValue(1), maxValue: maxValue(5) },
            point4: { required, minValue: minValue(1), maxValue: maxValue(5) },
            serial: { required }
        };

        const v$ = useVuelidate(rules, form);

        const submitForm = async () => {
            if (v$.value.$invalid) {
                v$.value.$touch();
                return;
            }
            // form.serial = `#SD-Store:${form.serial}`;
            console.log(form.value);

            try {
                const response = await feedbackClient.store(form.value);
                v$.value.$reset();

                form.point1 = "",
                    form.point2 = "",
                    form.point3 = "",
                    form.point4 = "",
                    form.comments = "",

                    toast.success(t("SENT_SUCCESSFULLY"), {
                        autoClose: 2000,
                        position: "top-center",
                    });

            } catch (error) {
                console.error('Error submitting feedback:', error);
            }
        };
        return {
            v$,
            form,
            submitForm,
            locale,
            t,
        }
    },
}
</script>

<style scoped>
* {
    text-align: right;

}

.is-invalid input {
    border: 1px solid #dc3545 !important;
}

.card-body {
    
    border: 1px solid #5ae4aa;
}

img {
    width: 80%;
    height: 100%;
    display: block;
    text-align: center;
}

.send-button {
    color: #FFF;
    background: #5ae4aa;
}

.form-label {
    text-align: center;
}
</style>
