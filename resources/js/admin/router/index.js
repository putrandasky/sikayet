import Vue from 'vue';
import Router from 'vue-router';
// import store from "@/admin/store/index";
// import pipeline from "@/admin/router/pipeline";

// import auth from "@/admin/middleware/auth";
// import admin from "@/admin/middleware/admin";
// import guest from "@/admin/middleware/guest";

import AppMain from '../view/main/AppMain.vue'
import Dashboard from '../view/main/dashboard/Dashboard.vue'
import Users from '../view/main/users/Users.vue'
import Companies from '../view/main/companies/Companies.vue'
import CompaniesUnactive from '../view/main/companies/CompaniesUnverified.vue'
import CompaniesRegular from '../view/main/companies/CompaniesRegular.vue'
import CompaniesPremium from '../view/main/companies/CompaniesPremium.vue'
import CompaniesSuspended from '../view/main/companies/CompaniesSuspended.vue'
import Reviews from '../view/main/reviews/Reviews.vue'
import ReviewsNew from '../view/main/reviews/ReviewsNew.vue'
// import ReviewsActive from '../view/main/reviews/ReviewsActive.vue'
import ReviewsReported from '../view/main/reviews/ReviewsReported.vue'
import ReviewsSuspended from '../view/main/reviews/ReviewsSuspended.vue'
import ReviewsOrphans from '../view/main/reviews/ReviewsOrphans.vue'
import Billing from '../view/main/billing/Billing.vue'
import BillingList from '../view/main/billing/BillingList.vue'
import Contact from '../view/main/contact/Contact.vue'
import Editor from '../view/main/editor/Editor.vue'
import EditorHomepage from '../view/main/editor/EditorHomepage.vue'
import EditorAbout from '../view/main/editor/EditorAbout.vue'
import EditorFaq from '../view/main/editor/EditorFaq.vue'
import EditorMembershipInfo from '../view/main/editor/EditorMembershipInfo.vue'
import EditorPrivacyPolicy from '../view/main/editor/EditorPrivacyPolicy.vue'
import EditorTerms from '../view/main/editor/EditorTerms.vue'
import EditorAgreement from '../view/main/editor/EditorAgreement.vue'
import EditorSocial from '../view/main/editor/EditorSocial.vue'
import Membership from '../view/main/membership/Membership.vue'
import Adsense from '../view/main/adsense/Adsense.vue'
import BusinessCategory from '../view/main/categories/BusinessCategory.vue'
import ThirdParties from '../view/main/thirdparties/ThirdParties.vue'
import ThirdPartiesPayment from '../view/main/thirdparties/ThirdPartiesPayment.vue'
import ThirdPartiesSocial from '../view/main/thirdparties/ThirdPartiesSocial.vue'

import AppAuth from '../view/Auth/App.vue'
import Login from '../view/Auth/Login.vue'
import Members from '../view/Auth/Users.vue'
import Profile from '../view/Auth/Profile.vue'


Vue.use(Router);


const routes = [{
    path: '/',
    redirect: 'dashboard',
    component: AppMain,
    children: [{
        path: '/dashboard',
        name: 'dashboard',

        component: Dashboard,
      },
      {
        path: '/users',
        name: 'users',

        component: Users,
      },
      {
        path: '/companies',
        name: 'companies',
        redirect: '/companies/unactive',
        component: Companies,
        children: [{
            path: 'unactive',
            name: 'companiesUnactive',
            component: CompaniesUnactive,
          },
          {
            path: 'regular',
            name: 'companiesRegular',
            component: CompaniesRegular,
          },
          {
            path: 'premium',
            name: 'companiesPremium',
            component: CompaniesPremium,
          },
          {
            path: 'suspended',
            name: 'companiesSuspended',
            component: CompaniesSuspended,
          },
        ]
      },
      {
        path: '/adsense',
        name: 'adsense',

        component: Adsense,
      },
      {
        path: '/business-category',
        name: 'businessCategory',

        component: BusinessCategory,
      },
      {
        path: '/contact',
        name: 'contact',

        component: Contact,
      },
      {
        path: '/membership',
        name: 'membership',

        component: Membership,
      },
      {
        path: '/billings',
        redirect: '/billings/unpaid',
        component: Billing,
        children: [{
          path: ':condition',
          name: 'bilingList',
          component: BillingList,
        }, ]
      },
      {
        path: '/reviews',
        redirect: '/reviews/new',
        component: Reviews,
        children: [{
            path: 'new',
            name: 'reviewsNew',
            component: ReviewsNew,
          },
          {
            path: 'reported',
            name: 'reviewsReported',
            component: ReviewsReported,
          },
          {
            path: 'suspended',
            name: 'reviewsSuspended',
            component: ReviewsSuspended,
          },
          {
            path: 'orphans',
            name: 'reviewOrphans',
            component: ReviewsOrphans,
          },
        ]
      },
      {
        path: '/thirdparties',
        redirect: '/thirdparties/payment',
        component: ThirdParties,
        children: [{
            path: 'payment',
            name: 'thirdpartiesPayment',
            component: ThirdPartiesPayment,
          },
          {
            path: 'social',
            name: 'thirdpartiesSocial',
            component: ThirdPartiesSocial,
          }
        ]
      },
      {
        path: '/register',
        name: 'adminRegister',
        component: Members,
      },
      {
        path: '/profile',
        name: 'adminProfile',
        component: Profile,
      },
      {
        path: '/editor',
        redirect: '/editor/homepage',
        component: Editor,
        children: [{
            path: 'homepage',
            name: 'editorHomepage',
            component: EditorHomepage,
          },
          {
            path: 'faq',
            name: 'editorFaq',
            component: EditorFaq,
          },
          {
            path: 'about',
            name: 'editorAbout',
            component: EditorAbout,
          },
          {
            path: 'membership-information',
            name: 'editorMembershipInfo',
            component: EditorMembershipInfo,
          },
          {
            path: 'privacy-policy',
            name: 'editorPrivacyPolicy',
            component: EditorPrivacyPolicy,
          },
          {
            path: 'agreement',
            name: 'editorAgreement',
            component: EditorAgreement,
          },
          {
            path: 'terms',
            name: 'editorTerms',
            component: EditorTerms,
          },
          {
            path: 'social',
            name: 'editorSocial',
            component: EditorSocial,
          },

        ]
      },
    ],
  },

  {
    path: '/auth',
    redirect: 'login',
    component: AppAuth,
    children: [{
        path: 'login',
        name: 'login',
        component: Login,

      },
      // {
      //   path: 'users',
      //   name: 'users',
      //   component: Users,
      //   meta: {
      //     middleware: [auth, admin]
      //   },
      // },
      // {
      //   path: 'profile',
      //   name: 'profile',
      //   component: Profile,
      //   meta: {
      //     middleware: [auth, admin]
      //   },
      // },

    ]
  },

  //   {
  //     path: "/:catchAll(.*)",
  //     name: "notFound",
  //     component: NotFound,

  //   },
]

const router = new Router({
  mode: "history",
  base: '/admin',
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return {
        x: 0,
        y: 0
      };
    }
  },
});

// router.beforeEach((to, from, next) => {
//   const middleware = to.meta.middleware;
//   const context = {
//     to,
//     from,
//     next,
//     store
//   };

//   if (!middleware) {
//     return next();
//   }

//   middleware[0]({
//     ...context,
//     next: pipeline(context, middleware, 1),
//   });
// });


router.mode = 'html5'

export default router
