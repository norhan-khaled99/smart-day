<template>
  <div class="products-container section-bg">
    <!-- ======= Breadcrumbs ======= -->
    <div
      class="notification-service breadcrumbs d-flex align-items-center"
      style="background-image: url('/web/assets/img/breadcrumbs-bg.jpg')"
    >
      <div
        class="container position-relative d-flex flex-column align-items-center"
        data-aos="fade"
      >
        <h2>{{ $t("PRODUCTS") }}</h2>
        <ol>
          <li>
            <router-link to="/home">{{ $t("HOME") }}</router-link>
          </li>
          <li>{{ $t("PRODUCTS") }}</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="products" class="products">
      <div class="container">
        <template v-for="(category, index) in categories">
          <div
            data-aos="fade-up"
            data-aos-delay="100"
            v-if="category.products.length"
            :key="category.id"
          >
            <div
              class="section-header"
              :style="index != 0 ? 'padding-top:70px' : ''"
            >
              <div class="head">
                <div class="image">
                  <img :src="`/images/categories/${category.image}`" />
                </div>
                <h4 class="text-center mt-3">
                  {{
                    $i18n.locale == "ar" ? category.name_ar : category.name_en
                  }}
                </h4>
              </div>
            </div>
            <div class="row">
              <div
                v-for="item in category.products"
                :key="item.id"
                class="col-lg-6 mb-4"
              >
                <a class="product-url" :href="item.url" target="__blank">
                  <div class="cat-product">
                    <div class="image">
                      <img
                        :src="
                          item.black_media_manager
                            ? `/uploads/${item.black_media_manager.hash_name}`
                            : '/images/placeholder-thumb.png'
                        "
                      />
                    </div>
                    <div class="prod-text">
                      <div class="prod-header">
                        {{ $i18n.locale == "ar" ? item.name_ar : item.name_en }}
                      </div>
                      <div v-html="item.description" class="prod-bdy"></div>
                      <div class="colors">
                        <ul>
                          <li class="color">{{ $t("COLOR") }} :</li>
                          <li><span class="white"></span></li>
                          <li><span class="black"></span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- <div
            class="d-flex justify-content-center mt-4"
            v-if="items.length && pageCounts > 1"
          >
            <paginate
              v-model="page"
              :pageCount="pageCounts"
              :clickHandler="getProducts"
            >
            </paginate>
          </div> -->
          </div>
        </template>
      </div>
    </section>
    <!-- End Contact Section -->
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
import Paginate from "vuejs-paginate-next";

import { required, email } from "@vuelidate/validators";
import productClient from "../../http-clients/web/product-client";
import { toast } from "vue3-toastify";
import { onMounted, reactive, toRefs, watch } from "vue";
import { useI18n } from "vue-i18n";
import useVuelidate from "@vuelidate/core";
import { useRoute } from "vue-router";
export default {
  components: {
    Multiselect,
    Paginate,
  },
  setup() {
    const { t, locale } = useI18n({ useScope: "global" });
    const route = useRoute();
    const data = reactive({
      pageSize: 10,
      page: 1,
      totalItems: 0,
      items: [],
      pageCounts: 0,
      categories: [],
    });
    onMounted(() => {
      // getProducts();
      getCategories();
    });
    watch(
      () => route.params.id,
      () => {
        // getProducts();
        getCategories();
      }
    );
    //Methods
    function getProducts() {
      productClient
        .getProducts(data.page, data.pageSize, route.params.id)
        .then((response) => {
          data.items = response.data.data;
          data.pageCounts = Math.ceil(response.data.total / data.pageSize);
          data.totalItems = response.data.total;
        })
        .catch((error) => {
          console.log(error.response);
        });
    }
    function getCategories() {
      productClient
        .getCategories(route.params.id == "all" ? null : route.params.id)
        .then((response) => {
          data.categories = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    }

    return {
      ...toRefs(data),
      // getProducts,
      route: route,
    };
  },
};
</script>

<style lang="scss">
.products-container {
  body[dir="rtl"] & {
    .colors {
      ul {
        .color {
          margin-bottom: 10px;
        }
      }
    }
  }
  img {
    border-radius: 50%;
    width: 100px;
    height: 100px;
  }
  .section-header {
    .head {
      h4 {
        color: #242424;
      }
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      .image {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        background: #ededed;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      img {
        border-radius: 50%;
        width: 43px;
        height: 43px;
      }
    }
  }
  .product-url {
    transition: 0.3s all;
    &:hover {
      color: var(--color-primary);
    }
    color: var(--color-default);
  }
  .page-container {
    align-items: center;
    padding: 12px 15px 16px 15px;
    .entries {
      margin-top: 6px;
    }
  }
  .page-link {
    &:hover {
      cursor: pointer;
    }
    align-items: center;
    justify-content: center;
    display: flex;
    border-radius: 5px;
    width: 40px;
    height: 40px;
    border: none;
    color: var(--color-primary);
  }
  .page-item:first-child {
    display: none;
  }
  .page-item:last-child {
    display: none;
  }
  .page-item.active .page-link {
    background-color: var(--color-primary);
    color: #fff;
  }
  .page-item {
    padding: 0 5px;
  }
  .products__header {
    margin-bottom: 40px;
  }
  .cat-product {
    &:hover {
    }
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    .colors {
      ul {
        align-items: center;
        list-style: none;
        display: flex;
        padding: 0;
        margin: 0;
        gap: 11px;
        margin-top: 15px;

        .color {
          color: #7e7e7e;
          font-size: 12px;
        }
        .white {
          display: inline-block;
          background: white;
          width: 15px;
          height: 15px;
          border-radius: 50%;
          border: 1px solid #7e7e7e;
        }
        .black {
          display: inline-block;
          background: black;
          width: 15px;
          height: 15px;
          border-radius: 50%;
        }
      }
    }
    .prod-header {
      color: #242424;
      font-size: 17px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .prod-bdy {
      color: #7e7e7e;
      font-size: 13px;
    }
    display: flex;
    gap: 20px;
  }
}
</style>
