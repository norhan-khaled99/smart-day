<template>
  <div>
    <Loader color="#5ae4aa" />
    <PageLoader color="#5ae4aa" />
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
            <Lang :page="route.name" />

      <div
      style="margin-top: 19px;"
        dir="ltr"
        class="container-fluid container-xl d-flex align-items-center justify-content-between"
      >
        <a href="index.html" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1><img src="/web/assets/img/white-logo.png" /></h1>
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
          <ul>
            <li>
              <router-link
                to="/home"
                :class="{ active: currentPage == 'home' }"
                >{{ $t("HOME") }}</router-link
              >
            </li>
              <li class="dropdown">
              <a :class="{ active: currentPage == 'services' }" href="#"
                ><span>{{ $t("SERVICES") }}</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i
              ></a>
              <ul>
                <li>
                <router-link
                to="/install"
                >{{ $t("INSTALLATION") }}</router-link
              >
                </li>
               <li>
                 <router-link
                to="/notification-service"
                >{{ $t("MONITIRING") }}</router-link
              ></li>
              </ul>
            </li>
            <li>
              <router-link
                :class="{ active: currentPage == 'recruitment' }"
                to="/recruitment"
                >{{ $t("APPLY_JOB") }}</router-link
              >
            </li>
            <li>
              <router-link
                :class="{ active: currentPage == 'business-contractor' }"
                to="/business-contractor"
                >{{ $t("Business contractor") }}
              </router-link>
            </li>
            <li class="dropdown">
              <a :class="{ active: currentPage == 'products' }" href="#"
                ><span>{{ $t("PRODUCTS") }}</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i
              ></a>
              <ul>
                <li>
                  <router-link
                    :to="`/products/all`"
                  >
                    {{ $t("AJAX_PRODUCTS") }}
                  </router-link>
                </li>

              </ul>
            </li>
            <li>
              <router-link
                :class="{ active: currentPage == 'assemble-kit' }"
                @click="onAssemblekitClicked"
                to="/assemble-kit"
                >{{ $t("ASSEMBLE_KIT") }}</router-link
              >
            </li>
            <li>
                <router-link
                  :class="{ active: currentPage == 'question' }"
                  to="/question"
                  >{{ $t("questions") }}</router-link
                >
              </li>
          </ul>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <!-- End Header -->
    <main id="main">
      <router-view />
    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="footer-content position-relative">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="footer-info">
                <h3>{{$t("CONTACT")}}</h3>
                <p>
                  <div>{{ $t("sd_address") }}</div>
                  <div style="margin-top:20px">
                  {{ $t("PHONE") }} : <span dir="ltr">+966556668145</span>
                  </div>
                  <div>
                  {{ $t("EMAIL") }} : Info@sd.com.sa                  </div>
                </p>
                <div class="social-links d-flex mt-3">

                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi bi-instagram"></i
                  ></a>

                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi bi-twitter"></i
                  ></a>
                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi bi-snapchat"></i
                  ></a>

                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi bi-tiktok"></i
                  ></a>

                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a
                    href="#"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi bi-linkedin"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- End footer info column-->

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>{{$t("Useful Links")}}</h4>
              <ul>
                <li>
                  <router-link to="/home">{{ $t("HOME") }}</router-link>
                </li>
                <li><a target="__blank" href="https://t.me/AjaxSystemsSupport_Bot">{{$t("TECHNICAL_SUPPORT")}}</a></li>
                <li><a target="__blank" href="https://play.google.com/store/apps/details?id=com.ajaxsystems&pli=1">{{$t("AJAX_ANDRIOD")}}</a></li>
                <li><a target="__blank" href="https://apps.apple.com/ru/app/ajax-security-system/id1063166247?l=en&mt=8">{{$t("AJAX_IPHONE")}}</a></li>
                <li>
                  <a href="#">{{ $t("Terms of return and exchange") }}</a>
                </li>
              </ul>
            </div>
            <!-- End footer links column-->

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>{{$t("Our Services")}}</h4>
              <ul>
                <li>
                  <router-link to="/products/all">{{
                    $t("PRODUCTS")
                  }}</router-link>
                </li>
                <li>
                  <router-link to="/recruitment">{{
                    $t("APPLY_JOB")
                  }}</router-link>
                </li>

                <li>
                  <router-link to="/install">{{
                    $t("INSTALLATION")
                  }}</router-link>
                </li>
                <li>
                  <router-link to="/notification-service">{{
                    $t("MONITIRING")
                  }}</router-link>
                </li>
                <li>
                  <router-link to="/assemble-kit">{{
                    $t("ASSEMBLE_KIT")
                  }}</router-link>
                </li>
              </ul>
            </div>
            <!-- End footer links column-->

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>{{$t("CATEGORIES")}}</h4>
              <ul>
                <li>
                  <router-link
                    :to="`/products/all`"
                  >
                    {{ $t("All Categories") }}
                  </router-link>
                </li>
                <li v-for="category in categories" :key="category.id">
                  <router-link
                    :to="`/products/${category.id}`"
                  >
                    {{
                      $i18n.locale == "ar" ? category.name_ar : category.name_en
                    }}
                  </router-link>
                </li>
              </ul>
            </div>
            <!-- End footer links column-->

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>{{$t("OUR_STORE")}}</h4>
              <ul>
                <li><a target="__blank" href="https://sd.sa">{{$t("HOME")}}</a></li>
                <li><a target="__blank" href="https://sd.sa/products">{{$t("PRODUCTS")}}</a></li>
                <li><a target="__blank" href="https://sd.sa/blogs/monitoring-service">{{$t("NOTIFICATIONS_SERVICE")}}</a></li>
                <li><a target="__blank" href="https://ajax.systems/translator">{{$t("AJAX_TRANSLATOR")}}</a></li>
                <li><a target="__blank" href="https://sd.sa/blogs/installation-service">{{$t("INSTALLATION_SERVICE")}}</a></li>
              </ul>
            </div>
            <!-- End footer links column-->
          </div>
        </div>
      </div>

      <div class="footer-legal text-center position-relative">
        <div class="container">
          <div v-if="$i18n.locale=='en'" class="copyright">
             All Rights Reserved &copy; {{(new Date()).getFullYear()}} <strong><span>SmartDay</span></strong
            >
          </div>
          <div v-if="$i18n.locale=='ar'" class="copyright">
             جميع الحقوق محفوظة &copy; {{(new Date()).getFullYear()}} <strong><span>SmartDay</span></strong
            >
          </div>

        </div>
      </div>
    </footer>
    <a
      href="#"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- End Footer -->
  </div>
