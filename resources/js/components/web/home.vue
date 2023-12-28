<template>
<div class="home-container">
    <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="info d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h2 data-aos="fade-down">
              <span>Smart Day</span>
            </h2>
            <p data-aos="fade-up">{{ $t("slider_welcome_message") }}<br /></p>
            <a
              href="#myModal"
              data-toggle="modal"
              data-aos="fade-up"
              data-aos-delay="200"
              class="btn-get-started"
              >{{ $t("SEE_VEIDO") }}</a
            >
          </div>
        </div>
      </div>
    </div>

    <div
      id="hero-carousel"
      class="carousel slide"
      data-bs-ride="carousel"
      data-bs-interval="5000"
    >
      <div
        class="carousel-item active"
        style="background-image: url(/web/assets/img/slide-1.png)"
      ></div>
      <div
        class="carousel-item"
        style="background-image: url(/web/assets/img/slide-2.png)"
      ></div>
      <div
        class="carousel-item"
        style="background-image: url(/web/assets/img/slide-3.png)"
      ></div>
      <div
        class="carousel-item"
        style="background-image: url(/web/assets/img/slide-4.png)"
      ></div>
      <a
        class="carousel-control-prev"
        href="#hero-carousel"
        role="button"
        data-bs-slide="prev"
      >
        <span
          class="carousel-control-prev-icon bi bi-chevron-left"
          aria-hidden="true"
        ></span>
      </a>

      <a
        class="carousel-control-next"
        href="#hero-carousel"
        role="button"
        data-bs-slide="next"
      >
        <span
          class="carousel-control-next-icon bi bi-chevron-right"
          aria-hidden="true"
        ></span>
      </a>
    </div>
  </section>

  <!-- End Hero Section -->
  <!-- Modal HTML -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <button
          type="button"
          class="close close-video"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe
            id="cartoonVideo"
            class="embed-responsive-item"
            width="100%"
            height="500"
            src="https://media.zid.store/284a9a0c-90c5-46ad-82ad-1fdb73e1f53c/966aca42-78a5-488f-ba61-e9fe30d88e9b.mp4"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>
  </div>
  <!-- End Alt Services Section -->
  <!-- ======= Features Section ======= -->
  <section id="features" class="features section-bg">

      <div class="container " data-aos="fade-up">
        <div style="display:flex;
    padding-bottom: 0;" class="section-header">
        <h3>{{$t("Product installation service and system configuration")}}</h3>
        </div>
        <div class="tab-content">
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                data-aos="fade-up" data-aos-delay="100">
                <ul>
                  <li>
                    {{$t("Welcome, dear customer, to join us in requesting the installation service for products at Smart Day, we are proud to provide distinguished service to all our customers if they wish to obtain installation and programming services for products")}}
                  </li>
                  <li>{{$t("Installation and programming service for products with great care under technical supervision and technical support. We care about the smallest details")}}</li>
                  <li>{{$t("A technical team with experience and high efficiency in installation and programming")}}</li>
                  <li>
                  {{$t("Dear customer, you must get to know the basic and sub-components of the system through the service (Configure security packages)")}}
                  </li>
                  <li>
                  {{$t("Dear customer, all you have to do is fill out the questionnaire to learn about our technical team’s coverage of your area and to learn about the cost of the installation service according to the number of products you purchased through our online store.")}}
                  </li>
                </ul>
                <router-link to="/install" class="install-contact-us">{{$t("APPLY_NOW")}}</router-link>
              </div>
              <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                <ul>
                  <li>
                                    {{$t("Find out the cost of the installation service according to the number of products you purchased through our online store")}}

                  </li>
                  <li>
                                    {{$t("Make sure, dear customer, that you will receive a code that you will deliver to the installation service provider after you are satisfied with all the comments and you can evaluate the technician via a feature in the store.")}}

                  </li>
                  <li>

                {{$t("Also make sure that you will get a two-year warranty. You can get technical support and training on how to deal with our products for the period that suits you during the warranty period through the technical support window in the store.")}}

                  </li>
                </ul>

              </div>
            </div>
          </div><!-- End tab content item -->
        </div>
      </div>
    </section>

  <section id="alt-services" class="alt-services">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-around gy-4">
        <div
          class="col-lg-6 img-bg"
          style="background-image: url(/web/assets/img/alt-services.jpg)"
          data-aos="zoom-in"
          data-aos-delay="100"
        ></div>

        <div class="col-lg-5 d-flex flex-column justify-content-center">
          <h3>{{$t("FOLLOW_EVENT")}}</h3>
          <p>
            {{$t("FOLLOW_EVENT_MESSAGE")}}
          </p>

          <div
            class="icon-box d-flex position-relative"
            data-aos="fade-up"
            data-aos-delay="100"
          >
            <i class="bi bi-easel flex-shrink-0"></i>
            <div>
              <h4>{{$t("Events follow-up service")}}</h4>
              <p>
                {{$t("It is a service that enables you to view all events over a 24-hour period through a program that accepts thousands of establishment branches")}}
              </p>
            </div>
          </div>
          <!-- End Icon Box -->

          <div
            class="icon-box d-flex position-relative"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <i class="bi bi-patch-check flex-shrink-0"></i>
            <div>
              <h4>
                {{$t("receiving_notifications")}}
              </h4>
              <p>
                {{$t("receiving_notifications_message")}}
              </p>
            </div>
          </div>
          <!-- End Icon Box -->

          <div
            class="icon-box d-flex position-relative"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <i class="bi bi-brightness-high flex-shrink-0"></i>
            <div>
              <h4>{{$t("You will receive notifications")}}</h4>
              <p class="points">
                <div>{{$t("When attempted burglary and fires")}}</div>
                <div>{{$t("When trying to open emergency doors during working hours")}}</div>
                <div>{{$t("When requesting assistance inside or outside the facility, specifying the location via maps")}}</div>
                <div>{{$t("When trying to tamper with equipment and storage cabinets")}}</div>
                <div>{{$t("When trying to tamper with the control panels of the fire alarm system and the self-extinguishing system, or when they malfunction, or when the sensors associated with them malfunction, or when they are out of electrical power.")}}</div>
              </p>
            </div>
          </div>

          <div
            class="icon-box d-flex position-relative"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <i class="bi bi-brightness-high flex-shrink-0"></i>
            <div>
              <h4>{{$t("You will receive notifications")}}</h4>
              <p class="points">
                <div>{{$t("When UPS backup power devices fail")}}</div>
                <div>{{$t("Monitor oxygen quality, humidity level and temperature")}}</div>
                <div>{{$t("Monitor the energy consumption of electrical appliances, control the voltage level, and control them remotely")}}</div>
                <div>{{$t("And many of the events that he will receive and view in record time and within seconds")}}</div>
                <div>{{$t("Get direct notifications of events and reports for up to two years")}}</div>
              </p>
              <router-link to="/notification-service" class="apply-now">{{$t("APPLY_NOW")}}</router-link>
            </div>

            <div>

            </div>

          </div>

        </div>
      </div>
    </div>
  </section>


  <!-- ======= Alt Services Section ======= -->
      <!-- ======= Get Started Section ======= -->
    <section id="get-started" class="get-started section-bg">
      <div class="container">

        <div class="row justify-content-between gy-4">

          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-up">

            <div class="content">
              <h3>
                {{$t("Leave us a note and we'll reach out soon")}}
              </h3>
              <p>
                                 {{$t("Welcome, dear customer, to join us in requesting the installation service for products at Smart Day, we are proud to provide distinguished service to all our customers if they wish to obtain installation and programming services for products")}}
                                {{$t("you can fill out the form")}} <router-link to="/notification-service">{{$t("HERE")}}</router-link>
              </p>
            </div>
          </div>

          <div class="col-lg-5" data-aos="fade">
            <form @submit.prevent="store"  class="php-email-form">
              <h3>{{$t("CONTACT")}}</h3>
              <p>
                {{$t("Need to get in touch with us? Either fill out the form with your inquiry or find the department email you'd like to contact below.")}}
              </p>
              <div class="row gy-3">

                <div class="col-md-12">
                  <input type="text" name="name" class="form-control"
                  v-model="v$.name.$model"
                      :class="{
                        'is-invalid': v$.name.$error,
                      }" :placeholder="$t('NAME')">
                      <div class="invalid-feedback">
                      <div v-for="error in v$.name.$errors" :key="error">
                        {{ $t("NAME") + " " + $t(error.$validator) }}
                      </div>
                    </div>

                </div>

                <div class="col-md-12 ">
                  <input type="email" class="form-control" v-model="v$.email.$model"
                      :class="{
                        'is-invalid': v$.email.$error,
                      }" :placeholder="$t('EMAIL')">
                      <div class="invalid-feedback">
                      <div v-for="error in v$.email.$errors" :key="error">
                        {{ $t("EMAIL") + " " + $t(error.$validator) }}
                      </div>
                    </div>

                </div>

                <div class="col-md-12">
                  <input v-model="v$.phone.$model"
                      :class="{
                        'is-invalid': v$.phone.$error,
                      }"
 type="text" class="form-control" name="phone" :placeholder="$t('PHONE')">
                     <div class="invalid-feedback">
                      <div v-for="error in v$.phone.$errors" :key="error">
                        {{ $t("PHONE") + " " + $t(error.$validator) }}
                      </div>
                    </div>

                </div>

                <div class="col-md-12">
                  <textarea class="form-control" v-model="message" name="message" rows="6" :placeholder="$t('MESSAGE')"></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit">{{$t("SEND_MESSAGE")}}</button>
                </div>

              </div>
            </form>
          </div><!-- End Quote Form -->

        </div>

      </div>
    </section><!-- End Get Started Section -->

