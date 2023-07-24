<template>
	<view>
		  <view class="wrap-header "> 
		   <view class="left"> 
			<view :title="siteinfo.sitename || '网站管理系统'" @click="gohome()" class="logo"><image src="@/static/images/logo.png" style="height: 64rpx;" mode="aspectFill"></image></view> 
		   </view> 
		   <view class="right"> 
		   <u-icon name="search" @click="showsearch()" size="32"></u-icon>
		   <u-icon name="list" @click="showclass()" size="32" style="margin-left: 30rpx;"></u-icon>
		   </view> 
		  </view>
		  
		  

			<u-popup :show="searchpop" @close="closesearch" mode="top" :closeOnClickOverlay="true" :closeable="true">
				<view class="search" style="padding: 10rpx; margin-top: 80rpx; margin-bottom: 40rpx;">
					<u-search v-model="keywords" @custom="searchsubmit" @search="searchsubmit" @clear="clear"></u-search>
				</view>
			</u-popup>
			
			<u-popup :show="classpop" @close="closeclass" mode="top" :closeOnClickOverlay="true" :closeable="true">
				<view class="search" style="padding: 40rpx; margin-top: 80rpx;">
	<u-cell-group>
		<u-cell icon="arrow-left" customStyle="background: #f5f6fa;" title="返回" @click="gobackclass()" arrow-direction="down"></u-cell>
		<block v-for="(item,index) in list" :key="index" >
			<u-cell :title="item.classname" :isLink="true" @click="gochild(item)" v-if="item.islast != 1" arrowDirection="down"></u-cell>
			<u-cell :title="item.classname" @click="goclass(item,index)" v-else></u-cell>
		</block>
	</u-cell-group>
				</view>
			</u-popup>
		  
	</view>
</template>

<script>
	import { getSystemInfo,getClassList } from '@/api/api'
	export default {
		name: 'topMenu',
		props: {
			classinfo: {},
		},
		data() {
			return {
				isShow: true, //true前台显示
				isIframe: false ,//true后台显示
				siteinfo:{},
				list:[],
				searchpop:false,
				keywords:'',
				classpop:false
			};
		},
		mounted() {
			
		},
		created() {
			if(uni.getStorageSync('siteinfo')){
				this.siteinfo = uni.getStorageSync('siteinfo');
			}else{
				this.getSystemInfo();
			};
			if(uni.getStorageSync('clist')){
				this.list = uni.getStorageSync('clist');
			}else{
				this.getClassList();
			};
		},
		methods: {
			gohome(){
				uni.reLaunch({
					url:'pages/index'
				})
			},
			getSystemInfo(){
				getSystemInfo().then(res=>{
					this.siteinfo = res.data[0];
					uni.setStorageSync('siteinfo',res.data[0]);
				}).catch(err=>{
					
				})
			},
			getClassList(){
				getClassList({
					classid:this.classid
				}).then(res=>{
					this.list = res.list;
					uni.setStorageSync('clist',res.list);
				}).catch(err=>{
					
				})
			},
			showsearch(){
				this.searchpop = true
			},
			closesearch(){
				this.searchpop = false
			},
			searchsubmit(){
				if(this.keywords == ''){
					this.$u.toast('请输入关键词搜索')
				}else{
					// if(this.classinfo.tbname == 'news'){
						uni.reLaunch({
							url:'/pages/article/list?keywords='+this.keywords
						})
					// }else{
					// 	this.$u.toast('缺少模板')
					// }
				}
			},
			clear(){
				this.keywords = ''
			},
			showclass(){
				this.classpop = true
			},
			closeclass(){
				this.classid = 0;
				this.classpop = false;
			},
			gobackclass(){
				this.classid = 0;
				this.list = [];
				this.getClassList();
			},
			gochild(info){
				if(info.classid){
					this.classid = info.classid;
					this.list = [];
					this.getClassList();
				}
			},
			goclass(info,index){
				uni.reLaunch({
					url:'/pages/article/list?id='+info.classid+'&current='+index
				})
			}

		}
	}
</script>

<style lang="scss">

.wrap-header {
    // position: fixed;
    // width: 100%;
    height: 100rpx;
    background: #fefefe;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    z-index: 1003;
    // padding: 0 28rpx !important;
	border-bottom: 2rpx solid #f0f0f0;
}
.wrap-header .left {
    padding: 10rpx 0;
}
.wrap-header .left, .wrap-header .right {
    position: relative;
    float: left;
    font-size: 0;
    z-index: 10;
}
.wrap-header .logo {
    width: 236rpx;
    height: 64rpx;
    background-size: cover;
}
.wrap-header .right {
    float: right;
    display: flex;
    align-items: center;
    height: 100%;
    // margin-right: -40rpx;
}

</style>
