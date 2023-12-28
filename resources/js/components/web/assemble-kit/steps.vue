<template>
  <div class="steps-container section-bg">
    <!-- ======= Breadcrumbs ======= -->
    <div
      class="notification-service breadcrumbs d-flex align-items-center"
      style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
    >
      <div
        class="container position-relative d-flex flex-column align-items-center"
        data-aos="fade"
      >
        <h2>{{ $t("ASSEMBLE_KIT") }}</h2>
        <ol>
          <li>
            <router-link to="/home">{{ $t("HOME") }}</router-link>
          </li>
          <li>{{ $t("ASSEMBLE_KIT") }}</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="assemble-kit" class="assemble-kit">
      <div class="container">
        <h2 class="assemble-head text-center">
          {{ $i18n.locale == "ar" ? currentStep.name_ar : currentStep.name_en }}
        </h2>
        <div class="steps">
          <ul>
            <li v-for="step in steps" :key="step.id">
              <a
                href="#assemble-kit"
                @click="toStep(step.index)"
                class="step-item"
              >
                <span
                  class="number"
                  :class="{
                    'prev-active': step.index < currentStep.index,
                    active: step.index == currentStep.index,
                  }"
                  >{{ step.index }}</span
                >
                <span class="text d-none d-lg-block">{{
                  $i18n.locale == "ar" ? step.name_ar : step.name_en
                }}</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="steps-panels">
          <div class="step-panel" :class="{ hide: currentStep.index != 1 }">
            <div class="row">
              <div
                v-for="premiseType in premiseTypes"
                :key="premiseType.value"
                class="col-lg-6 mb-4"
              >
                <div
                  class="type"
                  :class="{ active: premiseTypeValue == premiseType.value }"
                  @click="premiseTypeValue = premiseType.value"
                >
                  <div class="choose">
                    <span class="radio-inpt"></span>
                    <h5>
                      {{
                        $i18n.locale == "ar"
                          ? premiseType.name_ar
                          : premiseType.name_en
                      }}
                    </h5>
                  </div>

                  <div class="image">
                    <img :src="premiseType.image" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="step-panel" :class="{ hide: currentStep.index != 2 }">
            <div class="row">
              <template
                v-for="protectionType in protectionTypes"
                :key="protectionType.id"
              >
                <div
                  v-if="
                    !(premiseTypeValue == 'apartment' && protectionType.id == 4)
                  "
                  class="col-lg-6 mb-4"
                >
                  <div
                    class="type"
                    :class="{
                      active: protectionTypeValues.includes(protectionType.id),
                    }"
                    @click="chooseProtectionTypes(protectionType.id)"
                  >
                    <div class="choose">
                      <span class="checkbox-inpt">
                        <i class="fa fa-check"></i>
                      </span>
                      <h5>
                        {{
                          $i18n.locale == "ar"
                            ? protectionType.name_ar
                            : protectionType.name_en
                        }}
                      </h5>
                    </div>

                    <div class="image">
                      <img
                        :src="`/images/categories/${protectionType.image}`"
                      />
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>
          <div class="step-panel" :class="{ hide: currentStep.index != 3 }">
            <div class="row justify-content-center">
              <div
                v-for="(feature, index) in premiseFeatures"
                :key="feature.id"
                class="col-lg-4 col-md-6 mb-4"
              >
                <div class="type">
                  <div class="">
                    <div class="choose mb-3">
                      <h5>
                        {{
                          $i18n.locale == "ar"
                            ? feature.name_ar
                            : feature.name_en
                        }}
                      </h5>
                    </div>
                    <div v-if="feature.id != 'apartment_floor'" class="input">
                      <div @click="decrement(feature)" class="decrement">
                        <i class="fas fa-minus"></i>
                      </div>
                      <input v-model="feature.value" />
                      <div @click="increment(feature)" class="increment">
                        <i class="fas fa-plus"></i>
                      </div>
                    </div>
                    <div v-else class="select-wrapper">
                      <div @click="openSelectOption" class="arrow">
                        <i class="fa-solid fa-chevron-down"></i>
                      </div>
                      <select id="floor-select" v-model="feature.value">
                        <option
                          :value="apartmentFloor.value"
                          v-for="(apartmentFloor, index) in apartmentFloors"
                          :key="index"
                        >
                          {{
                            $i18n.locale == "ar"
                              ? apartmentFloor.name_ar
                              : apartmentFloor.name_en
                          }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="image">
                    <img :src="`/images/features/${feature.image}`" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="navs">
            <a
              href="#assemble-kit"
              @click="back"
              v-if="currentStep.index !== 1"
              class="back"
            >
              {{ $t("BACK") }}
            </a>
            <a
              :class="{ disabled: disabled() }"
              href="#assemble-kit"
              @click="next"
              class="next"
              >{{ $t("NEXT") }}</a
            >
          </div>
        </div>
      </div>
    </section>
    <!-- End Contact Section -->
  </div>
</template>

<script>
import { onMounted, reactive, toRefs } from "vue";
import productClient from "../../../http-clients/web/product-client";
import { useRouter } from "vue-router";
export default {
  setup() {
    const router = useRouter();
    const data = reactive({
      apartmentFloors: [
        { value: "1st_2nd", name_en: "1st and 2nd", name_ar: "الاول والثاني" },
        { value: "last", name_en: "Last", name_ar: "الاخير" },
        { value: "other", name_en: "Other", name_ar: "اخر" },
      ],
      allPossiblePremiseFeatures: [
        {
          id: "no_of_rooms",
          name_en: "Number of rooms including kitchen",
          name_ar: "عدد الغرف بما في ذلك المطبخ",
          value: 1,
          image: "1.svg",
          pathes: [
            { premise_type_value: "all", protection_type_value: 2 },
            { premise_type_value: "all", protection_type_value: 1 },
          ],
        },
        {
          id: "no_of_bathrooms",
          name_en: "Number of bathrooms",
          name_ar: "عدد الحمامات",
          value: 1,
          image: "2.svg",
          pathes: [{ premise_type_value: "all", protection_type_value: 3 }],
        },
        {
          id: "no_of_entrances",
          name_en: "Number of entrances",
          name_ar: "عدد المداخل",
          value: 1,
          image: "3.svg",
          pathes: [
            { premise_type_value: "house", protection_type_value: 1 },
            { premise_type_value: "office", protection_type_value: 1 },
            { premise_type_value: "business", protection_type_value: 1 },
          ],
        },
        {
          id: "no_of_floors",
          name_en: "Number of floors",
          name_ar: "عدد الطوابق",
          value: 1,
          image: "4.svg",
          pathes: [
            { premise_type_value: "house", protection_type_value: 1 },
            { premise_type_value: "office", protection_type_value: 1 },
            { premise_type_value: "business", protection_type_value: 1 },
          ],
        },
        {
          id: "apartment_floor",
          name_en: "Apartment floor",
          name_ar: "ارضية الشقة",
          value: "1st_2nd",
          image: "5.svg",
          pathes: [
            { premise_type_value: "apartment", protection_type_value: 1 },
          ],
        },
        {
          id: "yard_size",
          name_en: "Yard size",
          name_ar: "حجم الفناء",
          value: 1,
          image: "6.svg",
          pathes: [
            { premise_type_value: "house", protection_type_value: 4 },
            { premise_type_value: "office", protection_type_value: 4 },
            { premise_type_value: "business", protection_type_value: 4 },
          ],
        },
      ],
      premiseFeatures: localStorage.getItem("premiseFeatures")
        ? JSON.parse(localStorage.getItem("premiseFeatures"))
        : [],
      currentStep: localStorage.getItem("currentStep")
        ? JSON.parse(localStorage.getItem("currentStep"))
        : {
            index: 1,
            id: "premise_type",
            name_ar: "اختر نوع المبنى",
            name_en: "Choose premise type",
          },
      steps: [
        {
          index: 1,
          id: "premise_type",
          name_ar: "اختر نوع المبنى",
          name_en: "Choose premise type",
        },
        {
          index: 2,
          id: "protection_type",
          name_ar: "اختر نوع الحماية",
          name_en: "Choose protection type",
        },
        {
          index: 3,
          id: "premise_features",
          name_ar: "تحديد ميزات المبنى",
          name_en: "Specify premise features",
        },
        {
          index: 4,
          id: "device_set",
          name_ar: "تكوين مجموعة الاجهزة",
          name_en: "Configure device set",
        },
      ],
      premiseTypeValue: localStorage.getItem("premiseTypeValue")
        ? localStorage.getItem("premiseTypeValue")
        : "",
      premiseTypes: [
        {
          value: "apartment",
          name_en: "Apartment",
          name_ar: "العمارة",
          image: "/images/premise_types/1.svg",
        },
        {
          value: "house",
          name_en: "House",
          name_ar: "المنزل",
          image: "/images/premise_types/2.svg",
        },
        {
          value: "office",
          name_en: "Office",
          name_ar: "المكتب",
          image: "/images/premise_types/3.svg",
        },
        {
          value: "business",
          name_en: "Business",
          name_ar: "العمل",
          image: "/images/premise_types/4.svg",
        },
      ],
      protectionTypeValues: localStorage.getItem("protectionTypeValues")
        ? JSON.parse(localStorage.getItem("protectionTypeValues"))
        : [],
      protectionTypes: [],
    });
    //Methods
    function increment(feature) {
      feature.value++;
    }
    function decrement(feature) {
      feature.value--;
    }
    function openSelectOption() {}
    function chooseProtectionTypes(id) {
      let index = -1;
      data.protectionTypeValues.forEach((element, i) => {
        if (element == id) {
          index = i;
          return;
        }
      });
      if (index < 0) {
        data.protectionTypeValues.push(id);
      } else {
        data.protectionTypeValues.splice(index, 1);
      }
    }
    function toStep(index) {
      if (index < data.currentStep.index) {
        data.currentStep = data.steps.filter((step) => {
          return step.index == index;
        })[0];
      }
    }
    function disabled() {
      return (
        (data.currentStep.index == 1 && !data.premiseTypeValue) ||
        (data.currentStep.index == 2 && data.protectionTypeValues.length == 0)
      );
    }
    function next() {
      if (disabled()) {
        return;
      }
      let index = data.currentStep.index + 1;
      if (index == 4) {
        router.push("/assemble-kit-result");
        localStorage.setItem("premiseTypeValue", data.premiseTypeValue);
        localStorage.setItem(
          "protectionTypeValues",
          JSON.stringify(data.protectionTypeValues)
        );
        localStorage.setItem(
          "premiseFeatures",
          JSON.stringify(data.premiseFeatures)
        );
        localStorage.setItem(
          "currentStep",
          JSON.stringify({
            index: 3,
            id: "premise_features",
            name_ar: "تحديد ميزات المبنى",
            name_en: "Specify premise features",
          })
        );
      }
      if (index == 3) {
        data.premiseFeatures = data.allPossiblePremiseFeatures.filter(
          (element) => {
            let filterResult = element.pathes.filter((path) => {
              return (
                (path.premise_type_value == "all" &&
                  data.protectionTypeValues.includes(
                    path.protection_type_value
                  )) ||
                (path.premise_type_value == data.premiseTypeValue &&
                  data.protectionTypeValues.includes(
                    path.protection_type_value
                  ))
              );
            });
            return filterResult.length;
          }
        );
      }
      data.currentStep = data.steps.filter((step) => {
        return step.index == index;
      })[0];
    }
    function back() {
      let index = data.currentStep.index - 1;
      data.currentStep = data.steps.filter((step) => {
        return step.index == index;
      })[0];
    }
    onMounted(() => {
      productClient.getBaseCategories().then((res) => {
        data.protectionTypes = res.data;
      });
    });
    return {
      ...toRefs(data),
      disabled,
      increment,
      decrement,
      openSelectOption,
      next,
      back,
      toStep,
      chooseProtectionTypes,
    };
  },
};
</script>

<style lang="scss">
.steps-container {
  .steps-panels {
    .navs {
      gap: 30px;
      margin-top: 65px;
      display: flex;
      justify-content: center;
      .back {
        transition: 0.5s all;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
        border: 1px solid #181818;
        background: none;
        width: 224px;
        padding: 10px;
        font-weight: 600;
        font-size: 14px;
        color: #181818;
        &:hover {
          color: #fff;
          background: #181818;
        }
      }
      .next {
        display: flex;
        justify-content: center;
        align-items: center;

        color: #181818;
        background-color: var(--color-primary);
        border-radius: 50px;
        width: 224px;
        padding: 10px;
        font-weight: 600;
        font-size: 14px;
        border: none;
      }
    }
    margin-top: 40px;
    .step-panel {
      .select-wrapper {
        position: relative;
        height: 42px;
        width: 176px;
        .arrow {
          justify-content: center;
          align-items: center;
          display: flex;
          font-size: 13px;
          top: 0px;
          width: 42px;
          position: absolute;
          height: 42px;
        }
        select {
          font-weight: 550;

          -moz-appearance: none; /* Firefox */
          -webkit-appearance: none; /* Safari and Chrome */
          appearance: none;
          padding: 8px 19px;
          border-radius: 50px;
          height: 100%;
          width: 100%;
          border: 1px solid #dbdbdb;
        }
      }
      .feature-head {
        margin-bottom: 4px;
      }
      transition: 0.3s all;
      .input {
        align-items: center;
        display: flex;
        input {
          border: none;
          border-top: 1px solid #dbdbdb;
          border-bottom: 1px solid #dbdbdb;
          width: 100px;
          height: 42px;
          text-align: center;
          font-weight: bold;
        }
        .increment {
          font-size: 14px;
          width: 36px;
          height: 42px;
          display: flex;
          align-items: center;
          justify-content: center;
          background: #fff;
          border: 1px solid #dbdbdb;
        }
        .decrement {
          font-size: 14px;
          width: 36px;
          height: 42px;
          display: flex;
          align-items: center;
          justify-content: center;
          background: #fff;
          border: 1px solid #dbdbdb;
        }
      }
      &.hide {
        display: none;
      }
      .type {
        height: 150px;
        &:hover {
          cursor: pointer;
        }
        .choose {
          h5 {
            color: #181818;
            margin-top: 8px;
          }
          display: flex;
          gap: 15px;
          align-items: center;
          .radio-inpt {
            transition: 0.1s all;
            border: 2px solid var(--color-primary);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #fff;
          }
          .checkbox-inpt {
            i {
              color: #fff;
            }
            transition: 0.1s all;
            border: 2px solid var(--color-primary);
            width: 30px;
            height: 30px;
            background: #fff;
          }
        }
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ededed;
        padding: 18px;
        .image {
          img {
            overflow: visible;
            height: 100px;
            width: 100px;
            border-radius: 50%;
          }
        }
        &.active {
          .radio-inpt {
            border: 8px solid var(--color-primary);
            background: #181818;
          }
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
    }
  }
  .disabled {
    cursor: default;
    opacity: 0.7;
  }
  body[dir="ltr"] & {
    .step-panel {
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
      .select-wrapper {
        .arrow {
          right: 3px;
          border-left: 1px solid #dbdbdb;
        }
      }
    }
  }
  body[dir="rtl"] & {
    .select-wrapper select {
      font-size: 14px !important;
      font-weight: 600 !important;
    }
    .step-panel {
      .select-wrapper {
        .arrow {
          left: 3px;
          border-right: 1px solid #dbdbdb;
        }
      }
      h5 {
        font-size: 17px;
        color: black;
      }
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
    }
  }
  .assemble-head {
    color: #181818;
  }
  .steps {
    justify-content: center;
    display: flex;
    margin-top: 48px;
    ul {
      list-style: none;
      display: flex;
      gap: 70px;
      .step-item {
        align-items: center;
        display: flex;
        font-weight: 600;
        font-size: 14px;
        color: #181818;
        gap: 12px;
        .number {
          transition: 0.3s all;
          align-items: center;
          justify-content: center;
          height: 40px;
          display: flex;
          width: 40px;
          border-radius: 50%;
          font-size: 16px;
          background: #ededed;
          &.active {
            background: #181818;
            color: #fff;
          }
          &.prev-active {
            &:hover {
              cursor: pointer;
            }
            background: var(--color-primary);
            color: #fff;
          }
        }
        .text {
          font-weight: 600;
          font-size: 14px;
          color: #181818;
        }
      }
    }
  }
}
@media (max-width: "1198px") {
  .steps-container {
    .steps {
      ul {
        gap: 30px;
      }
    }
  }
}
@media (max-width: "991px") {
  .steps-container {
    .steps {
      .step-item {
        .number {
          width: 30px !important;
          height: 30px !important;
          font-size: 14px !important;
        }
      }
    }
  }
}
</style>