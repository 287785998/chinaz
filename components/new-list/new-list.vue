<template>
	<view class="indexm_list">
		  <block v-for="(item,index) in posts" :key="index"> 
		   <view class="node" v-if="item.titlepic"  @click="gotoDetail(item)"> 
			<view class="node_left"> 
			 <view class="middle"> 
			  <view class="ptitle">{{item.title}}</view>
			  <view class="author"> 
			   <text class="date">{{item.newstime}}</text> 
			   <text>{{item.onclick}}阅读</text> 
			  </view>
			 </view>
			</view> 
			<view class="pic-cover">
				<u--image :lazy-load="true" radius="6px" :src="item.titlepic" width="260rpx" height="180rpx"></u--image>
				<!-- <image class="mip-fill-content mip-replaced-content" :alt="item.title" :src="item.titlepic"></image> -->
				</view> 
			<view class="clearfix"></view>
		   </view>
		   <view class="node"  @click="gotoDetail(item)" v-else> 
			<view class="node_left"> 
			 <view class="middle"> 
			  <view class="ptitle">{{item.title}}</view>
			  <view class="author"> 
			   <text class="date">{{item.newstime}}</text> 
			   <text>{{item.onclick}}阅读</text> 
			  </view>
			 </view>
			</view> 
			<view class="clearfix"></view>
		   </view>
		   </block>
	</view>
</template>

<script>
	import util from '@/api/util.js';
	export default {
		name: "newList",
		props: {
			posts: {
				type: Array,
				default: [],
				},
		},
		data() {
			return {
				// posts:[]
			};
		},
		methods: {
			gotoDetail: function(e) {
				console.log(e);
				uni.navigateTo({
					url: '/pages/article/detail?classid=' + e.classid + '&id=' + e.id
				})
			},

		}
	}
</script>

<style lang="scss">
.indexm_list .indexm_list {
    margin-top: 40rpx;
}

.indexm_list .node {
    padding: 36rpx 0 36rpx;
    -webkit-box-orient: horizontal;
    -webkit-box-pack: inherit;
    -webkit-box-align: center;
    -moz-box-orient: horizontal;
    -moz-box-pack: inherit;
    -moz-box-align: center;
    display: box;
    box-orient: horizontal;
    box-pack: inherit;
    box-align: center;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    border-bottom: 2rpx solid #f0f0f0;
    font-size: 0;
}
.indexm_list .node .node_left {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-align-self: center;
    -ms-flex-item-align: center;
    align-self: center;
}
.node .ptitle {
    font-size: 17px;
    line-height: 1.47;
    color: #3b3b3b;
    -webkit-font-smoothing: antialiased;
    font-weight: 700;
    text-overflow: -o-ellipsis-lastline;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
}
.node .author {
    line-height: 1。2em;
    font-size: 11px;
    color: #ababab;
    margin-top: 5px;
    display: flex;
    align-items: center;
}
.node .author span {
    display: inline;
    vertical-align: middle;
    margin-right: 6px;
}
.indexm_list .node .pic-cover {
    // position: relative;
    // width: 180rpx;
    // height: 140rpx;
    // padding-top: 18.4%;
    // max-height: 60px;
    margin-left: 30rpx;
    // background-size: cover;
    // background-position: center;
    // background-repeat: no-repeat;
    border-radius: 12rpx;
    // overflow: hidden;
    // margin-top: 0.2rem;
}
.indexm_list .node .pic-cover:after {
    // position: absolute;
    // content: "";
    // left: 0;
    // top: 0;
    // width: 200%;
    // height: 200%;
    // border: solid 1px rgba(0,0,0,.1);
    // -webkit-transform: scale(.5);
    // -ms-transform: scale(.5);
    // transform: scale(.5);
    // -webkit-transform-origin: 0 0;
    // -ms-transform-origin: 0 0;
    // transform-origin: 0 0;
    // border-radius: 10px;
    // box-sizing: border-box;
}
.indexm_list .node .pic-cover img, .indexm_list .node .pic-cover uni-image {
    position: absolute;
	width: 180rpx;
	height: 140rpx;
    left: 0;
    top: 0;
}
</style>
