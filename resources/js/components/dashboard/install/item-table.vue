<template>
  <div class="contact-us-container">
    <DeleteConfirmation @confirm="deleteItem" />
    <!-- Modal -->
    <div
      class="modal fade"
      id="messageModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ $t("Message Details") }}
            </h5>
            <div class="second-message border">
              {{
                currentItem && currentItem.message
                  ? currentItem.message
                  : $t("NO_MESSAGE")
              }}
            </div>
            <div>
              <button data-dismiss="modal" type="button" class="btn process">
                {{ $t("OK") }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Notification Modal!-->
    <!-- Modal -->
    <div
      class="modal fade"
      id="notificationModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form @submit.prevent="sendEmail">
            <div class="modal-body">
              <h5 class="modal-title" id="exampleModalLabel">
                {{ $t("INSTALLATION_SERVICE") }}
              </h5>
              <div class="form-group">
                <input
                  v-model="price"
                  type="number"
                  :placeholder="$t('INSTALLATION_SERVICE')"
                  class="form-control"
                />
              </div>
              <div>
                <button
                  id="cancel-notify"
                  type="button"
                  data-dismiss="modal"
                  class="btn border cancel"
                >
                  {{ $t("CANCEL") }}
                </button>

                <button :disabled="!price" class="btn process mx-1">
                  {{ $t("SEND") }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="page-header border" style="margin-top: 10px">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            {{ $t("INSTALLATION_SERVICE") }}
          </div>
        </div>
        <div class="col-md-6 col-sm-12 text-right"></div>
      </div>
    </div>
    <div id="table" class="bg-white border border-radius-4 mb-30">
      <div class="table-container">
        <div class="controls">
          <div class="row">
            <div style="padding: 0 8px; width: 88%">
              <div class="search d-flex">
                <i class="fa fa-search"></i>

                <input
                  class="form-control"
                  v-model="text"
                  type="text"
                  :placeholder="$t('SEARCH')"
                  ref="search"
                />
              </div>
            </div>
            <div style="padding: 0 8px; width: 12%">
              <button
                type="button"
                @click="searchItems"
                class="btn search-btn"
                style="width: 100%"
              >
                <i class="fa fa-search"></i>
                {{ $t("SEARCH") }}
              </button>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table" id="printMe">
            <thead>
              <tr>
                <th scope="col">{{ $t("S/L") }}</th>
                <th scope="col">{{ $t("CODE") }}</th>
                <th scope="col">{{ $t("NAME") }}</th>
                <th scope="col">{{ $t("PHONE") }}</th>
                <th scope="col">{{ $t("EMAIL") }}</th>
                <th scope="col">{{ $t("date") }}</th>
                <th scope="col">{{ $t("AREA") }}</th>
                <th scope="col">{{ $t("CITY") }}</th>
                <th scope="col">{{ $t("neighborhood") }}</th>
                <th scope="col">{{ $t("STREET") }}</th>
                <th scope="col">{{ $t("PRODUCTS") }}</th>
                <th scope="col">{{ $t("quantity") }}</th>
                <th scope="col">{{ $t("order_number") }}</th>
                <th class="actions-header" scope="col">
                  {{ $t("ACTIONS") }}
                </th>
              </tr>
            </thead>
            <tbody v-if="items.length">
              <tr v-for="(item, index) in items" :key="item.id">
                <td>{{ index + 1 + (page - 1) * pageSize }}</td>
                <td dir="ltr">
                  {{ item.serial }}
                </td>

                <td class="order-code">
                  {{ item.name }}
                </td>
                <td>
                  {{ item.phone }}
                </td>
                <td>
                  {{ item.email }}
                </td>
                <td dir="ltr">
                  {{ item.date }}
                </td>
                <td>
                  {{ $i18n.locale == "ar" ? item.area.name : item.area.name_e }}
                </td>
                <td>
                  {{ $i18n.locale == "ar" ? item.city.name : item.city.name_e }}
                </td>
                <td>
                  {{ item.neighborhood }}
                </td>
                <td>
                  {{ item.street }}
                </td>
                <td>
                  {{ item.price }}
                </td>
                <td>
                  {{ item.quantity }}
                </td>
                <td>
                  {{ item.order_number }}
                </td>

                <td class="actions-cell ">
                  <div class="dropdown">
                    <a
                      class="btn"
                      href="#"
                      role="button"
                      data-toggle="dropdown"
                    >
                      <i
                        style="font-size: 17px !important"
                        class="dw dw-more"
                      ></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">

                     <a
                        @click="
                          notification = 'email';
                          price = '';
                          currentItem = item;
                        "
                        data-toggle="modal"
                        data-target="#notificationModal"
                        class="dropdown-item show-message"
                        >{{ $t("NOTIFICATION_EMAIL") }}</a
                      >
                      <a
                        @click="
                          notification = 'whatsup';
                          price = '';
                          currentItem = item;
                        "
                        data-toggle="modal"
                        data-target="#notificationModal"
                        class="dropdown-item show-message"
                        >{{ $t("NOTIFICATION_WHATSUP") }}</a
                      >

                      <a
                        @click="onDeleteClicked(item)"
                        data-toggle="modal"
                        data-target="#deleteConfirmationModal"
                        class="dropdown-item"
                        href=""
                        >{{ $t("DELETE") }}</a
                      >

                      <a
                        @click="currentItem = item"
                        data-toggle="modal"
                        data-target="#messageModal"
                        class="dropdown-item show-message"
                        >{{ $t("MESSAGE") }}</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td class="no-result" colspan="14">{{ $t("No results") }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="page-container border-top d-flex justify-content-between">
          <div class="entries">
            {{ pageSize * (page - 1) + 1 }} -
            {{ (page - 1) * pageSize + items.length }} {{ $t("OF") }}
            {{ totalItems }} {{ $t("ENTRIES") }}
          </div>
          <div v-if="items.length && pageCounts > 1">
            <paginate
              v-model="page"
              :pageCount="pageCounts"
              :clickHandler="getItems"
              :prevText="
                $i18n.locale == 'en'
                  ? `<i class='ion-chevron-left'></i>`
                  : `<i class='ion-chevron-right'></i>`
              "
              :nextText="
                $i18n.locale == 'en'
                  ? `<i class='ion-chevron-right'></i>`
                  : `<i class='ion-chevron-left'></i>`
              "
            >
            </paginate>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Image from "../../../shared/components/image.vue";

import Multiselect from "@vueform/multiselect";
import itemStore from "./item-store";
import installClient from "../../../http-clients/admin/install-client";
import Paginate from "vuejs-paginate-next";
import exportFromJSON from "export-from-json";
import DeleteConfirmation from "../../../shared/components/delete-confirmation.vue";
import { onMounted, provide, reactive, toRefs } from "vue-demi";
import { useI18n } from "vue-i18n";
export default {
  components: {
    Paginate,
    Multiselect,
    DeleteConfirmation,
    Image,
  },
  setup() {
    provide("item_store", itemStore);

    const data = reactive({
      isArabic: false,
      price: "",
      notification: "",
      currentItem: null,
      selectedMedia: [],
      currentSection: "table",
      titleArExist: false,
      titleEnExist: false,
      pageSize: 10,
      page: 1,
      totalItems: 0,
      items: [],
      text: "",
      pageCounts: 0,
      timeout: null,
      selectedItem: null,
      monthNames: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
    });

    const { t, locale } = useI18n({ useScope: "global" });
    created();
    onMounted(() => {});
    //Methods
    function sendEmail() {
      if (data.notification == "email") {
        installClient
          .sendEmail({
            price: data.price,
            code: data.currentItem.serial,
            email: data.currentItem.email,
          })
          .then((res) => {
            toast.success(t("SENT_SUCCESSFULLY"), {
              autoClose: 2000,
              position: "top-center",
            });
            $("#cancel-notify").click();
          });
      } else {
        var url =
          "https://api.whatsapp.com/send?phone=" +
          data.currentItem.phone +
          "&text=" +
          encodeURIComponent(`
            عزيزي العميل
            نشكر لكم ثقتكم بطلب الخدمة
            نرجو الاطلاع على الاسعار المرفقة
            ولطلب التوضيح والتفاصيل نرجو التواصل مع فريق المبيعات .
            نرجو ان تنال خدماتنا رضاكم،
            اجمالي السعر ${data.price}،
            الكود الخاص بكم ${data.currentItem.serial}
          `);
        window.open(url);
      }
    }
    function toggleLocale() {
      data.isArabic = !data.isArabic;
    }

    function getMounthName() {
      let date = new Date();
      return data.monthNames[date.getMonth()];
    }
    function onAddClicked() {
      data.selectedItem = null;
      //Make little delay to ensure that watcher that found in item form component
      // catch selectedItem input prop
      setTimeout(() => {
        itemStore.onFormShow = !itemStore.onFormShow;
      }, 1);
    }
    function onEditClicked(item) {
      data.selectedItem = item;
      //Make little delay to ensure that watcher catch selectedItem input prop
      //in item form component
      setTimeout(() => {
        itemStore.onFormShow = !itemStore.onFormShow;
      }, 1);
    }
    function onDeleteClicked(item) {
      data.selectedItem = item;
    }
    function onPageSizeChanged() {
      data.page = 1;
      getItems();
    }
    function getItems() {
      installClient
        .getItems(data.page, data.pageSize, data.text)
        .then((response) => {
          data.items = response.data.data;
          data.pageCounts = Math.ceil(response.data.total / data.pageSize);
          data.totalItems = response.data.total;
        })
        .catch((error) => {
          console.log(error.response);
        });
    }
    function downloadExcelFile() {
      installClient.getAllItems().then((res) => {
        let data = res.data;
        const fileName = "Items";
        const exportType = exportFromJSON.types.csv;
        if (data) exportFromJSON({ data, fileName, exportType });
      });
    }
    function print() {
      window.print();
    }
    function onCreated(event) {
      data.page = 1;
      getItems();
    }
    function onUpdated(event) {
      getItems();
    }
    function deleteItem() {
      installClient
        .delete(data.selectedItem.id)
        .then((response) => {
          toast.success(t("DELETED_SUCCESSFULLY"), {
            autoClose: 2000,
            position: "top-center",
          });

          if (data.page > 1 && data.items.length == 1) {
            data.page--;
          }
          getItems();
        })
        .catch((error) => {});
    }
    function searchItems() {
      data.page = 1;
      // clear timeout variable
      // clearTimeout(data.timeout);
      // data.timeout = setTimeout(() => {
      getItems();
      // }, 500);
    }
    // watch(
    //   () => {
    //     data.text;
    //   },
    //   (value) => {
    //     search();
    //   },
    //   { deep: true }
    // );
    //Commons
    function getForm() {
      return {
        media_manager_id: data.selectedMedia.length
          ? data.selectedMedia[0].id
          : null,
        name_ar: form.name_ar,
        name_en: form.name_en,
      };
    }

    function created() {
      getItems();
    }
    return {
      toggleLocale,
      ...toRefs(data),
      sendEmail,
      getMounthName,
      onPageSizeChanged,
      onAddClicked,
      onEditClicked,
      onDeleteClicked,
      getItems,
      downloadExcelFile,
      onCreated,
      onUpdated,
      deleteItem,
      searchItems,
      print,
    };
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>


<style lang="scss">
@media print {
  body * {
    visibility: hidden;
  }
  #printMe,
  #printMe * {
    visibility: visible;
  }
  .actions-header,
  .actions-cell {
    display: none !important;
  }
  #printMe {
    position: absolute;
    top: 0;
    left: 0;
  }
}
.contact-us-container {
  #messageModal,
  #notificationModal {
    .second-message {
      font-size: 14px;
      overflow: auto;
      padding: 10px 13px;
      margin-bottom: 35px;
      height: 100px;
    }
    .form-group {
      margin-bottom: 36px;
    }
    .modal-title {
      margin-bottom: 21px;
    }
    .modal-body {
      padding: 40px;
    }
    .modal-content {
      background: #fff !important;
    }
    .process {
      width: 85px;
      height: 43px;
      background: #4eb529 !important;
    }
    .cancel {
      width: 85px;
      height: 43px;
      color: #202342;
      background: #f4f6f8;
    }
    .process,
    .cancel {
      font-size: 13px !important;
    }
    .modal-header {
      display: flex;
      align-items: center;
      .modal-title {
        font-size: 16px !important;
      }
      button {
        background: none;
        border: none;
        i {
          font-size: 17px !important;
        }
      }
    }

    button {
      color: white;
    }
    .modal-footer {
      button {
        width: 60px;
      }
    }
    body[dir="rtl"] & {
      .modal-title {
        font-size: 1.1em;
        font-weight: 500;
      }
    }
    body[dir="ltr"] & {
      input::placeholder {
        font-size: 13.5px;
      }
      .modal-title {
        font-size: 1.15em;
        font-weight: 600;
      }
    }
  }
  .dropdown .show-message {
    &:hover {
      cursor: pointer !important;
    }
  }
  #table {
    margin-bottom: 173px;
  }
  .create-btn {
    width: 140px;
    background: #4eb529 !important;
    color: #fff;
    padding: 11px 0px;
    span {
      margin: 0 5px;
    }
  }

  .normal {
    color: #454f5b;
  }
  .item-image {
    object-fit: contain;
    width: 25px;
    height: 25px;
    border-radius: 50%;
  }
  .img-name {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 550;
  }
  .date-header:hover {
    color: #fff !important;
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
    background-color: #ccc;
    -webkit-transition: 0.4s;
    transition: 0.4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 10px;
    width: 10px;
    left: 4px;
    bottom: 4px;
    background-color: white;
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
    -webkit-transform: translateX(19px);
    -ms-transform: translateX(19px);
    transform: translateX(19px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  } // centering
  body[dir="rtl"] & {
    .create-btn,
    .search .form-control,
    .search-btn {
      font-size: 13px;
    }
    th,
    .entries {
      font-size: 13px;
    }
    td {
      font-size: 13px;
    }
    .chip {
      font-size: 11px !important;
      margin: 0 3px;
      border-radius: 12px;
      padding: 5px 7px;
      color: #454f5b;
      background: rgb(244, 246, 248);
    }

    .create-btn {
      span {
        position: relative;
        top: 1px;
      }
    }
    td.no-result {
      font-weight: 500 !important;
      font-size: 12.5px !important;
    }
    .locale {
      border-radius: 5px;
      padding: 3px 7px;
      position: relative;
      color: #fcac00;
      font-size: 9px !important;
      bottom: 5px;
      background: rgba(252, 172, 0, 0.15);
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
        font-weight: 500 !important;
      }
      td {
        font-weight: 400 !important;
      }
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
        font-size: 14px !important;
      }
      ul {
        padding: 0 30px;
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
    .create-btn,
    .search .form-control,
    .search-btn {
      font-size: 13px;
    }
    th,
    .entries {
      font-size: 14px;
    }
    td {
      font-size: 13px;
    }
    .chip {
      font-size: 11px !important;
      margin: 0 3px;
      border-radius: 12px;
      padding: 5px 7px;
      color: #454f5b;
      background: rgb(244, 246, 248);
    }

    td.no-result {
      font-weight: 600 !important;
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
      a * {
        font-size: 14px !important;
      }
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
  .locale {
    border-radius: 5px;
    padding: 3px 7px;
    position: relative;
    color: #fcac00;
    font-size: 10px !important;
    bottom: 5px;
    background: rgba(252, 172, 0, 0.15);
    &:hover {
      color: #fcac00 !important;
      background: rgba(252, 172, 0, 0.15);
    }
  }

  .multiselect-option.is-selected.is-pointed,
  .multiselect-option.is-selected {
    background: #4eb529 !important;
  }
  .btn-primary {
    background: none !important;
    border-color: #4eb529 !important;
    color: #4eb529 !important;
    &:hover {
      color: #4eb529 !important;
    }
  }
  .multiselect-wrapper {
    padding: 13px 0px;
  }
  .save-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 110px;
    gap: 12px;
    justify-content: center;
    padding: 10px 0;
    border-radius: 5px;
  }

  .information-container {
    position: sticky;
    top: 90px;
  }
  .table-sec {
    padding-bottom: 400px;
  }
  form {
    .form-control {
      padding: 21px 10px;
      font-size: 13px !important;
    }
  }
  .create-item {
    padding: 20px 20px 40px 20px !important;
  }
  .search-btn {
    padding: 11px 0;
    width: 100%;
    background: #4eb529 !important;
    color: #fff !important;
  }
  .page-header {
    box-shadow: unset !important;
    margin-bottom: 19px !important;
  }

  .controls {
    background: #f9fafb;
    padding: 21px 26px;
  }
  .options {
    margin: 9px 0 20px 0px;
    align-items: center;
    a.outer {
      margin: 0 6px;
      cursor: pointer;
      color: #4eb529;
    }
  }
  .page-container {
    align-items: center;
    padding: 12px 15px 16px 15px;
    .entries {
      margin-top: 6px;
    }
  }
  .page-link {
    align-items: center;
    justify-content: center;
    display: flex;
    border-radius: 5px;
    width: 30px;
    height: 30px;
    border: none;
  }
  .page-item.active .page-link {
    background-color: #4eb529;
  }
  .page-item {
    padding: 0 5px;
  }
  .table {
    margin-bottom: 0 !important;
    td {
      padding: 0 1rem !important;
    }
    th,
    td {
      white-space: nowrap;
    }
    td.no-result {
      color: #454f5b;
      font-size: 14px !important;
      text-align: center;
      padding: 9px !important;
    }
  }
  .actions-cell .dropdown .btn {
    color: #4eb529;
  }
  .table-header {
    color: #4eb529;
  }
  .form-control {
    height: 40px !important;
  }
  .pageSize {
    flex-direction: nowrap;
    margin: 11px 0px 15px 0;
    span {
      position: relative;
      top: 6px;
    }
    select {
      margin: 0 5px;
    }
  }
  .search {
    position: relative;
    i {
      color: gray;
      position: absolute;
      top: 16px;
      font-size: 15px;
    }
    label {
      margin: 0 5px;
      position: relative;
      top: 7px;
    }
    .form-control {
      padding: 21px 39px;
    }
  }

  @media (max-width: "660px") {
    .pageSize {
      flex-direction: column;
      align-items: center;
      gap: 10px;
      margin: 11px 0px 15px 0;
    }
  }
}
</style>
