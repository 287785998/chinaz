<template>
	<view class="wrap">
		<top-menu :classinfo="navinfo"></top-menu>
		<u-sticky bgColor="#ffffff">
		<u-tabs :list="classlist" @click="tabClass" :current="current"
        lineColor="#006abe"
        :activeStyle="{
            color: '#303133',
            fontWeight: 'bold',
            transform: 'scale(1.05)'
        }"
        :inactiveStyle="{
            color: '#606266',
            transform: 'scale(1)'
        }"
		></u-tabs>
		</u-sticky>
		<view class="search">
			<u-search v-model="keywords" @custom="search" @search="search" @clear="clear"></u-search>
		</view>
		<view class="main-inner">
			<view class="article-suggest node latest-search">
				<view class="ctitle">{{navinfo.classname}}</view>
				<movie-list :posts="list"></movie-list>
			</view>
		</view>

        <u-loadmore class="loadmore" :status="status" />
		<u-back-top :scroll-top="scrollTop"></u-back-top>
		<z-tabbar :pagePath="'/pages/movie/list'"></z-tabbar>
	</view>
</template>
<script>
  import { getClassList,getMovieList,geNavClassInfo } from '@/api/api'
  export default {
	data() {
		return {
			keywords: '',
			classid:4,
			page:1,
			pagesize:10,
			list:[],
			current:0,
			status:'loading',
			navinfo:{
				classname:'新闻动态'
			},
			scrollTop: 0,
			classlist: [{
				name: '全部',
				classid:4
			}]
						
		};
	},
	onLoad(options) {
		if(options.id){
			if(options.keyword){
				this.keywords = options.keyword;
			}
			this.classid = options.id;
		};
		if(options.current){
			this.current = options.current;
			this.cl
		}
		if(options.keywords){
			this.keywords = options.keywords;
			// uni.setNavigationBarTitle({
			// 	title: this.keywords+'搜索结果'
			// });
		}
			this.getNewsList();
			this.getNavClassInfo();
			this.getClassList();
	},
	onPageScroll(e) {
		this.scrollTop = e.scrollTop;
	},
	//触底加载
	onReachBottom() {
		if(!this.isLastPage){
			this.getNewsList();
		}
	},
	onPullDownRefresh() {
		this.page = 1;
		this.list = [];
		this.getNewsList();
	},
	methods: {
		//去详情
		navTo(info) {
			uni.navigateTo({
				url: '/pages/msg/details?id='+info.id
			});
		},
		search(value) {
			//this.$u.toast('搜索内容为：' + value);
			this.keywords = value;
			this.page = 1;
			this.list = [];
			this.getNewsList();
		},
		clear(){
			this.keywords = '';
			this.page = 1;
			this.list = [];
			this.getNewsList();
		},
		//当前栏目信息
		getNavClassInfo(){
			geNavClassInfo({
				classid:this.classid
			})
			.then(res => {
				if (res.code == '1') {
					this.navinfo = res.list,
					uni.setNavigationBarTitle({
						title: res.list.classname
					});
				}
			});
		},
		getClassList(){
			getClassList({
				classid:4
			}).then(res=>{
				if(res.list && res.list.length > 0){
					res.list.forEach(item=>{
						item.name = item.classname
					})
				}
				this.classlist = this.classlist.concat(res.list)
			}).catch(err=>{
				
			})
		},
		tabClass(e){
			console.log(e.classid);
			uni.showLoading();
			this.classid = e.classid;
			this.page = 1;
			this.list = [];
			this.getNewsList();
		},
		getNewsList(){
			getMovieList({
				page:this.page,
				pagesize:this.pagesize,
				classid:this.classid,
				keyword:this.keywords
			})
			.then(res => {
				uni.stopPullDownRefresh();
				uni.hideLoading();
				if (res.code == '1') {
						if (res.data.list.length < this.pagesize) {
							this.isLastPage = true
							this.status = 'nomore'
						}
						this.list = this.list.concat(res.data.list);
						this.page = this.page + 1;
						this.isLoading = false;
				}
			});
		},

		
	}
};

</script>
<style lang="scss">
page {
	height: 100vh;
	background-color: #fff;
}
.wrap .search{
	background: #ffffff;
	margin-top:40rpx
}
.msg-time{
	font-size: 26rpx;
	padding: 10px 0;
	color: #999999;
	text-align: center;
}
.u-card__foot{
	.u-icon{
		margin-right: 10px;
	}
}


</style>
