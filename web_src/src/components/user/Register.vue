<template>
  <div class="hello">
    <Header> </Header>

    <el-container>
          <el-card class="center-card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm"  status-icon  label-width="0px" class="demo-ruleForm">
              <h2>{{$t("register")}}</h2>
              <el-form-item label="" >
                <el-input type="text" auto-complete="off" :placeholder="$t('username_description')" v-model="ruleForm.username"></el-input>
              </el-form-item>

              <el-form-item label="" >
                <el-input type="password" auto-complete="off" v-model="ruleForm.password" :placeholder="$t('password')"></el-input>
              </el-form-item>

              <el-form-item label="" >
                <el-input type="password" auto-complete="off" v-model="confirm_password" :placeholder="$t('password_again')"></el-input>
              </el-form-item>

              <el-form-item label="" >
                <el-input type="text" auto-complete="off" v-model="v_code" :placeholder="$t('verification_code')" ></el-input>
                <img v-bind:src="v_code_img" class="v_code_img"   v-on:click="change_v_code_img" >

              </el-form-item>

               <el-form-item label="" >
                <el-button type="submit" style="width:100%;" @click="onSubmit('ruleForm')" >{{$t("register")}}</el-button>
              </el-form-item>

              <el-form-item label="" >
                  <router-link to="/user/login">{{$t("login")}}</router-link>
              </el-form-item>
            </el-form>
          </el-card>
    </el-container>

    <Footer> </Footer>
    
  </div>
</template>

<script>


export default {
  name: 'Register',
  components : {

  },
  data () {
    return {
      username: '',
      password: '',
      confirm_password:'',
      v_code: '',
      v_code_img:DocConfig.server+'/api/common/verify',
      ruleForm: {
          username: '',
        },
      rules: {
          username: [
            { required: true, message: '请输入活动名称', trigger: 'blur' },
          ]
        }
    }

  },
  methods: {
      onSubmit(formName) {
        
        this.$refs[formName].validate((valid) => {
          console.log(valid)
         if(!valid) {
           console.log('error submit!!');
            return false;
         }
          var that = this ;
          var url = DocConfig.server+'/api/user/register';

          var params = new URLSearchParams();
          params.append('username', this.username);
          params.append('password', this.password);
          params.append('confirm_password', this.confirm_password);
          params.append('v_code', this.v_code);

          that.axios.post(url, params)
            .then(function (response) {
              
              if (response.data.status === 1 ) {
                //that.$message.success("注册成功");
                that.$router.push({path:'/item/index'});
              }else{
                that.$alert(response.data.msg);
              }
              
            });
        
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
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
