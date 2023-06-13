<template>
	<view class="indexm_list zvideo-feedlist">
		  <block v-for="(item,index) in posts" :key="index"> 
<view class="zvideo-feed">
                <view class="zvideo-feedtitle" >{{item.title}}</view>
                <view class="zvideo-feedlist-video radius">
<video playsinline="playsinline" x5-playsinline="x5-playsinline" webkit-playsinline="webkit-playsinline" t7-video-player-type="inline"  controls="true"  :src="item.url" class="mip-fill-content mip-replaced-content" style="width: 100%;">
</video>
 
                </view>
				
              </view>

		  

		   </block>
	</view>
</template>

<script>
	import util from '@/api/util.js';
	export default {
		name: "articleList",
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
					url: '/pages/movie/detail?classid=' + e.classid + '&id=' + e.id
				})
			},

		}
	}
</script>

<style lang="scss">
.zvideo-feedlist {
    padding: 0 0 40rpx 0;
}
.zvideo-feed {
    padding: 40rpx 0;
    z-index: 0;
}
.zvideo-feedtitle {
    font-weight: 700;
    text-overflow: -o-ellipsis-lastline;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    font-size: 32rpx;
    line-height: 40rpx;
    color: #3b3b3b;
}
.zvideo-feedlist .zvideo-timetag {
    padding-top: 20rpx;
}
.zvideo-timetag {
    -webkit-text-size-adjust: none;
    font-size: 24rpx;
}
.zvideo-feedlist-video {
    margin-top: 40rpx;
    position: relative;
    // background-color: #000;
}
.zvideo-timetag-prefix {
    display: inline-block;
}
.zvideo-timetag-prefix-container {
    display: -webkit-flex;
    display: -moz-box;
    display: flex;
    -webkit-align-items: center;
    -moz-box-align: center;
    align-items: center;
    -webkit-justify-content: left;
    -moz-box-pack: left;
    justify-content: left;
}
.zvideo-timetag-prefix-container-own {
    color: rgba(0,0,0,.54);
    margin-right: 20rpx;
    position: relative;
}
.zvideo-timetag-prefix-container-slash {
    height: 20rpx;
    width: 2rpx;
    margin-right: 20rpx;
    background-color: rgba(0,0,0,.54);
}
.zvideo-timetag-item {
    color: rgba(0,0,0,.54);
    margin-right: 20rpx;
    position: relative;
}
</style>
