<template>
  <div class="product-form">
    <div class="page-header border" style="margin-top: 10px">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            {{
              params.id == "create" ? $t("ADD_PRODUCT") : $t("UPDATE_PRODUCT")
            }}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div
        class="col-lg-9 order-lg-1 order-2 basic-info-sec"
        :style="
          $i18n.locale == 'en' ? 'padding-right:10px' : 'padding-left:10px'
        "
      >
        <form>
          <div
            id="basic-information"
            class="form-container bg-white border border-radius-4 mb-30"
          >
            <div class="create-item">
              <div class="title mb-4">{{ $t("BASIC_INFORMATION") }}</div>
              <div class="row">
                <div v-if="isArabic" class="col-lg-12 mb-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("PRODUCT_NAME") }}
                      <a class="locale" href="" @click.prevent="toggleLocale">
                        {{ $t("ARABIC") }}
                      </a>
                    </label>
                    <input
                      :placeholder="$t('TYPE_PRODUCT_NAME')"
                      type="text"
                      class="form-control"
                      v-model="v$.name_ar.$model"
                      :class="{
                        'is-invalid': v$.name_ar.$error || titleArExist,
                      }"
                    />
                    <div class="invalid-feedback">
                      <div v-for="error in v$.name_ar.$errors" :key="error">
                        {{ $t("NAME") + " " + $t(error.$validator) }}
                      </div>
                      <div v-if="!v$.name_ar.$invalid && titleArExist">
                        {{ $t("NAME") + " " + $t("EXIST") }}
                      </div>
                    </div>
                    <div class="text-mute">
                      {{ $t("PRODUCT_NAME_REQUIRED_RECOMMENDED_UNIQUE") }}
                    </div>
                  </div>
                </div>

                <div v-else class="col-lg-12 mb-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("PRODUCT_NAME") }}
                      <a class="locale" href="" @click.prevent="toggleLocale">
                        {{ $t("ENGLISH") }}
                      </a>
                    </label>
                    <input
                      :placeholder="$t('TYPE_PRODUCT_NAME')"
                      type="text"
                      class="form-control"
                      v-model="v$.name_en.$model"
                      :class="{
                        'is-invalid': v$.name_en.$error || titleEnExist,
                      }"
                    />
                    <div class="invalid-feedback">
                      <div v-for="error in v$.name_en.$errors" :key="error">
                        {{ $t("NAME") + " " + $t(error.$validator) }}
                      </div>
                      <div v-if="!v$.name_en.$invalid && titleEnExist">
                        {{ $t("NAME") + " " + $t("EXIST") }}
                      </div>
                    </div>
                    <div class="text-mute">
                      {{ $t("PRODUCT_NAME_REQUIRED_RECOMMENDED_UNIQUE") }}
                    </div>
                  </div>
                </div>
                <!-- start add price to product -->
                <div  class="col-lg-12 mb-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">
                        {{ $t("PRODUCT_PRICE") }}
                      </label>
                      <input
                        :placeholder="$t('TYPE_PRODUCT_PRICE')"
                        type="number"
                        class="form-control"
                        v-model="v$.price.$model"
                        :class="{
                          'is-invalid': v$.price.$error,
                        }"
                      />
                      <div class="text-mute">
                        {{ $t("You Have to enter Product Price") }}
                      </div>
                    </div>
                  </div>

                  <div  class="col-lg-12 mb-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">
                        {{ $t("PRODUCT_TAXES") }}
                      </label>
                      <input
                        :placeholder="$t('TYPE_PRODUCT_TAXES')"
                        type="text"
                        class="form-control"
                        v-model="v$.taxes.$model"
                        :class="{
                          'is-invalid': v$.taxes.$error,
                        }"
                      />
                      <div class="text-mute">
                        {{ $t("You Have to enter Product Taxes") }}
                      </div>
                    </div>
                  </div>

                <div class="col-lg-12 mb-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("SHORT_DESCRIPTION") }}
                    </label>
                    <textarea
                      rows="3"
                      :placeholder="$t('TYPE_PRODUCT_SHORT_DESCRIPTION')"
                      type="text"
                      class="form-control"
                      v-model="v$.short_description.$model"
                      :class="{
                        'is-invalid': v$.short_description.$error,
                      }"
                    >
                    </textarea>
                    <div class="invalid-feedback">
                      <div
                        v-for="error in v$.short_description.$errors"
                        :key="error"
                      >
                        {{
                          $t("SHORT_DESCRIPTION") + " " + $t(error.$validator)
                        }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group html-editor mb-30">
                    <label for="exampleInputEmail1">
                      {{ $t("DESCRIPTION") }}
                    </label>
                    <ckeditor
                      :editor="editor"
                      v-model="v$.description.$model"
                    ></ckeditor>
                    <div class="invalid-feedback">
                      <div v-for="error in v$.description.$errors" :key="error">
                        {{ $t("DESCRIPTION") + " " + $t(error.$validator) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            id="image"
            class="form-container bg-white border border-radius-4 mb-30"
          >
            <div class="create-item">
              <div class="title mb-4">{{ $t("IMAGES") }}</div>
              <div class="row">
                <div class="col-lg-12 mb-4">
                  <Image
                    :id="1"
                    title="Thumbnail_592_592"
                    subTitle="CHOOSE_CATEGORY_THUMBNAIL_BLACK"
                    :selectedMedia="blackMediaManager"
                    @selectedMedia="blackMediaManager = $event"
                    :singleSelect="true"
                  />
                </div>
                <div class="col-lg-12 mb-2">
                  <Image
                    :id="2"
                    title="Thumbnail_592_592"
                    subTitle="CHOOSE_CATEGORY_THUMBNAIL_WHITE"
                    :selectedMedia="whiteMediaManager"
                    @selectedMedia="whiteMediaManager = $event"
                    :singleSelect="true"
                  />
                </div>
              </div>
            </div>
          </div>

          <div
            id="category"
            class="form-container bg-white border border-radius-4 mb-30"
          >
            <div class="create-item">
              <div class="title mb-4">{{ $t("PRODUCT_CATEGORY") }}</div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <Multiselect
                      :placeholder="$t('SELECT_CATEGORY')"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      :searchable="true"
                      v-model="v$.base_category_id.$model"
                      :class="{
                        'is-invalid': v$.base_category_id.$error,
                      }"
                      valueProp="id"
                      :options="categories"
                    />
                    <div class="invalid-feedback">
                      <div
                        v-for="error in v$.base_category_id.$errors"
                        :key="error"
                      >
                        {{ $t("CATEGORY") + " " + $t(error.$validator) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            id="filter"
            class="form-container bg-white border border-radius-4 mb-30"
          >
            <div class="title mb-4">{{ $t("Product Filter") }}</div>
            <div class="create-item">
              <div
                v-for="(filterOption, index) in filterOptions"
                :key="index"
                class="row"
              >
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("PREMISE_TYPE") }}
                    </label>
                    <Multiselect
                      :searchable="true"
                      v-model="filterOption.premise_type"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      valueProp="value"
                      :options="premiseTypes"
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("PROTECTION_TYPE") }}
                    </label>
                    <Multiselect
                      :searchable="true"
                      v-model="filterOption.category_id"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      valueProp="id"
                      :options="[...categories].slice(0, 4)"
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("PREMISE_FEATURE") }}
                    </label>
                    <Multiselect
                      :hideSelected="false"
                      mode="multiple"
                      :searchable="true"
                      v-model="filterOption.premise_feature"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      valueProp="value"
                      :options="premiseFeatures"
                    />
                  </div>
                </div>
                <div
                  class="col-lg-3"
                  v-if="
                    filterOption.premise_feature.includes('no_of_floors') ||
                    filterOption.premise_feature.includes('yard_size')
                  "
                >
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("MINIMUM_VALUE") }}
                    </label>
                    <input
                      :placeholder="$t('TYPE_MINIMUM_VALUE')"
                      type="text"
                      class="form-control"
                      v-model="filterOption.minimum_value"
                    />
                  </div>
                </div>
                <div
                  v-if="
                    filterOption.premise_feature.includes('apartment_floor')
                  "
                  class="col-lg-3"
                >
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("APARTMENT_FLOOR") }}
                    </label>
                    <Multiselect
                      :hideSelected="false"
                      mode="multiple"
                      :searchable="true"
                      v-model="filterOption.apartment_floor"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      valueProp="value"
                      :options="apartmentFloors"
                    />
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                      <label style="font-weight: 500" for="exampleInputEmail1">
                        {{ $t("BASIC") }}
                      </label>
                      <button
                        type="button"
                        v-if="filterOptions.length > 1"
                        class="delete-filter"
                        @click="removeFilterOption(index)"
                      >
                        <i class="text-danger fa fa-times"></i>
                      </button>
                    </div>
                    <Multiselect
                      :searchable="true"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      v-model="filterOption.basic"
                      valueProp="value"
                      :options="basics"
                    />
                  </div>
                </div>
              </div>
              <div class="add_variation">
                <a href="" @click.prevent="addFilterOption"
                  ><i class="fa fa-plus"></i>
                  {{ $t("ADD_ANOTHER_FILTER_PATH") }}</a
                >
              </div>
            </div>
          </div>
          <div id="with_photo_url" class="row">
            <div class="col-lg-6">
              <div class="form-container bg-white border border-radius-4 mb-30">
                <div class="create-item">
                  <div class="title mb-4">{{ $t("PRODUCT_URL") }}</div>
                  <div class="form-group">
                    <input
                      :placeholder="$t('TYPE_PRODUCT_URL')"
                      type="text"
                      class="form-control"
                      v-model="v$.url.$model"
                      :class="{
                        'is-invalid': v$.url.$error,
                      }"
                    />
                    <div class="invalid-feedback">
                      <div v-for="error in v$.url.$errors" :key="error">
                        {{ $t("PRODUCT_URL") + " " + $t(error.$validator) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-container bg-white border border-radius-4 mb-30">
                <div class="create-item">
                  <div class="title mb-4">{{ $t("WITH_PHOTO") }}</div>
                  <div class="form-group">
                    <Multiselect
                      :searchable="true"
                      :label="$i18n.locale == 'ar' ? 'name_ar' : 'name_en'"
                      v-model="v$.with_photo.$model"
                      :class="{
                        'is-invalid': v$.with_photo.$error,
                      }"
                      valueProp="value"
                      :options="statuses"
                    />
                    <div class="invalid-feedback">
                      <div v-for="error in v$.with_photo.$errors" :key="error">
                        {{ $t("WITH_PHOTO") + " " + $t(error.$validator) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <button @click="save" class="btn save-submit">
          <i class="fa fa-save"></i>
          {{ $t("SAVE") }}
        </button>
      </div>
      <div class="col-lg-3 order-lg-2 order-1">
        <div
          class="bg-white information-container border border-radius-4 mb-30"
        >
          <div class="information ">
            <div class="title">{{ $t("PRODUCT_INFORMATION") }}</div>
            <ul>
              <a
                id="a__basic-information"
                @click="currentSection = 'basic-information'"
                href="#basic-information"
              >
                <li :class="{ active: currentSection == 'basic-information' }">
                  {{ $t("BASIC_INFORMATION") }}
                </li>
              </a>

              <a id="a__image" @click="currentSection = 'image'" href="#image">
                <li :class="{ active: currentSection == 'image' }">
                  {{ $t("PRODUCT_IMAGES") }}
                </li>
              </a>

              <a
                id="a__category"
                @click="currentSection = 'category'"
                href="#category"
              >
                <li :class="{ active: currentSection == 'category' }">
                  {{ $t("CATEGORY") }}
                </li>
              </a>

              <a
                id="a__filter"
                @click="currentSection = 'filter'"
                href="#filter"
              >
                <li :class="{ active: currentSection == 'filter' }">
                  {{ $t("Product Filter") }}
                </li>
              </a>

              <a
                id="a__with_photo_url"
                @click="currentSection = 'with_photo_url'"
                href="#with_photo_url"
              >
                <li :class="{ active: currentSection == 'with_photo_url' }">
                  {{ $t("WITH_PHOTO_VERIFICATION_AND_URL") }}
                </li>
              </a>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import productClient from "../../../http-clients/admin/product-client";
import { inject, onMounted, reactive, toRefs, watch } from "vue-demi";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import Image from "../../../shared/components/image.vue";
import Multiselect from "@vueform/multiselect";
export default {
  components: {
    Image,
    Multiselect,
  },
  setup(props, context) {
    const route = useRoute();
    const { t, locale } = useI18n({ useScope: "global" });
    const item_store = inject("store");

    const data = reactive({
      isArabic: false,
      filterOptions: [
        {
          premise_type: "",
          category_id: "",
          premise_feature: [],
          minimum_value: 1,
          apartment_floor: [],
          basic: "",
        },
      ],
      premiseTypes: [
        { value: "apartment", name_en: "Apartment", name_ar: "العمارة" },
        { value: "house", name_en: "House", name_ar: "المنزل" },
        { value: "office", name_en: "Office", name_ar: "المكتب" },
        { value: "business", name_en: "Business", name_ar: "العمل" },
      ],
      apartmentFloors: [
        { value: "1st_2nd", name_en: "1st and 2nd", name_ar: "الاول والثاني" },
        { value: "last", name_en: "Last", name_ar: "الاخير" },
        { value: "other", name_en: "Other", name_ar: "اخر" },
      ],
      premiseFeatures: [
        {
          value: "no_of_rooms",
          name_en: "Number of rooms including kitchen",
          name_ar: "عدد الغرف بما في ذلك المطبخ",
        },
        {
          value: "no_of_bathrooms",
          name_en: "Number of bathrooms",
          name_ar: "عدد الحمامات",
        },
        {
          value: "no_of_entrances",
          name_en: "Number of entrances",
          name_ar: "عدد المداخل",
        },
        {
          value: "no_of_floors",
          name_en: "Number of floors",
          name_ar: "عدد الطوابق",
        },
        {
          value: "apartment_floor",
          name_en: "Apartment floor",
          name_ar: "ارضية الشقة",
        },
        {
          value: "yard_size",
          name_en: "Yard size",
          name_ar: "حجم الفناء",
        },
      ],
      blackMediaManager: [],
      whiteMediaManager: [],
      previewImage: "",
      basics: [
        { value: 1, name_ar: "اساسي", name_en: "Basic" },
        { value: 0, name_ar: "متقدم", name_en: "Advanced" },
      ],
      statuses: [
        {
          value: 1,
          name_ar: "مع التحقق بالصورة",
          name_en: "With Photo verification",
        },
        {
          value: 0,
          name_ar: "بدون تحقق بالصورة",
          name_en: "Without Photo verification",
        },
      ],
      titleArExist: false,
      titleEnExist: false,
      categories: [],
      currentSection: "basic-information",
      editor: ClassicEditor,
      editorConfig: {
        language: "",
      },
    });
    const form = reactive({
      name_ar: "",
      name_en: "",
      price:"",
      taxes:"",
      description: "",
      short_description: "",
      base_category_id: [],
      url: "",
      with_photo: 0,
    });
    const rules = {
      name_ar: { required },
      name_en: { required },
      price:{required},
      taxes:{required},
      description: { required },
      short_description: { required },
      base_category_id: { required },
      with_photo: { required },
      url: { required },
    };

    function getForm() {
  console.log(form.value);
  return form;
}

    const v$ = useVuelidate(rules, form);
    onMounted(() => {
      getCategories();
      setForm();
      getForm();
      setScrollTemp();
    });
    //Methods
    function getProtectionTypes() {
      return data.categories;
    }

    function addFilterOption() {
      data.filterOptions.push({
        premise_type: "",
        category_id: "",
        premise_feature: [],
        minimum_value: 1,
        apartment_floor: [],
        basic: "",
      });
    }
    function removeFilterOption(index) {
      data.filterOptions.splice(index, 1);
    }
    function onDeselect() {
      setTimeout(() => {
        form.base_category_id = -1;
      }, 10);
    }
    function setForm() {
      if (route.params.id != "create") {
        productClient.getItem(route.params.id).then((res) => {
          form.name_ar = res.data.name_ar;
          form.name_en = res.data.name_en;
          form.price=res.data.price;
          form.description = res.data.description ?? "";
          form.short_description = res.data.short_description;
          form.base_category_id = res.data.base_category_id;
          data.blackMediaManager = res.data.black_media_manager
            ? [res.data.black_media_manager]
            : [];
          data.whiteMediaManager = res.data.white_media_manager
            ? [res.data.white_media_manager]
            : [];
          form.url = res.data.url;
          form.with_photo = res.data.with_photo;

          data.filterOptions = res.data.filter_setting.length
            ? res.data.filter_setting
            : [
                {
                  premise_type: "",
                  category_id: "",
                  premise_feature: [],
                  minimum_value: 1,
                  apartment_floor: [],
                  basic: "",
                },
              ];
        });
      }
    }
    function setScrollTemp() {
      let linkClicked = false;
      let timeout = null;

      $(document).ready(function () {
        // Add smooth scrolling to all links
        $("a").on("click", function (event) {
          linkClicked = true;
          clearTimeout(timeout);
          timeout = setTimeout(() => {
            linkClicked = false;
          }, 1000);
          // Make sure this.hash has a value before overriding default behavior
          if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $("html, body").animate(
              {
                scrollTop: $(hash).offset().top - 100,
              },
              800,
              function () {
                // Add hash (#) to URL when done scrolling (default click behavior)
                // window.location.hash = hash;
              }
            );
          } // End if
        });
      });
      window.onscroll = function () {
        let tablehashElement = $("#a__basic-information").attr("href");
        let imageHashElement = $("#a__image").attr("href");
        let addhashElement = $("#a__category").attr("href");
        let filterhashElement = $("#a__filter").attr("href");
        let withPhotoBasicElement = $("#a__with_photo_url").attr("href");
        if (linkClicked) return;
        if (
          document.documentElement.scrollTop >=
          $(withPhotoBasicElement).offset().top - 140
        ) {
          data.currentSection = "with_photo_url";
        } else if (
          document.documentElement.scrollTop >=
          $(filterhashElement).offset().top - 140
        ) {
          data.currentSection = "filter";
        } else if (
          document.documentElement.scrollTop >=
          $(addhashElement).offset().top - 140
        ) {
          data.currentSection = "category";
        } else if (
          document.documentElement.scrollTop >=
          $(imageHashElement).offset().top - 140
        ) {
          data.currentSection = "image";
        } else {
          data.currentSection = "basic-information";
        }

        // if (
        //   document.documentElement.scrollTop == $("#add").offset().top - 100 ||
        //   document.documentElement.scrollTop == $("#table").offset().top - 100
        // ) {
        //   linkClicked = false;
        // }
      };
    }
    function getCategories() {
      productClient.getCategories().then((res) => {
        data.categories = res.data;
      });
    }
    function toggleLocale() {
      data.isArabic = !data.isArabic;
    }
    function uploadImage(e) {
      const image = e.target.files[0];
      data.uploadedImage = image;
      const reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        data.previewImage = e.target.result;
      };
    }
    function deleteImage() {
      data.uploadedImage = null;
      data.previewImage = props.selectedItem ? props.selectedItem.image : "";
    }

    function addItem() {
      form.list.push(getElement());
    }

    function removeItem(index) {
      if (form.list.length > 1) {
        form.list.splice(index, 1);
      }
    }
    function save() {
      if (v$.value.$invalid) {
        v$.value.$touch();
        return;
      }
      if (route.params.id == "create") {
        store();
      } else {
        update();
      }
    }
    //Commons
    function store() {
      data.titleArExist = false;
      data.titleEnExist = false;
      productClient
        .store(getForm())
        .then((category) => {
          v$.value.$reset();
          form.name_ar = "";
          form.name_en = "";
          form.price="";
          form.taxes="";
          form.description = "";
          form.short_description = "";
          form.base_category_id = null;
          data.whiteMediaManager = [];
          data.blackMediaManager = [];
          data.isArabic = false;
          form.url = "";
          form.with_photo = 0;
          data.filterOptions = [
            {
              premise_type: "",
              category_id: "",
              premise_feature: [],
              minimum_value: 1,
              apartment_floor: [],
              basic: "",
            },
          ];
          console.log(form.value);
          toast.success(t("CREATED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
        })
        .catch((error) => {
          data.titleArExist = error.response.data.errors.name_ar ? true : false;
          data.titleEnExist = error.response.data.errors.name_en ? true : false;
        });
    }
    function update() {
      data.titleArExist = false;
      data.titleEnExist = false;
      productClient
        .update(getForm())
        .then((category) => {
          data.isArabic = false;
          toast.success(t("UPDATED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
        })
        .catch((error) => {
          data.titleArExist = error.response.data.errors.name_ar ? true : false;
          data.titleEnExist = error.response.data.errors.name_en ? true : false;
        });
    }
    function touchlist() {
      form.list.forEach((item) => {
        item.name_ar_dirty = true;
        item.name_en_dirty = true;
      });
    }
    function getElement() {
      return { name_ar: "", name_en: "" };
    }
    function getForm() {
      return {
        id: route.params.id == "create" ? null : route.params.id,
        black_media_manager_id: data.blackMediaManager.length
          ? data.blackMediaManager[0].id
          : null,
        white_media_manager_id: data.whiteMediaManager.length
          ? data.whiteMediaManager[0].id
          : null,
        name_ar: form.name_ar,
        name_en: form.name_en,
        price:form.price,
        taxes:form.taxes,
        description: form.description,
        short_description: form.short_description,
        base_category_id: form.base_category_id,
        url: form.url,
        with_photo: form.with_photo,
        filter_setting: data.filterOptions,
      };
    }
    function setlistToFormData(formData) {
      form.list.forEach((item, index) => {
        formData.append(`list[${index}][name_ar]`, item.name_ar);
        formData.append(`list[${index}][name_en]`, item.name_en);
      });
    }
    watch(
      () => {
        item_store.dir;
      },
      (value) => {
        const lang = locale.value;
        setTimeout(() => {
          data.editorConfig = {
            language: lang,
          };
        }, 500);
      },
      { deep: true, immediate: true }
    );
    return {
      toggleLocale,
      getCategories,
      onDeselect,
      removeFilterOption,
      ...toRefs(data),
      ...toRefs(form),
      ...toRefs(route),
      getProtectionTypes,
      addFilterOption,
      v$,
      uploadImage,
      deleteImage,
      addItem,
      removeItem,
      save,
    };
  },
  props: ["selectedItem"],
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>

<style lang="scss">
.product-form {
  .multiselect-tags {
    overflow: auto;
  }
  .multiselect.is-invalid {
    border: none !important;
    input {
      border: 1px solid #dc3545 !important;
    }
  }
  .variation-switch {
    display: flex;
    gap: 10px;
    .switch-label {
      font-weight: 500;
      color: #4eb529;
      position: relative;
    }
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 36px;
    height: 18px;
    margin-bottom: 0 !important;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: none;
    -webkit-transition: 0.4s;
    transition: 0.4s;
  }

  .slider::before {
    position: absolute;
    content: "";
    height: 10px;
    width: 10px;
    left: 4px;
    bottom: 3px;
    background-color: #ccc;
    -webkit-transition: 0.4s;
    transition: 0.4s;
  }

  input:checked + .slider {
    background-color: #4eb529;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #4eb529;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(15px);
    -ms-transform: translateX(15px);
    transform: translateX(15px);
    background: white;
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  } // centering

  .ck-editor__editable {
    min-height: 140px;
  }
  iframe {
    height: 150px !important;
  }
  textarea.form-control {
    padding: 10px !important;
    height: 120px !important;
  }
  .media-manager .head-title {
    font-size: 15px !important;
  }
  .media-manager .close-media i {
    font-size: 16px !important;
  }
  .basic-info-sec {
    padding-bottom: 400px;
  }
  .information-container {
    position: sticky;
    top: 90px;
  }
  .multiselect {
    padding: 1px 0 !important;
  }

  .multiselect-tag,
  .is-selected,
  .is-pointed {
    color: #454f5b !important;
    background: rgb(244, 246, 248) !important;
  }
  body[dir="rtl"] & {
    * {
      font-size: 12.5px !important;
    }
    .variation-switch {
      .switch-label {
        bottom: 1px;
        font-size: 14px !important;
      }
    }

    .text-mute {
      margin-top: 5px;
      color: #919eab !important;
      font-size: 11px !important;
    }
    .form-group {
      label {
        font-size: 12.8px !important;
      }
    }
    .multiselect-placeholder {
      font-size: 12.5px !important;
    }
    .form-control {
      font-size: 12px !important;
    }
    .form-control::placeholder {
      font-size: 11.5px;
    }
    input.form-control::placeholder {
      padding: 10px 0;
    }

    .multiselect-tag {
      font-weight: 500;
    }
    .locale {
      border-radius: 5px;
      padding: 3px 7px;
      position: relative;
      color: #fcac00;
      font-size: 9px !important;
      bottom: 1px;
      &:hover {
        color: #fcac00 !important;
        background: rgba(252, 172, 0, 0.15);
      }
    }
    .form-group {
      label {
        font-weight: 400 !important;
      }
    }
    table {
      th {
        font-weight: 450;
      }
      th,
      td {
        font-size: 12px !important;
      }
    }

    .def-loc {
      border-radius: 5px;
      padding: 3px 1px;
      color: #fcac00;
      font-size: 10px !important;
    }
    .title {
      font-size: 15px !important;
      color: #212b36;
      font-weight: 550;
    }
    .search {
      i {
        right: 17px !important;
      }
    }

    .actions-cell .dropdown-menu {
      position: absolute !important;
      transform: translate3d(103px, -43px, 0px) !important;
      top: 0px !important;
      left: 0px !important;
      width: 100px;
      will-change: transform !important;
    }
    .breadcrumb-item + .breadcrumb-item::before {
      font-family: "FontAwesome";
      content: "\f104" !important;
    }

    .information {
      a * {
        font-size: 13px !important;
      }
      ul {
        padding: 0 30px 0 0px;
        position: relative;
        margin-top: 25px;
      }
      li::before {
        height: 12px;
        position: absolute;
        width: 12px;
        content: "";
        background: #dfe3e8;
        border-radius: 50%;
        top: 4px;
        right: -23px;
      }
      ul::before {
        position: absolute;
        display: block;
        content: "";
        top: 14px;
        height: 100%;
        width: 2px;
        right: 12px;
        background: #dfe3e8;
      }

      li.active::before {
        width: 10px;
        height: 10px;
        background: #4eb529;
        right: -25px;
        box-sizing: content-box;
        outline: 1px solid #4eb529;
        border: 3px solid #fff;
      }
      li.active {
        color: #4eb529;
      }

      li {
        position: relative;
        margin-bottom: 15px;
      }
      padding: 15px 15px 20px 15px;
    }
  }
  body[dir="ltr"] & {
    * {
      font-size: 13px !important;
    }
    .variation-switch {
      .switch-label {
        bottom: 3px;
        font-size: 14px !important;
      }
    }
    .def-loc {
      border-radius: 5px;
      padding: 3px 1px;
      color: #fcac00;
      font-size: 11px !important;
    }
    .text-mute {
      margin-top: 5px;
      color: #919eab !important;
      font-size: 11.5px !important;
    }
    .form-control {
      font-size: 13px !important;
      font-weight: 500;
    }
    .form-control::placeholder {
      font-size: 12.5px;
    }
    .locale {
      border-radius: 5px;
      padding: 3px 7px;
      position: relative;
      color: #fcac00;
      font-size: 10px !important;
      bottom: 1px;
      &:hover {
        color: #fcac00 !important;
        background: rgba(252, 172, 0, 0.15);
      }
    }

    .title {
      font-size: 17px !important;
      color: #212b36;
      font-weight: 600;
    }
    .search {
      i {
        left: 17px !important;
      }
    }
    .information {
      ul {
        padding: 0 30px;
        position: relative;
        margin-top: 25px;
      }
      li::before {
        height: 11px;
        position: absolute;
        width: 12px;
        content: "";
        background: #dfe3e8;
        border-radius: 50%;
        top: 3px;
        left: -23px;
      }
      ul::before {
        position: absolute;
        display: block;
        content: "";
        top: 14px;
        height: 100%;
        width: 2px;
        left: 12px;
        background: #dfe3e8;
      }

      li.active::before {
        width: 10px;
        height: 10px;
        background: #4eb529;
        left: -25px;
        box-sizing: content-box;
        outline: 1px solid #4eb529;
        border: 3px solid #fff;
      }
      li.active {
        color: #4eb529;
      }

      li {
        position: relative;
        margin-bottom: 15px;
      }
      padding: 15px 15px 20px 15px;
    }
  }
  .delete-filter {
    position: relative;
    bottom: 6px;
    border: none;
    background: none;
  }
  .page-header {
    box-shadow: none;
    margin-bottom: 19px !important;
  }
  .save-submit {
    background: #4eb529;
    color: #fff;
    margin-bottom: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 110px;
    gap: 12px;
    justify-content: center;
    padding: 10px 0;
    border-radius: 5px;
  }
  .form-container {
    padding: 20px 20px 30px 20px;
    border-radius: 5px;
  }
  #brand_unit .form-container {
    padding: 20px 20px 0 20px !important;
  }
  .form-control {
    padding: 21px 10px !important;
  }
  .information {
    a * {
      font-size: 14px !important;
    }
    ul {
      padding: 0 30px;
      position: relative;
      margin-top: 25px;
    }

    li {
      position: relative;
      margin-bottom: 15px;
    }
    padding: 15px 15px 20px 15px;
  }
  .add_variation {
    margin-bottom: 30px;
    a {
      font-size: 14px !important;
      color: #4eb529;
    }
  }
}
</style>
