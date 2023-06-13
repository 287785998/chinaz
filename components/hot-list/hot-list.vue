<template>
	<view class="list">
		  <block v-for="(item,index) in posts" :key="index"> 
<view :class="'li li'+index" @click="gotoDetail(item)">
	<view class="num fir">{{index+1}}</view>
		<view :title="item.title" class="a">{{item.title}}</view>
		<view class="author">{{item.onclick}}次阅读</view>
</view>
		   </block>
	</view>
</template>

<script>
	import util from '@/api/util.js';
	export default {
		name: "hotList",
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
.list .li{
    position: relative;
    margin-top: 20rpx;
    padding-bottom: 20rpx;
    font-size: 32rpx;
    padding-left: 48rpx;
}
.list .num {
	position: absolute;
    top: 3px;
    left: 0;
    display: block;
    width: 16px;
    height: 16px;
    box-sizing: border-box;
    font-size: 12px;
    line-height: 15px;
    text-align: center;
    color: #fff;
    border-radius: 2px;
    background: #ababab;
}

	.list .li0 .fir {
		background: #f84521
	}

	.list .li1 .fir {
		background: #ff6e25
	}

	.list .li2 .fir {
		background: #ff8b25
	}
	.list .a {
		display: block;
		color: #3b3b3b;
		line-height: 52rpx;
		box-sizing: border-box;
	}
	.list .author {
		line-height: 36epx;
		color: #ababab;
		font-size: 24rpx;
	}
</style>