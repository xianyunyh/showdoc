<template>
  <div class="hello">
    <el-form  status-icon  label-width="100px" class="infoForm" v-model="infoForm">
      <el-form-item :label="$t('item_name')+':'" >
        <el-input type="text" auto-complete="off" v-model="infoForm.item_name" placeholder="" ></el-input>
      </el-form-item>

      <el-form-item :label="$t('item_description')+':'" >
        <el-input type="text" auto-complete="off" v-model="infoForm.item_description" placeholder="" ></el-input>
      </el-form-item>

      <el-form-item :label="$t('visit_password')+':'">
        <el-input type="password" auto-complete="off" :placeholder="$t('visit_password_description')" v-model="infoForm.password"></el-input>
      </el-form-item>

       <el-form-item label="" >
        <el-button type="primary" style="width:100%;" @click="FormSubmit" >{{$t('submit')}}</el-button>
      </el-form-item>

    </el-form>
  </div>
</template>

<script>
import { updateItem } from "@/api/api";

export default {
  name: 'Login',
  props:['infoForm'],
  components : {

  },
  data () {
    return {
     
    }

  },
  methods: {
      async FormSubmit() {
          var that = this ;
          var item_id = that.$route.params.item_id
          var params = new URLSearchParams();
          params.append('item_name', this.infoForm.item_name);
          params.append('item_description', this.infoForm.item_description);
          //params.append('item_domain', this.infoForm.item_domain);
          params.append('password', this.infoForm.password);
          let data = await updateItem(item_id,params)
          if(data.status == 1) {
            this.$message.success(data.msg);
          }else{
            this.$message.error(data.msg);
          }
      },
  },

  mounted(){
   // this.get_item_info();
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
  width: 600px;
  height: 500px;
}

.infoForm{
  width:350px;
  margin-left: 60px;
  margin-top: 30px;
}

.goback-btn{
  z-index: 999;
  margin-left: 500px;
}
</style>
