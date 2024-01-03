import AdminGuestGuard from "../shared/guards/guest-admin-guard";
import AdminLogin from "../components/dashboard/login.vue";
import DashboardLayout from '../layouts/dashboard-layout';
import BaseCategoryTable from '../components/dashboard/base-category/item-table';
import BaseCategoryForm from '../components/dashboard/base-category/item-form';

import ContactUsTable from '../components/dashboard/contact-us/item-table';
import RecruitmentTable from '../components/dashboard/recruitment/item-table';
import NotificiationServiceTable from '../components/dashboard/notification-service/item-table';
import Install from '../components/dashboard/install/item-table';
import CategoryForm from '../components/dashboard/category/item-form';
import CategoryTable from '../components/dashboard/category/item-table';
import ProductTable from '../components/dashboard/product/item-table';
import ProductForm from '../components/dashboard/product/item-form';
import MediaManager from '../components/dashboard/media-manager/item-list';
import AuthenticatedAdminGuard from "../shared/guards/authenticated-admin-guard";
import AllCities from "../components/dashboard/All-cities/item-value.vue";
import Feedbacks from "../components/dashboard/Feedbacks/item-value.vue";
import QuestionForm from "../components/dashboard/Questions/item-form.vue";
import QuestionTable from "../components/dashboard/Questions/item-table.vue"
export default [{
    path: "/admin",
    component: DashboardLayout,
    beforeEnter: [
        AuthenticatedAdminGuard
    ],

    children: [
        { path: "products", component: ProductTable, name: "admin-products" },
        { path: "product-form/:id", component: ProductForm },
        { path: "base-categories", component: BaseCategoryTable, name: "base-categories" },
        { path: "base-categories-form/:id", component: BaseCategoryForm },
        { path: "categories", component: CategoryTable },
        { path: "categories-form/:id", component: CategoryForm },
        { path: "media-manager", component: MediaManager, name: "media-manager" },
        { path: "contact-us", component: ContactUsTable, name: "contact" },
        { path: "recruitment", component: RecruitmentTable, name: "admin-recruitment" },
        { path: "notification-service", component: NotificiationServiceTable, name: "monitoring" },
        { path: "installs", component: Install, name: "admin-install" },
        { path: "Cities", component: AllCities, name: "all-Cities" },
        { path: "Feedbacks", component: Feedbacks, name: "Feedbacks" },
        {path: "questions", component: QuestionTable, name: "questions"},
        {path: "Add-questions", component: QuestionForm, name: "Add-questions"},

    ]
},
{
    path: "/admin",
    beforeEnter: [AdminGuestGuard],
    children: [
        { path: "login", component: AdminLogin },
    ]
},
];
