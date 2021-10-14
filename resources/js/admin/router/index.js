import Vue from 'vue';
import Router from 'vue-router';
import store from "@/admin/store/index";
import pipeline from "@/admin/router/pipeline";

import auth from "@/admin/middleware/auth";
import admin from "@/admin/middleware/admin";
import guest from "@/admin/middleware/guest";

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
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/users',
        name: 'users',
        component: Users,
        meta: {
          middleware: [auth, admin]
        },
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
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'regular',
            name: 'companiesRegular',
            component: CompaniesRegular,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'premium',
            name: 'companiesPremium',
            component: CompaniesPremium,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'suspended',
            name: 'companiesSuspended',
            component: CompaniesSuspended,
            meta: {
              middleware: [auth, admin]
            },
          },
        ]
      },
      {
        path: '/adsense',
        name: 'adsense',
        component: Adsense,
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/business-category',
        name: 'businessCategory',
        component: BusinessCategory,
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/contact',
        name: 'contact',
        component: Contact,
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/membership',
        name: 'membership',
        component: Membership,
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/billings',
        redirect: '/billings/unpaid',
        component: Billing,
        children: [{
          path: ':condition',
          name: 'bilingList',
          component: BillingList,
          meta: {
            middleware: [auth, admin]
          },
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
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'reported',
            name: 'reviewsReported',
            component: ReviewsReported,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'suspended',
            name: 'reviewsSuspended',
            component: ReviewsSuspended,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'orphans',
            name: 'reviewOrphans',
            component: ReviewsOrphans,
            meta: {
              middleware: [auth, admin]
            },
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
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'social',
            name: 'thirdpartiesSocial',
            component: ThirdPartiesSocial,
            meta: {
              middleware: [auth, admin]
            },
          }
        ]
      },
      {
        path: '/register',
        name: 'adminRegister',
        component: Members,
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/profile',
        name: 'adminProfile',
        component: Profile,
        meta: {
          middleware: [auth, admin]
        },
      },
      {
        path: '/editor',
        redirect: '/editor/homepage',
        component: Editor,
        children: [{
            path: 'homepage',
            name: 'editorHomepage',
            component: EditorHomepage,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'faq',
            name: 'editorFaq',
            component: EditorFaq,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'about',
            name: 'editorAbout',
            component: EditorAbout,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'membership-information',
            name: 'editorMembershipInfo',
            component: EditorMembershipInfo,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'privacy-policy',
            name: 'editorPrivacyPolicy',
            component: EditorPrivacyPolicy,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'agreement',
            name: 'editorAgreement',
            component: EditorAgreement,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'terms',
            name: 'editorTerms',
            component: EditorTerms,
            meta: {
              middleware: [auth, admin]
            },
          },
          {
            path: 'social',
            name: 'editorSocial',
            component: EditorSocial,
            meta: {
              middleware: [auth, admin]
            },
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
        meta: {
          middleware: [guest]
        },
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
  base: '/adm',
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

router.beforeEach((to, from, next) => {
  const middleware = to.meta.middleware;
  const context = {
    to,
    from,
    next,
    store
  };

  if (!middleware) {
    return next();
  }

  middleware[0]({
    ...context,
    next: pipeline(context, middleware, 1),
  });
});


router.mode = 'html5'

export default router
