<template>
  <div class="install">
    <!-- ======= Breadcrumbs ======= -->
    <div
      class="install breadcrumbs d-flex align-items-center"
      style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
    >
      <div
        class="container position-relative d-flex flex-column align-items-center"
        data-aos="fade"
      >
        <h2>{{ $t("INSTALLATION_SERVICE") }}</h2>
        <ol>
          <li>
            <router-link to="/home">{{ $t("HOME") }}</router-link>
          </li>
          <li>{{ $t("INSTALLATION_SERVICE") }}</li>
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
            <form @submit.prevent="store" role="form" class="php-email-form ">
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
                    type="datetime-local"
                    class="form-control"
                    name="email"
                    v-model="v$.date.$model"
                    :class="{
                      'is-invalid': v$.date.$error,
                    }"
                    :placeholder="$t('date')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.date.$errors" :key="error">
                      {{ $t("date") + " " + $t(error.$validator) }}
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
                    @select="onAreaChange()"
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
                  :options="filteredCities"
                  @select="getcityStatus()"
                />

                <div class="invalid-feedback">
                    <div v-for="error in v$.city_id.$errors" :key="error">
                        {{ $t("CITY") + " " + $t(error.$validator) }}
                    </div>
                </div>
                </div>
                <p v-if=" cityStatus == 'false' " class="text-weight-bold col-12 my-0 font-italic text-center">
                  {{ locale === 'ar' ? $t("Dear Guest We will contact you as soon as possible") : $t("Dear Guest We will contact you as soon as possible", { locale: 'en' }) }}

                </p>

                <div class="col-lg-6 form-group">
                    <Multiselect
                    :placeholder="$t('SELECT_PRODUCT')"
                    :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                    :searchable="true"
                    :class="{
                      'is-invalid': v$.product_id.$error,
                    }"
                    v-model="v$.product_id.$model"
                    valueProp="id"
                    :options="products"
                    @keyup="getproductdetailsbyId(product_id)"
                  />
                </div>

                <div class="col-lg-6 form-group">
                    <input
                      type="number"
                      class="form-control"
                      name="email"
                      v-model="v$.quantity.$model"
                      :class="{
                        'is-invalid': v$.quantity.$error,
                      }"
                      :placeholder="$t('quantity')"
                    />
                    <div class="invalid-feedback">
                      <div v-for="error in v$.quantity.$errors" :key="error">
                        {{ $t("quantity") + " " + $t(error.$validator) }}
                      </div>
                    </div>
                  </div>

                <div v-if="cityStatus == 'true'" class="text-weight-bold col-12 my-0 fs-6 text-start font-italic">
                   <span class="mx-2">  {{ $t("PRODUCT_PRICE") }}   {{ getTotalPrice()}} </span>
                   <span class="ms-3">  {{ $t("PRODUCT_TAXES") }}    {{ getTaxes() }} </span>
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

                <div class="col-lg-6 form-group">
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
                  <input
                    type="datetime"
                    class="form-control"
                    name="email"
                    v-model="v$.order_number.$model"
                    :class="{
                      'is-invalid': v$.order_number.$error,
                    }"
                    :placeholder="$t('order_number')"
                  />
                  <div class="invalid-feedback">
                    <div v-for="error in v$.order_number.$errors" :key="error">
                      {{ $t("order_number") + " " + $t(error.$validator) }}
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
                      :placeholder="$t('EXTRA_NOTES')"
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
import productApiClient from "../../http-clients/web/product-client";
import { required, email } from "@vuelidate/validators";
import installClient from "../../http-clients/web/install-client";
import { toast } from "vue3-toastify";
import { onMounted, reactive, toRefs , ref, watch} from "vue";
import { useI18n } from "vue-i18n";
import useVuelidate from "@vuelidate/core";

