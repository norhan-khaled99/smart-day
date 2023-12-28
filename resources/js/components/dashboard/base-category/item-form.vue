<template>
  <div class="base-category-form">
    <div class="page-header border" style="margin-top: 10px">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            {{ $t("UPDATE_CATEGORY") }}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div
        class="col-lg-9 order-lg-1 order-2"
        :style="
          $i18n.locale == 'en' ? 'padding-right:10px' : 'padding-left:10px'
        "
      >
        <div
          id="basic-information"
          class="form-container bg-white border border-radius-4 mb-30"
        >
          <div class="create-item">
            <div class="title mb-4">{{ $t("BASIC_INFORMATION") }}</div>
            <form>
              <div class="row">
                <div v-if="isArabic" class="col-lg-12 mb-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("CATEGORY_NAME") }}
                      <a class="locale" href="" @click.prevent="toggleLocale">
                        {{ $t("ARABIC") }}
                      </a>
                    </label>
                    <input
                      :placeholder="$t('TYPE_CATEGORY')"
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
                  </div>
                </div>
                <div v-else class="col-lg-12 mb-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">
                      {{ $t("CATEGORY_NAME") }}
                      <a class="locale" href="" @click.prevent="toggleLocale">
                        {{ $t("ENGLISH") }}
                      </a>
                    </label>
                    <input
                      :placeholder="$t('TYPE_CATEGORY')"
                      type="text"
                      class="form-control"
                      v-model="v$.name_en.$model"
                      :class="{
                        'is-invalid': v$.name_en.$error || titleArExist,
                      }"
                    />
                    <div class="invalid-feedback">
                      <div v-for="error in v$.name_en.$errors" :key="error">
                        {{ $t("NAME") + " " + $t(error.$validator) }}
                      </div>
                      <div v-if="!v$.name_en.$invalid && titleArExist">
                        {{ $t("NAME") + " " + $t("EXIST") }}
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
            </form>
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
                  :id="2"
                  title="Thumbnail_592_592"
                  subTitle="CHOOSE_CATEGORY_THUMBNAIL"
                  :selectedMedia="selectedMedia"
                  @selectedMedia="selectedMedia = $event"
                  :singleSelect="true"
                />
              </div>
            </div>
          </div>
        </div>
        <button @click="save" class="btn btn-primary save-submit">
          <i class="fa fa-save"></i>
          {{ $t("SAVE") }}
        </button>
      </div>
      <div class="col-lg-3 order-lg-2 order-1">
        <div
          class="information-container bg-white border border-radius-4 mb-30"
        >
          <div class="information">
            <div class="title">{{ $t("CATEGORY_INFORMATION") }}</div>
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
                  {{ $t("CATEGORY_IMAGE") }}
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
import baseCategoryClient from "../../../http-clients/admin/base-category-client";
import { computed, inject, onMounted, reactive, toRefs, watch } from "vue-demi";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import Image from "../../../shared/components/image.vue";
export default {
  components: {
    Image,
  },
  setup(props, context) {
    const route = useRoute();
    const { t, locale } = useI18n({ useScope: "global" });
    const item_store = inject("item_store");
    const data = reactive({
      isArabic: false,
      currentSection: "basic-information",
      uploadedImage: null,
      selectedMedia: [],
      previewImage: "",
      titleArExist: false,
      titleEnExist: false,
      editor: ClassicEditor,
      editorConfig: {
        language: "",
      },
    });
    const form = reactive({
      name_ar: "",
      name_en: "",
      description: "",
    });
    const rules = {
      name_ar: { required },
      name_en: { required },
      description: { required },
    };
    const v$ = useVuelidate(rules, form);
    onMounted(() => {
      baseCategoryClient.getItem(route.params.id).then((res) => {
        form.name_ar = res.data.name_ar;
        form.name_en = res.data.name_en;
        form.description = res.data.description;
        data.selectedMedia = res.data.media_manager
          ? [res.data.media_manager]
          : [];
      });
      setScrollTemp();
    });
    //Methods
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
        if (linkClicked) return;
        if (
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
      update();
    }
    //Commons
    function store() {
      data.titleArExist = false;
      data.titleEnExist = false;
      baseCategoryClient
        .store(getForm())
        .then((response) => {
          context.emit("created", response.data);
          $("#itemFormModal").modal("hide");
        })
        .catch((error) => {
          data.titleArExist = error.response.data.errors.name_ar ? true : false;
          data.titleEnExist = error.response.data.errors.name_en ? true : false;
        });
    }
    function update() {
      data.titleArExist = false;
      data.titleEnExist = false;
      baseCategoryClient
        .update(getForm())
        .then((response) => {
          data.isArabic = false;
          toast.success(t("UPDATED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });
          context.emit("updated", response.data);
          $("#itemFormModal").modal("hide");
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
        id: route.params.id,
        media_manager_id: data.selectedMedia.length
          ? data.selectedMedia[0].id
          : null,
        name_ar: form.name_ar,
        name_en: form.name_en,
        description: form.description,
      };
    }
    function setlistToFormData(formData) {
      form.list.forEach((item, index) => {
        formData.append(`list[${index}][name_ar]`, item.name_ar);
        formData.append(`list[${index}][name_en]`, item.name_en);
      });
    }
    function setForm() {
      v$.value.$reset();
      form.list = props.selectedItem
        ? _.clone(props.selectedItem.list)
        : [getElement()];
      form.name_ar = props.selectedItem ? props.selectedItem.name_ar : "";
      form.name_en = props.selectedItem ? props.selectedItem.name_en : "";
      data.previewImage = props.selectedItem ? props.selectedItem.image : "";
      data.uploadedImage = null;
      data.titleArExist = false;
      data.titleEnExist = false;
    }
    //Watchers
    // watch(
    //   () => {
    //     item_store.onFormShow;
    //   },
    //   (value) => {
    //     setForm();
    //   },
    //   { deep: true }
    // );
    return {
      toggleLocale,
      ...toRefs(data),
      ...toRefs(form),
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

<style lang="scss">
.base-category-form {
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
        top: 4px;
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
