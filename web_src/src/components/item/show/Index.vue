<template>
  <div class="hello">
    <Header> </Header>
    
    <!-- 展示常规项目 -->
    <ShowRegularItem :item_info="item_info" :search_item="search_item" > 

    </ShowRegularItem>
    
    <div>

      <context-menu id="context-menu" ref="ctxMenu">
      <li @click="doSomething()">option 1</li>
      <li class="disabled">option 2</li>
      <li>option 3</li>
    </context-menu>
    </div>
    <Footer> </Footer>
    
  </div>
</template>



<script>
  import contextMenu from 'vue-context-menu'
  import ShowRegularItem from '@/components/item/show/show_regular_item/Index'
  import ShowSinglePageItem from '@/components/item/show/show_single_page_item/Index'
  import {getPages} from '@/api/api'
  export default {
    data() {
      return {
        item_info:'' ,
      }
    },
  components:{
    ShowRegularItem,
    ShowSinglePageItem,
    contextMenu
  },
  methods:{
    //获取菜单
    get_item_menu(keyword){
        if (!keyword) {
          keyword = '' ;
        };  
        var that = this ; 
        var loading = that.$loading();
        var item_id = this.$route.params.item_id ? this.$route.params.item_id : 0;
        var page_id = this.$route.query.page_id ? this.$route.query.page_id : 0  ;
        
        var url = DocConfig.server+'/api/item/detail/'+item_id;

        var params = new URLSearchParams();
        params.append('item_id',  item_id);
        params.append('keyword',  keyword);
        if ( !that.keyword) {
          params.append('default_page_id',page_id  );
        };
        that.axios.get(url, params)
          .then(function (response) {
            loading.close();
            console.log(response)
            if (response.status === 1 ) {
              var json = response.data ;
              that.item_info = json
            }
            else if (response.code === 10307 || response.code === 10303 ) {
              //需要输入密码
              that.$router.replace({
                  path: '/item/password/'+item_id,
                  query: {page_id: page_id,redirect: that.$router.currentRoute.fullPath}
              });
            }
            else{
              that.$alert(response.msg);
            }
            
          });
        //设置一个最长关闭时间
        setTimeout(() => {
          loading.close();
        }, 20000);
    },
    search_item(keyword){
      this.item_info = '';
      this.get_item_menu(keyword);
    },
    async getPages() {
      let id = this.$route.params.item_id
      let data = await getPages(id);
      console.log(data);
    }
  },
  mounted () {
    //this.getPages()
    this.get_item_menu();

  },
  beforeDestroy(){
    this.$message.closeAll();
    /*去掉添加的背景色*/
    document.body.removeAttribute("class","grey-bg");
    document.title = "ShowDoc" ;
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
