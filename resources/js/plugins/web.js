import AuthLayout from '../layouts/auth-layout';
import WebLayout from '../layouts/web-layout';
import Register from '../components/auth/register';
import Login from '../components/auth/login';
import ForgetPassword from '../components/auth/forget-password';
import ResetPassword from '../components/auth/reset-password';
import EmailVerification from '../components/web/email-verification';
import Profile from '../components/web/profile';
import Home from '../components/web/home';
import Recruitment from '../components/web/recruitment';
import BusinessContractor from "../components/web/business-contractor";
import NotificationService from '../components/web/notification-service';
import Install from '../components/web/install';
import Products from '../components/web/products';
import Assemblekit from '../components/web/assemble-kit/steps';
import AssemblekitResult from '../components/web/assemble-kit/result';
import Question from "../components/web/question.vue"
import createfeedback from "../components/web/Createfeedback.vue";
import Chat from '../components/web/chat';
import AuthenticatedGuard from "../shared/guards/authenticated-guard";
import GuestGuard from "../shared/guards/guest-guard";
export default [
    {
        path: "",
        redirect: "/home"
    },
    {
        path: "",
        component: AuthLayout,
        beforeEnter: [
            GuestGuard
        ],
        children: [
            { path: "register", component: Register },
            { path: "login", component: Login },
            { path: "forget-password", component: ForgetPassword },
            { path: "reset-password/:token", component: ResetPassword },
        ]
    },
    {
        path: "",
        component: WebLayout,
        children: [
            { path: "home", component: Home, name: "home" },
            { path: "recruitment", component: Recruitment, name: "recruitment" },
            { path: "business-contractor", component: BusinessContractor, name: "business-contractor" },
            { path: "notification-service", component: NotificationService, name: "notification-service" },
            { path: "install", component: Install, name: "install" },
            { path: "products/:id", component: Products, name: "products", },
            { path: "assemble-kit", component: Assemblekit, name: "assemble-kit", },
            { path: "assemble-kit-result", component: AssemblekitResult, name: "assemble-kit-result", },
            { path:"/question",component:Question, name: "question" },

        ]
    },
    {
        path: "",
        component: WebLayout,
        beforeEnter: [
            AuthenticatedGuard
        ],
        children: [
            { path: "chat", component: Chat },
            { path: "verify-email", component: EmailVerification },
            { path: "profile", component: Profile },
        ]
    },
    {
        path:"/createfeedback",
        component:createfeedback,
    },
];
