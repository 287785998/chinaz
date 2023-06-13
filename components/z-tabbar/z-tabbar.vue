<template>
	<view>
		<u-gap height="80"></u-gap>
		<view class="uni-tabbar acea-row row-around row-middle" v-if="isShow && tabbar.length && !isIframe">
			<view class="uni-tabbar_item" v-for="(item,index) in tabbar" :key="index" @tap="changeTab(item)">
				<view class="uni-tabbar_icon">
					<image v-if="item.pagePath == pagePath" mode="aspectFit" :src="item.selectedIconPath"></image>
					<image v-else mode="aspectFit" :src="item.iconPath"></image>
				</view>
				<view class="uni-tabbar_label" :class="{'active': item.pagePath == pagePath}">
					{{item.text}}
				</view>
			</view>
		</view>
		<view class="uni-tabbar acea-row row-around row-middle" v-if="isIframe && tabbar.length">
			<view class="uni-tabbar_item" v-for="(item,index) in tabbar" :key="index" @tap="changeTab(item)">
				<view class="uni-tabbar_icon">
					<image v-if="item.pagePath == pagePath" mode="aspectFit" :src="item.selectedIconPath"></image>
					<image v-else mode="aspectFit" :src="item.iconPath"></image>
				</view>
				<view class="uni-tabbar_label" :class="{'active': item.pagePath == pagePath}">
					{{item.text}}
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'tabBar',
		props: {
			pagePath: null,
			dataConfig: {
				type: Object,
				default: () => {}
			},
		},
		watch: {
			dataConfig: {
				immediate: true,
				handler(nVal, oVal) {
					if (nVal) {
						this.isShow = nVal.isShow.val;
					}
				}
			}
		},
		data() {
			return {
				name: this.$options.name,
				page: '/pages/index',
				tabbar:  [
					 {
						"pagePath": "/pages/index",
						"iconPath": "/static/images/tabbar/menu1h.png",
						"selectedIconPath": "/static/images/tabbar/menu1.png",
						"text": "首页"
					},
					{
						"pagePath": "/pages/article/list",
						"iconPath": "/static/images/tabbar/menu2h.png",
						"selectedIconPath": "/static/images/tabbar/menu2.png",
						"text": "文章"
					},
					{
						"pagePath": "/pages/sort/index",
						"iconPath": "/static/images/tabbar/menu3h.png",
						"selectedIconPath": "/static/images/tabbar/menu3.png",
						"text": "排行"
					},
					{
						"pagePath": "/pages/mine/index",
						"iconPath": "/static/images/tabbar/menu4h.png",
						"selectedIconPath": "/static/images/tabbar/menu4.png",
						"text": "我的"
					}
				],
				isShow: true, //true前台显示
				isIframe: false //true后台显示
			};
		},
		mounted() {
			if (!this.tabbar.length) this.getDiyData()
		},
		methods: {
			changeTab(item) {
				// goPage().then(res => {
					this.page = item.pagePath;
					// 这里使用reLaunch关闭所有的页面，打开新的栏目页面
					uni.switchTab({
						url: this.page,
						fail: () => {
							// console.log('err');
							uni.navigateTo({
								url: this.page
							})
						}
					});
				// })
			},
		}
	}
</script>

<style lang="scss" scoped>
	.borderShow {
		position: fixed;
	}

	.borderShow .uni-tabbar::after {
		content: ' ';
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		border: 1px dashed #007AFF;
		box-sizing: border-box;
	}

	.uni-tabbar {
		position: fixed;
		bottom: 0;
		left: 0;
		z-index: 999;
		width: 100%;
		padding: 6rpx 0;
		padding-bottom: calc(6rpx + constant(safe-area-inset-bottom)); ///兼容 IOS<11.2/
		padding-bottom: calc(6rpx + env(safe-area-inset-bottom)); ///兼容 IOS>11.2/
		box-sizing: border-box;
		border-top: solid 1rpx #F3F3F3;
		background-color: #fff;
		box-shadow: 0px 0px 17rpx 1rpx rgba(206, 206, 206, 0.32);
		display: flex;
		flex-wrap: nowrap;
		align-items: center;
		justify-content: space-around;

		.uni-tabbar_item {
			width: 100%;
			font-size: 20rpx;
			text-align: center;
		}

		.uni-tabbar_icon {
			height: 48rpx;
			width: 48rpx;
			text-align: center;
			margin: 0 auto;

			image {
				width: 100%;
				height: 100%;
			}
		}

		.uni-tabbar_label {
			font-size: 24rpx;
			color: rgb(40, 40, 40);

			&.active {
				color: #006abe;
			}
		}
	}
</style>
