<template>
  <div class="assemble-kit-result-container section-bg">
    <!-- ======= Breadcrumbs ======= -->
    <div
      class="notification-service breadcrumbs d-flex align-items-center"
      style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
    >
      <div
        class="container position-relative d-flex flex-column align-items-center"
        data-aos="fade"
      >
        <h2>{{ $t("Configure device set") }}</h2>
        <ol>
          <li>
            <router-link to="/home">{{ $t("HOME") }}</router-link>
          </li>
          <li>{{ $t("Configure device set") }}</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="assemble-kit-result" class="assemble-kit">
      <div class="container">
        <div @click="routeToSteps" class="back">
          <i
            :class="
              $i18n.locale == 'en'
                ? 'fa fa-long-arrow-left'
                : 'fa fa-long-arrow-left'
            "
            aria-hidden="true"
          ></i>
          <span>{{ $t("BACK") }}</span>
        </div>
        <div :class="{ pdf: pdfStyle }" id="element-to-convert">
          <div class="intro">
            <h1 class="head">{{ $t("Your security system") }}</h1>
            <div class="basic-advanced text-center">
              <button @click="onBasicChanged(true)" :class="{ active: basic }">
                {{ $t("BASIC") }}
              </button>
              <button
                @click="onBasicChanged(false)"
                :class="{ active: !basic }"
              >
                {{ $t("ADVANCED") }}
              </button>
            </div>
            <p class="text-center">
              <template v-if="basic">
                {{
                  $t(
                    "This set includes devices building the baseline to protect you from chosen threats.If you want enhanced protection, switch to the Advanced."
                  )
                }}
              </template>
              <template v-else>
                {{
                  $t(
                    "With this set, you are under maximum protection. It includes detectors with additional sensors and a more powerful control panel."
                  )
                }}
              </template>
            </p>
          </div>
          <div class="options">
            <div class="option-1">
              <div class="color">
                <label :style="whiteColor ? 'color:#b7b7b7' : ''">{{
                  $t("BLACK")
                }}</label>
                <label class="switch">
                  <input
                    :checked="whiteColor"
                    v-model="whiteColor"
                    type="checkbox"
                  />
                  <span class="slider round"></span>
                </label>
                <label :style="!whiteColor ? 'color:#b7b7b7' : ''">{{
                  $t("WHITE")
                }}</label>
              </div>
              <div
                @click="onWithPhotoChanged"
                :class="{ active: withPhoto }"
                class="photo-verification"
              >
                <span class="checkbox-inpt">
                  <i class="fa fa-check"></i>
                </span>
                <div class="with_photo">
                  {{ $t("With photo verification of alarms") }}
                  <span>
                    <i class="fa fa-info"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="option-2">
              <a href="https://sd.sa/" target="__blank" class="get-it-now">
                <i class="fa fa-store"></i>
                <span>{{ $t("GET_IT_NOW") }}</span>
              </a>

              <button @click="exportToPDF">
                <i class="fa fa-download"></i>
                <span>{{ $t("DOWNLOAD_PDF") }}</span>
              </button>
            </div>
          </div>
          <div class="hub-container mt-3">
            <div class="hub">
              <div class="image-title">
                <div class="image">
                  <img
                    :src="`/images/assemble-kit-result/hub/${
                      whiteColor ? 'white.png' : 'black.png'
                    }`"
                  />
                </div>
                <div class="title">
                  <h4>
                    {{
                      $i18n.locale == "ar"
                        ? currentHub.name_ar
                        : currentHub.name_en
                    }}
                  </h4>
                  <div class="desc">{{ currentHub.description }}</div>
                </div>
              </div>
              <div class="info">
                <div class="desc">{{ currentHub.description }}</div>
                <div class="fst-info info">
                  <ul>
                    <li v-if="currentHub.ethernet == 1">
                      <img src="/images/assemble-kit-result/hub/1.svg" />
                      {{ $t("Ethernet") }}
                    </li>
                    <li v-if="currentHub.wifi == 1">
                      <img src="/images/assemble-kit-result/hub/2.svg" />
                      {{ $t("Wifi") }}
                    </li>
                    <li v-if="currentHub.sim == '2G'">
                      <img src="/images/assemble-kit-result/hub/3.svg" /> 2G
                    </li>
                    <li
                      v-if="
                        currentHub.sim == '2G/3G' ||
                        currentHub.sim == '2G/3G/4G(LTE)'
                      "
                    >
                      <img src="/images/assemble-kit-result/hub/4.svg" />
                      {{ currentHub.sim }}
                    </li>
                  </ul>
                </div>
                <div class="sec-info info">
                  <ul>
                    <li>
                      <img src="/images/assemble-kit-result/hub/5.svg" />
                      {{ $t("Scenarios") }} : <b>{{ currentHub.scenarios }}</b>
                    </li>
                    <li>
                      <img src="/images/assemble-kit-result/hub/6.svg" />
                      {{ $t("Cameras/DVRs") }} : <b>{{ currentHub.cameras }}</b>
                    </li>
                    <li>
                      <img src="/images/assemble-kit-result/hub/7.svg" />
                      {{ $t("Users") }} :
                      <b>{{ currentHub.users }}</b>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="selected-items-container">
            <template v-for="category in categories" :key="category.id">
              <template v-for="item in category.products" :key="item.id">
                <div v-if="item.selected" class="item">
                  <button @click="item.selected = false" class="close-item">
                    <i class="fa fa-times"></i>
                  </button>
                  <div class="image-info">
                    <div class="image">
                      <img
                        v-if="!whiteColor"
                        :src="
                          item.black_media_manager
                            ? `/uploads/${item.black_media_manager.hash_name}`
                            : '/images/placeholder-thumb.png'
                        "
                      />
                      <img
                        v-if="whiteColor"
                        :src="
                          item.white_media_manager
                            ? `/uploads/${item.white_media_manager.hash_name}`
                            : '/images/placeholder-thumb.png'
                        "
                      />
                    </div>

                    <div class="info">
                      <h6>
                        {{ $i18n.locale == "ar" ? item.name_ar : item.name_en }}
                      </h6>
                      <div v-html="item.short_description" class="desc"></div>
                    </div>
                  </div>
                  <div class="input">
                    <div @click="decrement(item)" class="decrement">
                      <i class="fas fa-minus"></i>
                    </div>
                    <input @blur="onModelChange(item)" v-model="item.value" />
                    <div @click="increment(item)" class="increment">
                      <i class="fas fa-plus"></i>
                    </div>
                  </div>
                  <div class="pdf-text">
                    {{ item.value }}
                  </div>
                </div>
              </template>
            </template>
          </div>
        </div>
        <div class="products-container">
          <h1 class="text-center">
            {{ $t("Boost Security with Extra Devices") }}
          </h1>
          <template v-for="category in categories" :key="category.id">
            <template v-if="category.products.length">
              <div class="category">
                <div class="image">
                  <img :src="`/images/categories/${category.image}`" />
                </div>
                <h5>
                  {{
                    $i18n.locale == "ar" ? category.name_ar : category.name_en
                  }}
                </h5>
              </div>
              <div
                v-for="item in category.products"
                :key="item.id"
                class="product"
              >
                <button @click="item.selected = false" class="close-item">
                  <i class="fa fa-times"></i>
                </button>

                <div class="image-info">
                  <div class="image">
                    <img
                      v-if="!whiteColor"
                      :src="
                        item.black_media_manager
                          ? `/uploads/${item.black_media_manager.hash_name}`
                          : '/images/placeholder-thumb.png'
                      "
                    />
                    <img
                      v-if="whiteColor"
                      :src="
                        item.white_media_manager
                          ? `/uploads/${item.white_media_manager.hash_name}`
                          : '/images/placeholder-thumb.png'
                      "
                    />
                  </div>
                  <div class="title">
                    <h6>
                      {{ $i18n.locale == "ar" ? item.name_ar : item.name_en }}
                    </h6>
                    <div v-html="item.description" class="desc"></div>
                  </div>
                </div>
                <div>
                  <div v-if="!item.selected" class="add">
                    <button
                      @click="
                        item.selected = true;
                        item.value = 1;
                      "
                    >
                      <i class="fa fa-plus"></i>
                      <span>{{ $t("Add") }}</span>
                    </button>
                  </div>
                  <div v-else class="input">
                    <div @click="decrement(item)" class="decrement">
                      <i class="fas fa-minus"></i>
                    </div>
                    <input @blur="onModelChange(item)" v-model="item.value" />
                    <div @click="increment(item)" class="increment">
                      <i class="fas fa-plus"></i>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </template>
        </div>
      </div>
    </section>
    <!-- End Contact Section -->
  </div>
</template>

<script>
import html2pdf from "html2pdf.js";

import { onMounted, reactive, toRefs } from "vue";
import productClient from "../../../http-clients/web/product-client";
import { useRouter } from "vue-router";
export default {
  setup() {
    const router = useRouter();
    const data = reactive({
      basic: true,
      pdfStyle: false,
      whiteColor: false,
      withPhoto: false,
      hubs: [],
      currentHub: {},
      categories: [],
      premiseTypeValue: localStorage.getItem("premiseTypeValue"),
      protectionTypeValues: JSON.parse(
        localStorage.getItem("protectionTypeValues")
      ),
      premiseFeatures: JSON.parse(localStorage.getItem("premiseFeatures")),
    });
    onMounted(() => {
      productClient.getHubs().then((res) => {
        data.hubs = res.data;
        getHub();
      });
      productClient.getCategories().then((res) => {
        filterProducts(res.data);
      });
    });
    function exportToPDF() {
      data.pdfStyle = true;
      html2pdf(document.getElementById("element-to-convert"), {
        margin: 10,
        filename: "sd-configorator.pdf",
      });
      setTimeout(() => {
        data.pdfStyle = false;
      }, 500);
    }
    function routeToSteps() {
      router.push("/assemble-kit");
    }
    function filterProducts(categories) {
      data.categories = categories.map((cat) => {
        cat.products = cat.products.map((product) => {
          product.selected = data.withPhoto ? product.with_photo == 1 : false;
          product.value = data.withPhoto && product.with_photo ? 1 : 0;
          data.protectionTypeValues.forEach((pType) => {
            let premiseFeatures = getPremiseFeature(pType);
            premiseFeatures.forEach((pF) => {
              product.filter_setting.forEach((fs) => {
                if (
                  pF.id == "apartment_floor" &&
                  fs.premise_feature.includes(pF.id) &&
                  fs.apartment_floor.includes(pF.value) &&
                  fs.premise_type == data.premiseTypeValue &&
                  fs.category_id == pType &&
                  fs.basic == data.basic
                ) {
                  product.selected = true;
                  product.value += 1;
                } else if (
                  pF.id == "yard_size" &&
                  fs.premise_feature.includes(pF.id) &&
                  pF.value >= parseInt(fs.minimum_value) &&
                  fs.premise_type == data.premiseTypeValue &&
                  fs.category_id == pType &&
                  fs.basic == data.basic
                ) {
                  product.selected = true;
                  product.value += 1;
                } else if (
                  fs.premise_feature.includes(pF.id) &&
                  fs.premise_type == data.premiseTypeValue &&
                  fs.category_id == pType &&
                  pF.id !== "yard_size" &&
                  pF.id !== "apartment_floor" &&
                  fs.basic == data.basic
                ) {
                  product.selected = true;
                  product.value += pF.value;
                }
              });
            });
          });
          return product;
        });
        return cat;
      });
    }
    function getPremiseFeature(pType) {
      return data.premiseFeatures.filter((pFeature) => {
        let result = pFeature.pathes.filter((path) => {
          return (
            (path.premise_type_value == "all" &&
              path.protection_type_value == pType) ||
            (path.premise_type_value == data.premiseTypeValue &&
              path.protection_type_value == pType)
          );
        });
        return result.length;
      });
    }
    function onBasicChanged(value) {
      data.basic = value;
      getHub();
      filterProducts(data.categories);
    }
    function onWithPhotoChanged() {
      data.withPhoto = !data.withPhoto;
      getHub();
      filterProducts(data.categories);
    }
    function getHub() {
      let hubs = data.hubs.filter((hub) => {
        return hub.basic == data.basic && hub.with_photo == data.withPhoto;
      });
      data.currentHub = hubs[0];
    }
    function increment(item) {
      item.value++;
    }
    function onModelChange(item) {
      setTimeout(() => {
        item.value = item.value <= 0 ? 1 : item.value;
      }, 100);
    }
    function decrement(item) {
      item.value--;
      if (item.value <= 0) {
        item.value = 1;
      }
    }
    return {
      onBasicChanged,
      onWithPhotoChanged,
      ...toRefs(data),
      exportToPDF,
      routeToSteps,
      onModelChange,
      increment,
      decrement,
    };
  },
};
</script>

<style lang="scss">
.pdf-text {
  display: none;
}
.close-item {
  color: #adadad;
  border: none;
  position: absolute;
  background: none;
  top: 4px;
  font-size: 18px;
}
.selected-items-container {
  .item {
    position: relative;

    .image-info {
      gap: 20px;
      align-items: center;
      display: flex;
    }
    align-items: center;
    display: flex;
    justify-content: space-between;
    background: #fff;
    margin-top: 21px;
    padding: 18px 32px;
    border-radius: 15px;
    img {
      border-radius: 0 !important;
      height: 50px;
      width: 50px;
    }
    .info {
      h5 {
        color: #181818;
      }
      .desc {
        color: #5e5e5e;
        font-size: 14px;
      }
    }
  }
}
.photo-verification {
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 16px;
  .checkbox-inpt {
    i {
      color: #fff;
    }
    transition: 0.1s all;
    border: 2px solid var(--color-primary);
    height: 24px;
    width: 24px;
    background: #fff;
  }
  .with_photo {
    color: #181818;
    font-weight: 550;
    font-size: 14px;
    span {
      text-align: center;
      display: flex;
      color: #20b785;
      margin: 0 11px;
      display: inline-block;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      border: 1px solid #20b785;
    }
  }
  &.active {
    .checkbox-inpt {
      border: 8px solid var(--color-primary);
      background: var(--color-primary);
      display: flex;
      justify-content: center;
      align-items: center;
      i {
        font-weight: 600;
        color: #181818;
      }
    }
  }
}

.options {
  margin-top: 70px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  .option-1 {
    display: flex;
    align-items: center;
    gap: 35px;
    .color {
      font-weight: 500;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 11px;
    }
  }
  .option-2 {
    display: flex;
    gap: 10px;
    button,a {
      background: none;
      border: 1px solid #181818;
      padding: 8px 28px;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 11px;
      transition: 0.5s;
      &:hover {
        background: #181818;
        color: #fff;
      }
    }
    .get-it-now {
      border: none;
      color: #fff;
      background: var(--color-primary);
    }
  }
}
.switch {
  position: relative;
  display: inline-block;
  width: 24px;
  height: 13px;
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
  background-color: #adadad;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 8px;
  width: 8px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  transition: 0.1s;
  -webkit-transition: 0.1s;
}

input:checked + .slider {
  background-color: #adadad;
}

input:focus + .slider {
  box-shadow: 0 0 1px #adadad;
}

input:checked + .slider:before {
  -webkit-transform: translateX(8px);
  -ms-transform: translateX(8px);
  transform: translateX(8px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
} // centering
body[dir="rtl"] .assemble-kit-result-container {
  .input {
    .increment {
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }
    .decrement {
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
  }
  .info {
    margin-top: 15px;
    ul {
      font-size: 13.5px;
    }
  }
  .close-item {
    left: 7px;
  }
  input:checked + .slider:before {
    -webkit-transform: translateX(-8px);
    -ms-transform: translateX(-8px);
    transform: translateX(-8px);
  }
  .basic-advanced {
    button {
      font-size: 12.5px;
    }
  }
  .slider:before {
    right: 4px;
  }
  .photo-verification {
    .with_photo {
      position: relative;
      bottom: 2px;
      span {
        position: relative;
        top: 2px;
        i {
          position: relative;
          bottom: 2px;
        }
      }
    }
  }
}
body[dir="ltr"] .assemble-kit-result-container {
  .input {
    .increment {
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
    .decrement {
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }
  }
  .close-item {
    right: 7px;
  }
}

.intro {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  p {
    color: #5e5e5e;
    margin: 28px 170px 0 170px;
    font-size: 16px;
  }
  .basic-advanced {
    display: flex;
    justify-content: center;
    gap: 10px;
    border: 1px solid #181818;
    border-radius: 50px;
    padding: 8px 25px;
    button {
      font-weight: 600;
      border: none;
      border-radius: 50px;
      font-size: 13.5px;
      background: none;
      color: #181818;
      &.active {
        background: #181818;
        color: #fff;
        padding: 4px 15px;
      }
    }
  }
}

.container {
  position: relative;
}
.head {
  margin-bottom: 16px;
  color: #181818;
}
.back {
  &:hover {
    cursor: pointer;
  }
  color: #181818;
  gap: 8px;
  display: flex;
  align-items: center;
  font-size: 14px;
  font-weight: 600;
  i {
    position: relative;
    top: 1px;
  }
}
.products-container {
  h1 {
    margin-top: 50px;
    margin-bottom: 40px;
    color: #181818;
  }
  .category {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 25px;
    margin-top: 45px;
    .image {
      border-radius: 50%;
      width: 80px;
      height: 80px;
      background: #ededed;
      display: flex;
      align-items: center;
      justify-content: center;
      img {
        border-radius: 50%;
        width: 43px;
        height: 43px;
      }
    }
    h5 {
      color: #181818;
    }
  }
  .product {
    margin-bottom: 18px;
    position: relative;
    border: 2px dashed #c7c7c7;
    background: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 32px;
    border-radius: 15px;
    .image-info {
      display: flex;
      gap: 25px;
    }
    .image {
      img {
        width: 50px;
        height: 50px;
        border-radius: 0;
      }
    }
    .add {
      button {
        border-radius: 50px;
        background: none;
        border: 1px solid #00ad74;
        color: #00ad74;
        padding: 4px 35px;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
      }
    }
    .desc {
      p {
        margin: 0;
        padding: 0;
      }
      color: #5e5e5e;
      font-size: 14px;
    }
  }
}
.hub {
  .title {
    .desc {
      display: none;
    }
  }
  .image-title {
    h4 {
      margin-top: 22px;
    }
    display: flex;
    gap: 36px;
    color: #181818;
    img {
      object-fit: contain;
      border-radius: 0 !important;
      height: 125px;
      width: 125px;
    }
  }
  display: flex;
  gap: 80px;
  margin-top: 50px;
  padding: 21px;
  background: #fff;
  border-radius: 15px;
  .desc {
    color: #5e5e5e;
    font-size: 14px;
  }
  .info {
    margin-top: 15px;
    ul {
      font-size: 14px;
      color: #ada7a7;
      list-style: none;
      padding: 0;
      margin: 14px 0 0 0;
      display: flex;
      gap: 20px;
    }
  }
}
.input {
  align-items: center;
  display: flex;
  input {
    border: none;
    border-top: 1px solid #dbdbdb;
    border-bottom: 1px solid #dbdbdb;
    width: 50px;
    height: 35px;
    text-align: center;
    font-weight: bold;
  }
  .increment,
  .decrement {
    &:hover {
      cursor: pointer;
    }
  }
  .increment {
    font-size: 14px;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border: 1px solid #dbdbdb;
  }
  .decrement {
    font-size: 14px;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border: 1px solid #dbdbdb;
  }
}
.pdf {
  .input {
    display: none;
  }
  .pdf-text {
    display: block;
    font-size: 14px;
  }
  .options {
    display: none;
  }
  .intro {
    .head {
      font-size: 30px !important;
    }
    p {
      font-size: 12.5px;
      margin: 10px 120px 0 120px;
    }
  }
  .basic-advanced {
    display: none !important;
  }
  .hub {
    border: 1px solid #dee2e6;
    .info li,
    .desc {
      font-size: 12px;
    }
    .title h4 {
      font-size: 18px;
    }
    .info {
      li img {
        width: 30px;
        height: 30px;
      }
    }
    .image-title img {
      width: 80px;
      height: 80px;
    }
  }
  .item {
    border: 1px solid #dee2e6;
    .info {
      h6 {
        font-size: 15px;
      }
      .desc {
        font-size: 12px;
      }
    }
    .close-item {
      opacity: 0;
    }
  }
}

@media (max-width: 767px) {
  .item,
  .product {
    flex-direction: column;
    align-items: flex-start !important;
    justify-content: flex-start !important;
    gap: 20px;
  }
}
@media (max-width: 991px) {
  .hub {
    flex-wrap: wrap;
    gap: 0;
    .info {
      ul {
        flex-wrap: wrap;
        gap: 8px;
      }
      .desc {
        display: none;
      }
    }
    .title {
      .desc {
        display: block;
      }
    }
  }
  .head {
    margin-top: 30px;
    font-size: 30px;
  }
  .intro {
    p {
      margin: 28px 0 0 0 !important;
    }
  }
  .options {
    .option-1 {
      flex-direction: column;
      align-items: center;
    }
    gap: 35px;

    align-items: center;
    flex-direction: column;
  }
}
</style>