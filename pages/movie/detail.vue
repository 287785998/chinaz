<template>
	<view class="">
		<top-menu :classinfo="navinfo" style="padding: 0 20rpx;"></top-menu>
		<view class="container">
			<view class="main-inner">
				<view class="sub-line">
            <text class="article-auther">{{navinfo.classname}}</text>
        -
        <text class="article-auther line" style="margin-left: 10rpx;">{{detail.playadmin}}</text>


        <span class="time">{{detail.newstime}}</span>
				</view>
				<view class="article-title">{{detail.title}}</view>
				<view class="article_content">
					<u-parse :content="detail.newstext"></u-parse>
				</view>
				<view class="article_content">
					<play-list :posts="moielist"></play-list>
					 <u-loadmore class="loadmore" :status="status" />
				</view>
				
			</view>
		</view>
		<u-gap height="10" bgColor="#eee"></u-gap>
		<view class="container">
			<view class="article-suggest  hot-search">
				<view class="title">最热文章</view>
				<hot-list :posts="list"></hot-list>
			</view>
		</view>
		<u-gap height="10" bgColor="#eee"></u-gap>
		<view class="container">
			<view class="article-suggest  hot-search">
				<view class="title">最新文章</view>
				<new-list :posts="list"></new-list>
			</view>
		</view>

      
		<u-back-top :scroll-top="scrollTop"></u-back-top>
		<z-tabbar :pagePath="'/pages/article/detail'"></z-tabbar>
	</view>
</template>
<script>
  import { getClassList,getMovieList,geNavClassInfo,getMovieDetail,getMovieDetailMovieList } from '@/api/api'
  import util from '@/api/util.js';
  export default {
	data() {
		return {
			keywords: '',
			classid:0,
			id:null,
			page:1,
			pagesize:10,
			list:[],
			status:'loading',
			scrollTop: 0,
			detail:{},
			navinfo:{},
			moielist:[],
		};
	},
	onLoad(options) {
		if(options.id){
			if(options.keyword){
				this.keywords = options.keyword;
			}
			this.id = options.id;
			this.classid = options.classid;
			this.getNewsDetail();
			this.getMovieDetailMovieList();
			this.getNavClassInfo();
			this.getNewsList();
		};
			
	},
	onPageScroll(e) {
		this.scrollTop = e.scrollTop;
	},
	//触底加载
	onReachBottom() {
		// if(!this.isLastPage){
		// 	this.getNewsList();
		// }
	},
	onPullDownRefresh() {
		// this.page = 1;
		// this.list = [];
		// this.getNewsList();
	},
	methods: {
		//去详情
		navTo(info) {
			uni.navigateTo({
				url: '/pages/msg/details?id='+info.id
			});
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
		//详情
		getNewsDetail(){
			getMovieDetail({id:this.id}).then(res=>{
				this.detail = res.data.detail;
				uni.setNavigationBarTitle({
					title: res.data.title
				});
				this.detail.newstext = res.data.detail.moviesay.replace(/\\/g, '');
				this.detail.newstime = util.formatTime(new Date(res.data.detail.newstime*1000));
			}).catch(err=>{
				
			})
		},
		//视频列表
		getMovieDetailMovieList(){
			getMovieDetailMovieList({id:this.id}).then(res=>{
					if (res.data.moielist.length < this.pagesize) {
						this.isLastPage = true
						this.status = 'nomore'
					}
					this.moielist = this.moielist.concat(res.data.moielist);
					this.page = this.page + 1;
					this.isLoading = false;
			}).catch(err=>{
				
			})
		},

		getNewsList(){
			getMovieList({
				page:this.page,
				pagesize:this.pagesize,
				classid:this.classid,
				keyword:this.keywords
			})
			.then(res => {
				// uni.stopPullDownRefresh();
				// uni.hideLoading();
				if (res.code == '1') {
					this.list = res.data.list;
						// if (res.data.list.length < this.pagesize) {
						// 	this.isLastPage = true
						// 	this.status = 'nomore'
						// }
						// this.list = this.list.concat(res.data.list);
						// this.page = this.page + 1;
						// this.isLoading = false;
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