</template>
<script>
import Lang from "../shared/components/lang-web.vue";
import LangUtil from "../shared/utils/lang-util";
import { inject, onMounted, reactive, toRefs, watch } from "vue";
import Loader from "../shared/components/loader.vue";
import PageLoader from "../shared/components/pageLoader.vue";
import { useRoute } from "vue-router";
import productClient from "../http-clients/web/product-client";
export default {
  components: { Lang, LangUtil, Loader, PageLoader },
  setup() {
    const lang = LangUtil.setup();
    const route = useRoute();
    const data = reactive({
      currentPage: "home",
      categories: [],
    });
    onMounted(() => {
      lang.changeWebLang(LangUtil.get());
      getCategories();
          data.currentPage = route.name;

    });
    watch(
      () => route.name,
      () => {
        if (
          (route.name == "install") |
          (route.name == "notification-service")
        ) {
          data.currentPage = "services";
        } else {
          data.currentPage = route.name;
        }
      }
    );
    //Methods
    function onAssemblekitClicked() {
      data.currentPage = "assemble-kit";
      localStorage.removeItem("protectionTypeValues");
      localStorage.removeItem("premiseTypeValue");
      localStorage.removeItem("premiseFeatures");
      localStorage.removeItem("currentStep");
    }
    function getCategories() {
      productClient.getCategories().then((res) => {
        data.categories = res.data.slice(0, 4);
      });
    }
    return { ...toRefs(data), onAssemblekitClicked, route: route };
  },
};
</script>
<style lang="scss">
#footer {
  padding: 80px 0 25px 0 !important;
}
.navbar .dropdown a:hover {
  cursor: pointer;
}
.scroll-top {
  &:hover {
    background: var(--color-primary);
  }
  i {
    color: #fff;
  }
}
body[dir="rtl"] {
  .navbar ul {
    direction: rtl;
  }
  .navbar .dropdown ul a {
    font-size: 13.5px;
  }
}
</style>
