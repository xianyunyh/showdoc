<template>
  <div class="hello">
    <Header> </Header>

    <el-container>
          <el-card class="center-card">
            <el-form  status-icon  label-width="0px" class="demo-ruleForm"  :model="ruleForm" :rules="rules" ref="ruleForm">
              <h2>{{$t("login")}}</h2>
              <el-form-item label="" prop="username" >
                <el-input type="text" auto-complete="off" :placeholder="$t('username_description')" v-model="ruleForm.username"></el-input>
              </el-form-item>

              <el-form-item label="" prop="password" >
                <el-input type="password" auto-complete="off" v-model="ruleForm.password" :placeholder="$t('password')"></el-input>
              </el-form-item>

              <el-form-item label="" v-if="show_v_code">
                <el-input type="text" auto-complete="off" v-model="v_code" :placeholder="$t('verification_code')"></el-input>
                <img v-bind:src="v_code_img"  class="v_code_img" v-on:click="change_v_code_img" >

              </el-form-item>

               <el-form-item label="" >
                <el-button type="primary" style="width:100%;" @click="onSubmit('ruleForm')" >{{$t("login")}}</el-button>
              </el-form-item>

              <el-form-item label="" >
                  <router-link to="/user/register">{{$t("register_new_account")}}</router-link>
              </el-form-item>
            </el-form>
          </el-card>
    </el-container>

    <Footer> </Footer>
    
  </div>
</template>

<script>
import {login} from '@/api/api'

export default {
  name: 'Login',
  components : {

  },
  data () {
    return {
      v_code: '',
      v_code_img:DocConfig.server+'/api/common/verify',
      show_v_code:false,
      ruleForm:{
        username: '',
        password: '',
      },
        rules: {
            username: [
                { required: true, message: '请输入用户名', trigger: 'blur' },
            ],
            password: [
                { required: true, message: '请输入密码', trigger: 'change' }
            ]
        }
    }

  },
  methods: {
     async onSubmit(formName) {
         this.$refs[formName].validate((valid) => {
              if (!valid) {
                  console.log('error submit!!');
                  return false;
              }
              var that = this ;
              var url = DocConfig.server+'/api/user/login';
              var params = new URLSearchParams();
              params.append('username', this.ruleForm.username);
              params.append('password', this.ruleForm.password);
              params.append('v_code', this.v_code);

              login(params).then(data=>{
                  sessionStorage.setItem('token',data.data.token)
                  sessionStorage.setItem('uid',data.data.uid)
                  this.$store.commit('setUser',data.data)
                  let redirect = decodeURIComponent(that.$route.query.redirect || '/item/index');
                  that.$router.replace({
                      path: redirect
                  });
              })

          });

          
      },
      change_v_code_img(){
        var rand = '&rand='+Math.random();
        this.v_code_img += rand ;
      }
  },
  mounted() {
    
    /*给body添加类，设置背景色*/
    document.getElementsByTagName("body")[0].className="grey-bg";
  },
  beforeDestroy(){
    /*去掉添加的背景色*/
    document.body.removeAttribute("class","grey-bg");
  }
}
</script>

<style scoped>

.center-card a {
  font-size: 12px;
}

.center-card{
  text-align: center;
}

.v_code_img{
  margin-top: 20px;
}

</style>
