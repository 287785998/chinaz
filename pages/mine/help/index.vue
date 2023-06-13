<template>
  <view class="help-container">
    <view class="list-title">
      <view class="text-title">
        <view class="iconfont icon-github"></view>国内新闻
      </view>
      <view class="childList">
        <view v-for="(item, index) in list" :key="index" class="question" hover-class="hover"
          @click="handleText(item)">
          <view class="text-item">{{ item.title }}</view>
          <view class="line" v-if="index !== item.length - 1"></view>
        </view>
      </view>
    </view>
    <view class="list-title">
      <view class="text-title">
        <view class="iconfont icon-help"></view>国际新闻
      </view>
      <view class="childList">
        <view v-for="(item, index) in list2" :key="index" class="question" hover-class="hover"
          @click="handleText(item)">
          <view class="text-item">{{ item.title }}</view>
          <view class="line" v-if="index !== item.length - 1"></view>
        </view>
      </view>
    </view>
	<z-tabbar :pagePath="'/pages/help/index'"></z-tabbar>
  </view>
</template>

<script>
  import { getNewsList } from '@/api/api'
  export default {
    data() {
      return {
        list: [],
		list2:[]
      }
    },
	onLoad() {
		this.getNewsList();
		this.getNewsList2();
	},
    methods: {
      handleText(item) {
        // this.$tab.navigateTo(`/pages/common/textview/index?title=${item.title}&content=${item.content}`)
		uni.reLaunch({
			url:'/pages/article/detail?id='+item.id+'&classid='+item.classid
		})
      },
	  getNewsList(){
		  getNewsList({classid:34}).then(res=>{
			  this.list = res.data.list
		  }).catch(err=>{
			  
		  })
	  },
	  getNewsList2(){
		  getNewsList({classid:35}).then(res=>{
			  this.list2 = res.data.list
		  }).catch(err=>{
			  
		  })
	  },
    }
  }
</script>

<style lang="scss" scoped>
  page {
    background-color: #f8f8f8;
  }

  .help-container {
    margin-bottom: 100rpx;
    padding: 30rpx;
  }

  .list-title {
    margin-bottom: 30rpx;
  }

  .childList {
    background: #ffffff;
    box-shadow: 0px 0px 10rpx rgba(193, 193, 193, 0.2);
    border-radius: 16rpx;
    margin-top: 10rpx;
  }

  .line {
    width: 100%;
    height: 1rpx;
    background-color: #F5F5F5;
  }

  .text-title {
    color: #303133;
    font-size: 32rpx;
    font-weight: bold;
    margin-left: 10rpx;

    .iconfont {
      font-size: 16px;
      margin-right: 10rpx;
    }
  }

  .text-item {
    font-size: 28rpx;
    padding: 24rpx;
  }

  .question {
    color: #606266;
    font-size: 28rpx;
  }
</style>
