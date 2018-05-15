import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import UserLogin from '@/components/user/Login'
import UserSetting from '@/components/user/Setting'
import UserRegister from '@/components/user/Register'
import UserResetPassword from '@/components/user/ResetPassword'
import ResetPasswordByUrl from '@/components/user/ResetPasswordByUrl'
import ItemIndex from '@/components/item/Index'
import ItemAdd from '@/components/item/Add'
import ItemPassword from '@/components/item/Password'
import ItemShow from '@/components/item/show/index'
import ItemExport from '@/components/item/export/index'
import ItemSetting from '@/components/item/setting/Index'
import PageIndex from '@/components/page/Index'
import PageEdit from '@/components/page/edit/Index'
import PageDiff from '@/components/page/Diff'
import Catalog from '@/components/catalog/Index'
import Notice from '@/components/notice/Index'
import store from '@/store/index'
Vue.use(Router)
const router =  new Router({
    routes: [
        {
            path: '/',
            name: 'Index',
            component: Index,
            meta: { requiresAuth: true }
        },
        {
            path: '/user/login',
            name: 'UserLogin',
            component: UserLogin
        },
        {
            path: '/user/setting',
            name: 'UserSetting',
            component: UserSetting,
            meta: { requiresAuth: true }
        },
        {
            path: '/user/register',
            name: 'UserRegister',
            component: UserRegister,
            meta: { requiresAuth: true }
        },
        {
            path: '/user/resetPassword',
            name: 'UserResetPassword',
            component: UserResetPassword,
            meta: { requiresAuth: true }
        },
        {
            path: '/user/ResetPasswordByUrl',
            name: 'ResetPasswordByUrl',
            component: ResetPasswordByUrl,
            meta: { requiresAuth: true }
        },
        {
            path: '/item/index',
            name: 'ItemIndex',
            component: ItemIndex,
            meta: { requiresAuth: true }
        },
        {
            path: '/item/add',
            name: 'ItemAdd',
            component: ItemAdd,
            meta: { requiresAuth: true }
        },
        {
            path: '/item/password/:item_id',
            name: 'ItemPassword',
            component: ItemPassword,
            meta: { requiresAuth: true }
        },
        {
            path: '/:item_id',
            name: 'ItemShow',
            component: ItemShow,
            meta: { requiresAuth: true }
        },
        {
            path: '/item/export/:item_id',
            name: 'ItemExport',
            component: ItemExport,
            meta: { requiresAuth: true }
        },
        {
            path: '/item/setting/:item_id',
            name: 'ItemSetting',
            component: ItemSetting,
            meta: { requiresAuth: true }
        },
        {
            path: '/page/:page_id',
            name: 'PageIndex',
            component: PageIndex,
            meta: { requiresAuth: true }
        },
        {
            path: '/page/edit/:item_id/:page_id',
            name: 'PageEdit',
            component: PageEdit,
            meta: { requiresAuth: true }
        },
        {
            path: '/page/diff/:page_id/:page_history_id',
            name: 'PageDiff',
            component: PageDiff,
            meta: { requiresAuth: true }
        },
        {
            path: '/catalog/:item_id',
            name: 'Catalog',
            component: Catalog,
            meta: { requiresAuth: true }
        },
        {
            path: '/notice/index',
            name: 'Notice',
            component: Notice,
            meta: { requiresAuth: true }
        },
    ]
});
router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {  // 判断该路由是否需要登录权限
        let token = sessionStorage.getItem('token');
        if(token != '') {
            store.commit({
                type: 'setUser',
                token: token
            });
        }
        console.log(token)
        if (store.state.token || token) {  // 通过vuex state获取当前的token是否存在

            next();
        } else {
            next({
                path: '/user/login',
                query: {redirect: to.fullPath}  // 将跳转的路由path作为参数，登录成功后跳转到该路由
            })
        }
    }
    else {
        next();
    }
})
export default router