export default {
  components: {
    Multiselect,
  },
  setup() {
    const { t, locale } = useI18n({ useScope: "global" });
    const products = ref([]);
    const getproductdetails=ref([]);
    const filteredCities=ref([]);
    const filteredCity=ref({});
    let productId=ref(null);

    const cityStatus = ref(null);

    const form = reactive({

      name: "",
      phone: "",
      email: "",
    //   products_number: "",
      quantity: "",
      order_number: "",
      product_id:"",
      date: datetimeLocal(),
      area_id: "",
      city_id: "",
      neighborhood: "",
      street: "",
      message: "",

    });


    const data = reactive({
    areas: [
        { id: 1, name: "الوسطى", name_e: "Central" },
        { id: 2, name: "الغربية", name_e: "Western" },
        { id: 3, name: "الجنوبية", name_e: "Southern" },
        { id: 4, name: "الشمالية", name_e: "Northern" },
        { id: 5, name: "الشرقية", name_e: "Eastern" },
    ],
    citiesByArea: {
        1: [
        {  id: 7, name: "الخرج", name_e: "Al-Kharj" },
        {  id: 12, name: "بريدة", name_e: "Buraydah"},
        { id: 4, name: "الدمام", name_e: "Al-Dammam"},
        {id:23,name: "الرياض",name_e:"Riyadh"}
        ],
        2: [
        { id: 10, name: "الطائف" , name_e:"Al-Taif" },
        { id: 15, name: "جدة", name_e:"Jiddah" },
        { id: 19, name: "مكة المكرمة",name_e:"Mecca"},
        { id: 20, name: "المدينة المنورة", name_e: "Medina"},
        {id:24,name:"سكاكا",name_e: "Sakaka"},
        {id:26,name:"ينبع",name_e:"Yanbu"},

        ],
        3: [
        { id: 1, name: "ابها", name_e: "Abha" },
        { id: 16, name: "جازان",name_e:"Jizan"},
        { id: 17, name: "خميس مشيط",name_e:"Khamis Mushayt" },
        { id: 21, name: "نجران",name_e:"Najran"},
        ],
        4: [
        {  id: 6, name: "الجوف", name_e: "Al-Jawf" },
        {  id: 11, name: "عرعر", name_e: "Arar" },
        {  id: 14, name: "يشيد", name_e: "Hail" },
        { id: 25, name: "تبوك" ,name_e:"Tabuk"},
        ],
        5: [
        { id: 2, name: "بقيق" , name_e: "Abqaiq" },
        { id: 3, name: "الباحة", name_e: "Al-Bahah"},
        { id: 4, name: "الدمام", name_e: "Al-Dammam" },
        { id: 5, name: "الهفهوف" , name_e:"Al-Hufuf" },
        { id: 8, name: "الخبر" , name_e:"Al-Khubar" },
        { id: 9, name: "القطيف" , name_e:"Al-Qatif" },
        { id: 13, name: "الظهران", name_e: "Dhahran"},
        { id: 18, name: "مدينة الملك خالد العسكرية", name_e: "King Khalid Military City"},
        {id:22,name:"رأس تنورة", name_e:"Ras Tanura"},
        ],
    },
    filteredCities: [],
    });



    const fetchAllProducts = async () => {
        try {
            const response = await productApiClient.getAllProducts();
            products.value = response.data.data;
        } catch (error) {
            console.error('Error fetching all products:', error);
        }
    };

    const getTotalPrice = () => {

      if (getproductdetails.value && form.quantity) {
        const quantity = parseFloat(form.quantity);
        const price = parseFloat(getproductdetails.value.price);
        const totalPrice = quantity * price;
        return (totalPrice.toFixed(2));
      }
      return '';
    };

    const getTaxes = () => {
        const Taxes= getproductdetails.value.taxes;
        return Taxes;
    }

    const getproductdetailsbyId = async () => {
        productId=form.product_id;

        try {
            const response = await productApiClient.getProductDetails(productId);
            getproductdetails.value = response.data;

        } catch (error) {
            console.error('Error fetching all products:', error);
        }
    };


    onMounted(() => {
    fetchAllProducts();
    getCities();
    });

    const rules = {
      name: { required },
      phone: { required },
      email: { required, email },
    //   products_number: { required },
      quantity: { required },
      date: { required },
      order_number: { required },
      area_id: { required },
      city_id: { required },
      product_id:{required},
      neighborhood: { required },
      street: { required },
    };



    const getcityStatus = () => {
    data.filteredCities.forEach((filteredCity) => {

        if (filteredCity.id == form.city_id) {
        cityStatus.value = filteredCity.status;
        }
    });
    };


    watch(cityStatus, (newCityStatus, oldCityStatus) => {
      console.log(newCityStatus);
    });


    function filterCitiesByArea(areaId) {
     data.filteredCities = data.citiesByArea[areaId]||[];

     data.cities.forEach((city) => {
     data.filteredCities.forEach((filteredCity) => {
      if(filteredCity.name==city.name){
        filteredCity.status=city.status;
      }
    });
    });
    }

    function onAreaChange() {
      const newAreaId = form.area_id;
      filterCitiesByArea(newAreaId);
    }


    const v$ = useVuelidate(rules, form);


    function datetimeLocal() {
      const dt = new Date();
      dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
      return dt.toISOString().slice(0, 16);
    }

    function getCities() {
      installClient.getCities().then((res) => {
        data.cities = res.data;
      });
    }

    function getForm() {
      return {
        name: form.name,
        phone: form.phone,
        email: form.email,
        order_number: form.order_number,
        product_id:form.product_id,
        // products_number: form.products_number,
        quantity: form.quantity,
        date: form.date,
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
      installClient
        .store(getForm())
        .then(() => {
          v$.value.$reset();

          form.name = "";
          form.phone = "";
          form.email = "";
          form.date = datetimeLocal();
        //   form.products_number = "";
          form.quantity = "";
          form.product_id="";
          form.area_id = "";
          form.city_id="";
          form.neighborhood = "";
          form.street = "";
          form.message = "";
          toast.success(t("SENT_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
        })
        .catch((error) => {
          console.log(error);
        });
    }
    return {
      onAreaChange,
      store,
      productId,
      filteredCities,
      getproductdetails,
      getTotalPrice,
      getproductdetailsbyId,
      products,
      locale,
      cityStatus,
      filteredCity,
      filteredCities,
      getcityStatus,
      getTaxes,
      ...toRefs(form),
      ...toRefs(data),
      v$,
    };
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>

<style lang="scss">
.install {
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
  .install {
    .info-item {
      p.address-p {
        padding: 0 25px;
        text-align: center;
      }
    }
  }
}
</style>
