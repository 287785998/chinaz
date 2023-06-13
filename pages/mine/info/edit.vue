<template>
  <view class="container">
    <view class="example">
		<view style="width: 100%; text-align: center; margin: 40rpx auto; align-items: center;	flex: auto;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;">
		<u-avatar @tap="changeAvatar" v-if="userpics" size="80" :src="userpics"></u-avatar>
		<u-avatar @tap="changeAvatar" size="80" v-else :src="user.userpic"></u-avatar>
		<view>{{user.username}}</view>
		</view>
      <uni-forms ref="form" :model="user" labelWidth="80px">

<!-- 		<image @tap="changeAvatar" class="vcc-avatar" :src="userpics" mode="aspectFill"></image>
		<image @tap="changeAvatar" class="vcc-avatar" :src="userpic" mode="aspectFill"></image> -->
        <uni-forms-item label="用户姓名" name="truename">
          <uni-easyinput v-model="user.truename" placeholder="请输入姓名" />
        </uni-forms-item>
        <uni-forms-item label="手机号码" name="phone">
          <uni-easyinput v-model="user.phone" placeholder="请输入手机号码" />
        </uni-forms-item>
        <uni-forms-item label="邮箱" name="email">
          <uni-easyinput v-model="user.email" placeholder="请输入邮箱" />
        </uni-forms-item>
<!--        <uni-forms-item label="性别" name="sex" required>
          <uni-data-checkbox v-model="user.sex" :localdata="sexs" />
        </uni-forms-item> -->
      </uni-forms>
      <button type="primary" @click="submit">提交</button>
    </view>
	<z-tabbar :pagePath="'/pages/info/edit'"></z-tabbar>
  </view>
</template>

<script>
  import { getUserProfile } from "@/api/system/user"
  import { updateUserProfile } from "@/api/system/user"
  import { getInfo } from "@/api/login"
  import config from '@/config'
  const baseUrl = config.baseUrl

  export default {
    data() {
      return {
        user: {
          truename: "",
          phone: "",
          email: "",
        },
		userpic:'',
		userpics:'',
		uploadInfo:{},
        rules: {
          truename: {
            rules: [{
              required: true,
              errorMessage: '用户昵称不能为空'
            }]
          },
          phone: {
            rules: [{
              required: true,
              errorMessage: '手机号码不能为空'
            }, {
              pattern: /^1[3|4|5|6|7|8|9][0-9]\d{8}$/,
              errorMessage: '请输入正确的手机号码'
            }]
          },
          email: {
            rules: [{
              required: true,
              errorMessage: '邮箱地址不能为空'
            }, {
              format: 'email',
              errorMessage: '请输入正确的邮箱地址'
            }]
          }
        }
      }
    },
    onLoad() {
      this.getUser()
    },
    onReady() {
      this.$refs.form.setRules(this.rules)
    },
    methods: {
      getUser() {
        getInfo().then(res => {
			if(res.code == 1){
				let userid = res.data.userid;
				getUserProfile({userid:userid}).then(res=>{
					  this.user = res.data[0];
					  this.userpic = res.data[0].userpic;
				})
			}

        })
      },
			changeAvatar: function() {
				let that = this;
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album'], //从相册选择
					success: function(res) {
							const tempFilePaths = res.tempFilePaths;
							uni.uploadFile({
								url: baseUrl + '/ecmsapi/index.php?mod=user&act=uploaduserpic', 
								filePath: tempFilePaths[0],
								name: 'file',
								success: function(res) { 
									console.log(res);
									console.log(JSON.parse(res.data));
									this.uploadInfo = JSON.parse(res.data);
									that.userpics = this.uploadInfo.data.location;
								}
							});
							
							
					}
				});
			},
      submit(ref) {
		  let that = this;
        this.$refs.form.validate().then(res => {
			if(that.userpics){
				this.user.userpic = this.userpics
			}
          updateUserProfile(this.user).then(response => {
            this.$modal.msgSuccess("修改成功")
          })
        })
      }
    }
  }
</script>

<style lang="scss">
  page {
    background-color: #ffffff;
  }

  .example {
    padding: 15px;
    background-color: #fff;
  }

  .segmented-control {
    margin-bottom: 15px;
  }

  .button-group {
    margin-top: 15px;
    display: flex;
    justify-content: space-around;
  }

  .form-item {
    display: flex;
    align-items: center;
    flex: 1;
  }

  .button {
    display: flex;
    align-items: center;
    height: 35px;
    line-height: 35px;
    margin-left: 10px;
  }
</style>
