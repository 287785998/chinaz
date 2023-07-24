<template>
	<view class="">
		<top-menu :classinfo="navinfo" style="padding: 0 20rpx;"></top-menu>
		<view class="container">
			<view class="main-inner">
				<view class="sub-line">
            <text class="article-auther">{{navinfo.classname}}</text>
        -
        <text class="article-auther line" style="margin-left: 10rpx;">{{detail.writer}}</text>


        <span class="time">{{detail.newstime}}</span>
				</view>
				<view class="article-title">{{detail.title}}</view>
				<view class="article_content">
					<u-parse :content="detail.newstext"></u-parse>
				</view>
				<view class="label-wrap  clearfix" v-if="detail.keyboard && detail.keyboard.length > 0">
<view class="label">相关话题</view>
<view class="lebel-list">
	<text v-for="item in detail.keyboard" class="a" @click="gokeyword(item)">{{item}}</text>
</view>
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

       <!-- <u-loadmore class="loadmore" :status="status" /> -->
		<u-back-top :scroll-top="scrollTop"></u-back-top>
		<z-tabbar :pagePath="'/pages/article/detail'"></z-tabbar>
	</view>
</template>
<script>
  import { getClassList,getNewsList,geNavClassInfo,getNewsDetail } from '@/api/api'
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
			navinfo:{}			
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
			getNewsDetail({id:this.id}).then(res=>{
				this.detail = res.data;
				uni.setNavigationBarTitle({
					title: res.data.title
				});
				this.detail.newstext = res.data.newstext.replace(/\\/g, '');
				this.detail.newstime = util.formatTime(new Date(res.data.newstime*1000));
			}).catch(err=>{
				
			})
		},

		getNewsList(){
			getNewsList({
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
		gokeyword(info){
			uni.reLaunch({
				url:'/pages/article/list?keywords='+info
			})
		}

		
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
.label-wrap {
    color: #ababab;
    display: block;
    font-size: 28rpx;
    margin-top: 40rpx;
    margin-bottom: 40rpx;
}
.label-wrap .label {
    float: left;
    margin-right: 40rpx;
    min-width: 120rpx;
    line-height: 1;
    margin-bottom: 20rpx;
    width: 100%;
}
.main-inner .lebel-list .a {
    margin-bottom: 20rpx;
    margin-right: 40rpx;
    min-width: 80rpx;
    text-align: center;
    color: #ababab;
    font-size: 24rpx;
    background: #f0f0f0;
    padding: 10rpx 20rpx;
    border-radius: 50rpx;
    cursor: pointer;
    font-size: 24rpx;
    margin-right: 10rpx;
}
</style>
