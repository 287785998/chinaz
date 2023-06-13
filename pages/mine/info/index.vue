<template>
  <view class="container">
    <uni-list>
      <uni-list-item showExtraIcon="true" :extraIcon="{type: 'person-filled'}" title="姓名" :rightText="user.truename" />
      <uni-list-item showExtraIcon="true" :extraIcon="{type: 'phone-filled'}" title="手机号码" :rightText="user.phone" />
      <uni-list-item showExtraIcon="true" :extraIcon="{type: 'email-filled'}" title="邮箱" :rightText="user.email" />
<!--      <uni-list-item showExtraIcon="true" :extraIcon="{type: 'auth-filled'}" title="岗位" :rightText="postGroup" /> -->
      <uni-list-item showExtraIcon="true" :extraIcon="{type: 'staff-filled'}" title="角色" :rightText="user.groupname" />
      <uni-list-item showExtraIcon="true" :extraIcon="{type: 'calendar-filled'}" title="创建日期" :rightText="user.registertime" />
    </uni-list>
	<z-tabbar :pagePath="'/pages/info/index'"></z-tabbar>
  </view>
</template>

<script>
  import { getUserProfile } from "@/api/system/user"
  import { getInfo } from "@/api/login"
  import util from '@/api/util.js';

  export default {
    data() {
      return {
        user: {},
        roleGroup: "",
        postGroup: "",
		userid: this.$store.state.user.userid,
      }
    },
    onLoad() {
      this.getUser();
	  console.log(this.$store.state.user);
    },
    methods: {
      getUser() {
        getInfo().then(res => {
			if(res.code == 1){
				let userid = res.data.userid;
				getUserProfile({userid:userid}).then(res=>{
					  this.user = res.data[0];
					  this.user.registertime = util.formatTime(new Date(res.data[0].registertime*1000));
				})
			}

        })
      }
    }
  }
</script>

<style lang="scss">
  page {
    background-color: #ffffff;
  }
</style>
