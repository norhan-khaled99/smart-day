<template>
  <div class="notification-service">
    <!-- ======= Breadcrumbs ======= -->
    <div
      class="notification-service breadcrumbs d-flex align-items-center"
      style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
    >
      <div
        class="container position-relative d-flex flex-column align-items-center"
        data-aos="fade"
      >
        <h2>{{ $t("NOTIFICATIONS_SERVICE") }}</h2>
        <ol>
          <li>
            <router-link to="/home">{{ $t("HOME") }}</router-link>
          </li>
          <li>{{ $t("NOTIFICATIONS_SERVICE") }}</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

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
                <div class="col-lg-6 form-group">
                  <input
                    type="text"
                    class="form-control"
                    v-model="v$.email.$model"
                    :class="{
                      'is-invalid': v$.email.$error,
                    }"
                    :placeholder="$t('EMAIL')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.email.$errors" :key="error">
                      {{ $t("EMAIL") + " " + $t(error.$validator) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 form-group">
                  <input
                    type="text"
                    name="name"
                    class="form-control"
                    v-model="v$.facility.$model"
                    :class="{
                      'is-invalid': v$.facility.$error,
                    }"
                    :placeholder="$t('FACILITY')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.facility.$errors" :key="error">
                      {{ $t("FACILITY") + " " + $t(error.$validator) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 form-group">
                  <input
                    type="text"
                    class="form-control"
                    name="email"
                    v-model="v$.branch_number.$model"
                    :class="{
                      'is-invalid': v$.branch_number.$error,
                    }"
                    :placeholder="$t('BRANCH_NUMBER')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.branch_number.$errors" :key="error">
                      {{ $t("BRANCH_NUMBER") + " " + $t(error.$validator) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 form-group">
                  <Multiselect
                    :placeholder="$t('SELECT_AREA')"
                    :label="$i18n.locale == 'ar' ? 'name' : 'name_e'"
                    :searchable="true"
                    v-model="v$.area_id.$model"
                    valueProp="id"
                    :options="areas"
                    :class="{
                      'is-invalid': v$.area_id.$error,
                    }"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.area_id.$errors" :key="error">
                      {{ $t("AREA") + " " + $t(error.$validator) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 form-group">
                  <Multiselect
                    :placeholder="$t('SELECT_CITY')"
                    :label="$i18n.locale == 'ar' ? 'name' : 'name_e'"
                    :searchable="true"
                    :class="{
                      'is-invalid': v$.city_id.$error,
                    }"
                    v-model="v$.city_id.$model"
                    valueProp="id"
                    :options="cities"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.city_id.$errors" :key="error">
                      {{ $t("CITY") + " " + $t(error.$validator) }}
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
                      'is-invalid': v$.neighborhood.$error,
                    }"
                    v-model="v$.neighborhood.$model"
                    :placeholder="$t('neighborhood')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.neighborhood.$errors" :key="error">
                      {{ $t("neighborhood") + " " + $t(error.$validator) }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.street.$error,
                    }"
                    v-model="v$.street.$model"
                    :placeholder="$t('STREET')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.street.$errors" :key="error">
                      {{ $t("STREET") + " " + $t(error.$validator) }}
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
                <button type="submit">{{ $t("COMPLETE_ORDER") }}</button>
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
import Multiselect from "@vueform/multiselect";

import { required, email } from "@vuelidate/validators";
import notificationServiceClient from "../../http-clients/web/notification-service-client";
import { toast } from "vue3-toastify";
import { onMounted, reactive, toRefs } from "vue";
import { useI18n } from "vue-i18n";
import useVuelidate from "@vuelidate/core";
export default {
  components: {
    Multiselect,
  },
  setup() {
    const { t, locale } = useI18n({ useScope: "global" });
    const form = reactive({
      name: "",
      phone: "",
      email: "",
      facility: "",
      branch_number: "",
      area_id: "",
      city_id: "",
      neighborhood: "",
      street: "",
      message: "",
    });
    const data = reactive({
      areas: [],
      cities: [],
    });
    onMounted(() => {
      getCities();
      getAreas();
    });
    const rules = {
      name: { required },
      phone: { required },
      email: { required, email },
      facility: { required },
      branch_number: { required },
      area_id: { required },
      city_id: { required },
      neighborhood: { required },
      street: { required },
    };
    const v$ = useVuelidate(rules, form);
    function getAreas() {
      notificationServiceClient.getAreas().then((res) => {
        data.areas = res.data;
      });
    }
    function getCities() {
      notificationServiceClient.getCities().then((res) => {
        data.cities = res.data;
      });
    }

    function getForm() {
      return {
        name: form.name,
        phone: form.phone,
        email: form.email,
        facility: form.facility,
        branch_number: form.branch_number,
        area_id: form.area_id,
        city_id: form.city_id,
        neighborhood: form.neighborhood,
        street: form.street,
        message: form.message,
      };
    }
    function store() {
      if (v$.value.$invalid) {
        v$.value.$touch();
        return;
      }
      notificationServiceClient
        .store(getForm())
        .then(() => {
          v$.value.$reset();
          form.name = "";
          form.phone = "";
          form.email = "";
          form.facility = "";
          form.branch_number = "";
          form.area_id = "";
          form.city_id = "";
          form.neighborhood = "";
          form.street = "";
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
      ...toRefs(data),
      v$,
    };
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>

<style lang="scss">
.notification-service {
  .contact .php-email-form button[type="submit"] {
    &:hover {
      background: var(--color-primary);
    }
  }
  .php-email-form .form-control::placeholder,
  .invalid-feedback,
  .multiselect-option {
    font-size: 13px !important;
  }
  .multiselect {
    font-size: 13px !important;
    border: none !important;
    input {
      border: 1px solid #ced4da !important;
      border-radius: 0 !important;
      &::placeholder {
        line-height: 40px;
      }
    }
  }
  .multiselect-placeholder {
    color: gray !important;
  }
  .multiselect-clear-icon {
    position: relative;
  }
  .is-selected {
    background: var(--color-primary) !important;
  }
  .multiselect-single-label,
  .multiselect-placeholder,
  .multiselect-clear-icon,
  .multiselect-caret {
    top: 3px !important;
  }
  .multiselect.is-invalid {
    input {
      border: 1px solid #dc3545 !important;
    }
  }
}
@media (max-width: 450px) {
  .notification-service {
    .info-item {
      p.address-p {
        padding: 0 25px;
        text-align: center; 
      }
    }
  }
}
</style>