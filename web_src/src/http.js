/**
 * http配置
 */

import axios from 'axios'
import router from '@/router/index'
import store from '@/store/index'
import { Loading, Message } from 'element-ui'
let loadingInstance = ''
// axios 配置
axios.defaults.timeout = 20000
axios.defaults.baseURL = 'http://127.0.0.11/'
// http request 拦截器
axios.interceptors.request.use(

    config => {
      console.log(config.method)
      if (config.method !== 'option') {
        loadingInstance = Loading.service({ fullscreen: true, text: '正在加载中', target: 'app' })
      }

       // store.commit('setLodding',true);
      if (store.state.token) {
        config.headers.Token = store.state.token
      }
      return config
    },
    err => {
      store.commit('setLodding', false)
      return Promise.reject(err)
    })

// http response 拦截器
axios.interceptors.response.use(
    response => {
      loadingInstance.close()
      if (response.config.data && response.config.data.indexOf('redirect_login=false') > -1) {
            // 不跳转到登录
      } else if (response.data.code === 9999) {
        console.log(1)
        router.replace({
          path: '/user/login',
          query: {redirect: router.currentRoute.fullPath}
        })
      }
      return response.data
    },
    error => {
      loadingInstance.close()
      const newLocal = '系统故障'
      Message({message: newLocal, type: error})
      return false
      // store.commit('setLodding',false);
     // return Promise.reject(error.response.data)
    })

export default axios
