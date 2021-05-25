<template>
  <div class="page form_page js_show">
    <div class="weui-form">

      <div class="weui-form__control-area">
        <div class="weui-cells__group weui-cells__group_form">

          <div class="weui-cells weui-cells_form">
            <div class="weui-cell weui-cell_active">
              <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
              <div class="weui-cell__bd">
                <input  class="weui-input" name="username" v-model="username" placeholder="用户名">
              </div>
            </div>
            <div class="weui-cell weui-cell_active">
              <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
              <div class="weui-cell__bd">
                <input type="password" name="password" v-model="password" class="weui-input" placeholder="密码">
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="weui-form__opr-area">
        <a class="weui-btn weui-btn_primary " @click="log()" href="javascript:" >登录</a>
      </div>
      <div class="weui-form__opr-area">
        <a class="weui-btn weui-btn_primary " @click="reg()"  href="javascript:" >注册</a>
      </div>

    </div>



  </div>
</template>
<script>
import {login,register,is_login} from "@/utils/member";

export default {
    data()  {
        return {
            username : '',
            password : '',
        };
    },
    mounted() {
        if ( is_login() === true )
        {

            this.$router.push({path:'/'});
        }
    },

    methods : {
        reg(){
            let that = this;
            register(that.username,that.password);
        },
        log(){
            let that = this;
            login(that.username,that.password);
        },
    },
}
</script>
<style>

</style>