</div>
</template>

<script>
import { onMounted, reactive, toRefs } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";

import { toast } from "vue3-toastify";
import contactClient from "../../http-clients/web/contact-client";
import { useI18n } from "vue-i18n";

export default {
  setup() {
    const { t, locale } = useI18n({ useScope: "global" });

    const form = reactive({
      name: "",
      phone: "",
      email: "",
      message: "",
    });

    const rules = {
      name: { required },
      email: { required, email },
      phone: { required },
    };
    const v$ = useVuelidate(rules, form);
    onMounted(() => {});
    //Methods
    function getForm() {
      return {
        name: form.name,
        email: form.email,
        phone: form.phone,
        message: form.message,
      };
    }
    function store() {
      if (v$.value.$invalid) {
        v$.value.$touch();
        return;
      }
      contactClient
        .store(getForm())
        .then(() => {
          v$.value.$reset();
          form.name = "";
          form.phone = "";
          form.email = "";
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
.home-container {
  .get-started .php-email-form button[type="submit"] {
    &:hover {
      background: var(--color-primary);
    }
  }
  .apply-now {
    margin-top: 40px !important;
  }
  .install-contact-us,
  .apply-now {
    &:hover {
      color: white;
      cursor: pointer;
    }
    width: 140px;
    height: 45px;
    border: 1px solid #5ae4aa;
    border-radius: 9px;
    color: white;
    background: #5ae4aa;
    margin-top: 19px;
    // font-size: 15px;
    font-weight: 600;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .close-video {
    top: -21px;
    right: -45px;
    position: absolute;
    width: 20px;
    height: 30px;
    background: none;
    color: #fff;
    border: none;
    font-size: 36px;
  }
  @media (max-width: "700px") {
    body[dir="rtl"] & {
      .close-video {
        position: absolute !important;
        top: 6px !important;
        right: 7px !important;
      }
    }
    body[dir="ltr"] & {
      .close-video {
        position: absolute !important;
        top: -9px !important;
        right: 16px !important;
      }
    }
  }

  body[dir="rtl"] & {
    .php-email-form .form-control::placeholder {
      font-size: 13px !important;
    }
    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
      background: #5ae4aa;
      opacity: 1 !important;
      color: #fff;
    }
    p.aos-init.aos-animate {
      line-height: 29px !important;
      // font-weight: 600 !important;
      // font-size: 20px !important;
    }
    .btn-get-started {
      font-weight: 600 !important;
      font-size: 19px !important;
    }
    .get-started .php-email-form button[type="submit"] {
      padding: 6px 30px;
      font-weight: 600 !important;
    }
  }
  .modal-content {
    background-color: unset !important;
    border-radius: 0 !important;
  }
}
</style>
