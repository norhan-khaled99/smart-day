<template>
  <!-- ======= Breadcrumbs ======= -->
  <div>
  <div
    class="breadcrumbs d-flex align-items-center"
    style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
  >
    <div
      class="container position-relative d-flex flex-column align-items-center"
      data-aos="fade"
    >
      <h2>{{ $t("APPLY_JOB") }}</h2>
      <ol>
        <li>
          business-contractor
          <router-link to="/home">{{ $t("HOME") }}</router-link>
        </li>
        <li>{{ $t("APPLY_JOB") }}</li>
      </ol>
    </div>
  </div>

  <!-- End Breadcrumbs -->

     <!-- FAQ Section -->
     <Section >

     </Section>
  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-6">
          <div
            class="info-item d-flex flex-column justify-content-center align-items-center"
          >
            <i class="bi bi-map"></i>
            <h3>{{ $t("Our Address") }}</h3>
            <p class="address-p">{{ $t("sd_address") }}</p>
          </div>
        </div>
        <!-- End Info Item -->

        <div class="col-lg-3 col-md-6">
          <div
            class="info-item d-flex flex-column justify-content-center align-items-center"
          >
            <i class="bi bi-envelope"></i>
            <h3>{{ $t("Email Us") }}</h3>
            <p>Info@sd.com.sa</p>
          </div>
        </div>
        <!-- End Info Item -->

        <div class="col-lg-3 col-md-6">
          <div
            class="info-item d-flex flex-column justify-content-center align-items-center"
          >
            <i class="bi bi-telephone"></i>
            <h3>{{ $t("Call Us") }}</h3>
            <p dir="ltr">+966556668145</p>
          </div>
        </div>
        <!-- End Info Item -->
      </div>

      <div class="row gy-4 mt-1">
        <div class="col-lg-6">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3626.0910056136404!2d46.732360374501404!3d24.65499565345001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z2LTYp9ix2Lkg2KfZhNi42YfYsdin2YbYjCDYp9mE2YXZhNiy2Iwg2KfZhNix2YrYp9i2INin2YTZhdmF2YTZg9ipINin2YTYudix2KjZitipINin2YTYs9i52YjYr9mK2Kk!5e0!3m2!1sen!2seg!4v1693757745144!5m2!1sen!2seg"
            frameborder="0"
            style="border: 0; width: 100%; height: 384px"
            allowfullscreen
          ></iframe>
        </div>
        <!-- End Google Maps -->

        <div class="col-lg-6">
          <form @submit.prevent="store" role="form" class="php-email-form">
            <div class="row gy-4">
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  id="name"
                  v-model="v$.name.$model"
                  :class="{
                    'is-invalid': v$.name.$error,
                  }"
                  :placeholder="$t('NAME')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.name.$errors" :key="error">
                    {{ $t("NAME") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="v$.nationality.$model"
                  :class="{
                    'is-invalid': v$.nationality.$error,
                  }"
                  :placeholder="$t('NATIONALITY')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.nationality.$errors" :key="error">
                    {{ $t("NATIONALITY") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  v-model="v$.age.$model"
                  :class="{
                    'is-invalid': v$.age.$error,
                  }"
                  :placeholder="$t('AGE')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.age.$errors" :key="error">
                    {{ $t("AGE") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  class="form-control"
                  name="email"
                  v-model="v$.certificates.$model"
                  :class="{
                    'is-invalid': v$.certificates.$error,
                  }"
                  :placeholder="$t('Certificates')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.certificates.$errors" :key="error">
                    {{ $t("Certificates") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  id="name"
                  :class="{
                    'is-invalid': v$.experience.$error,
                  }"
                  v-model="v$.experience.$model"
                  :placeholder="$t('EXPERIENCE')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.experience.$errors" :key="error">
                    {{ $t("EXPERIENCE") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  class="form-control"
                  :class="{
                    'is-invalid': v$.area.$error,
                  }"
                  v-model="v$.area.$model"
                  :placeholder="$t('AREA')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.area.$errors" :key="error">
                    {{ $t("AREA") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  v-model="v$.city.$model"
                  :class="{
                    'is-invalid': v$.city.$error,
                  }"
                  :placeholder="$t('CITY')"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.city.$errors" :key="error">
                    {{ $t("CITY") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 form-group">
                <input
                  type="text"
                  class="form-control"
                  name="email"
                  id="email"
                  :placeholder="$t('PHONE')"
                  v-model="v$.phone.$model"
                  :class="{
                    'is-invalid': v$.phone.$error,
                  }"
                />
                <div class="invalid-feedback">
                  <div v-for="error in v$.phone.$errors" :key="error">
                    {{ $t("PHONE") + " " + $t(error.$validator) }}
                  </div>
                </div>
              </div>
              <div class="col-lg-12 form-group">
                <div class="form-group">
                  <textarea
                    class="form-control"
                    name="message"
                    rows="5"
                    v-model="message"
                    :placeholder="$t('MESSAGE')"
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit">{{ $t("SEND_MESSAGE") }}</button>
            </div>
          </form>
        </div>
        <!-- End Contact Form -->
      </div>
    </div>
  </section>
  <!-- End Contact Section -->
</div>
</template>

<script>
import { required, email } from "@vuelidate/validators";
import recruitmentClient from "../../http-clients/web/recruitment-client";
import { toast } from "vue3-toastify";
import { reactive, toRefs } from "vue";
import { useI18n } from "vue-i18n";
import useVuelidate from "@vuelidate/core";
export default {
  setup() {
    const { t, locale } = useI18n({ useScope: "global" });
    const form = reactive({
      name: "",
      nationality: "",
      age: "",
      certificates: "",
      experience: "",
      area: "",
      city: "",
      phone: "",
      message: "",
    });

    const rules = {
      name: { required },
      nationality: { required },
      age: { required },
      certificates: { required },
      experience: { required },
      area: { required },
      city: { required },
      phone: { required },
    };
    const v$ = useVuelidate(rules, form);
    function getForm() {
      return {
        name: form.name,
        nationality: form.nationality,
        age: form.age,
        certificates: form.certificates,
        experience: form.experience,
        area: form.area,
        city: form.city,
        phone: form.phone,
        message: form.message,
      };
    }
    function store() {
      if (v$.value.$invalid) {
        v$.value.$touch();
        return;
      }
      recruitmentClient
        .store(getForm())
        .then(() => {
          v$.value.$reset();
          form.name = "";
          form.nationality = "";
          form.age = "";
          form.certificates = "";
          form.experience = "";
          form.area = "";
          form.city = "";
          form.phone = "";
          form.message = "";
          toast.success(t("SENT_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
        })
        .catch((error) => {});
    }


    return {
      store,
      ...toRefs(form),
      v$,
    };
  },
};
</script>

<style lang="scss">
.contact .php-email-form button[type="submit"] {
  &:hover {
    background: var(--color-primary);
  }
}
.php-email-form .form-control::placeholder,
.invalid-feedback {
  font-size: 13px !important;
}
@media (max-width: 450px) {
  .info-item {
    p.address-p {
      padding: 0 25px;
      text-align: center;
    }
  }
}
</style>
