<template>
	<view class=" y-page ">
		<view class="mb-tab text-white">
			<view class="flex flex-x-space-between flex-y-center p-20">
				<text>我的作品</text>
				<view class="block px-12 py-4 fs-13 bg-purple round-30 " @click="toAdd">去创作</view>
			</view>

			<z-paging ref='paging' v-model='list' @query='getList' use-page-scroll>
				<view class="grid-columns-3   grid-gap-20 px-15">
					<view class="round-10 position-relative  h-180 w-110 flex flex-center border-grey-2 over-hidden"
						v-for="(item,index) in list" :key='index'>

						<view v-if='item.status=="1"' class="text-center">
							<view class="spinner mb-10">
								<view class='spinner1'></view>
							</view>
							<text class='fs-10'>生成中...</text>
						</view>

						<image class="w-110 round-10 h-180" mode="aspectFill" :src="item.cover_image"
							v-if='item.status=="2"' @click="openVideo(item.api_video_url)">
						</image>

						<view class='flex flex-column grid-gap-10 text-center' v-if="item.status=='3'"
							@click.stop="retry">
							<text class="iconfont icon-zhongshi text-purple fs-20"></text>
							<text class="fs-10">克隆失败,点击重试</text>
						</view>

						<view v-if='item.status!="1"'
							class="position-absolute bottom--1 right--1 left--1 fs-12  py-6 flex flex-x-space-between px-12"
							:class='item.status=="2"?"bg-b":"bg-w"'>
							<text class="text-ellipsis-1">{{item.name}}</text>
							<text class="iconfont icon-_gengduo text-white fs-13 ml-2" style="transform: rotate(90deg);"
								@click.stop="more(item)"></text>
						</view>
					</view>
				</view>
			</z-paging>
		</view>
		<u-popup ref='popup' borderRadius='20' bgColor="#fff" mode='bottom'>
			<view class='p-20 text-black text-center fs-15 round-top-10'>
				<view class="bg-grey-2 round-30 py-15" @click="rename">重命名</view>
				<view class="bg-grey-2 round-30 py-15 mt-15" @click="del">删除</view>
			</view>
		</u-popup>

		<u-popup ref='videoPopup' mode='bottom' borderRadius='20'>
			<view class="pb-safe-area px-20">
				<view class='py-20'>
					<video :src='videoSrc' class='w-p-100 vh-50'></video>
				</view>
				<view class='bg-purple round-30 text-center text-white py-15 mb-10' @click='dowmloadVideo'>下载到本地</view>
			</view>
		</u-popup>
		<tabbar />
	</view>
</template>

<script lang="ts" setup>
	import { getVideoList, delVideo, renameVideo, retryVideo } from '@/digitalhuman/api/video'
	import { ref } from 'vue';
	const list = ref([])
	const paging = ref()
	const popup = ref()
	const selectItem = ref()
	const videoPopup = ref()
	const videoSrc = ref('')
	const getList = (page : number, limit : number) => {
		getVideoList({ pageNo: page, pageSize: limit }).then((res : any) => {
			paging.value.complete(res.lists)
		})
	}


	const toAdd = () => {
		uni.navigateTo({
			url: '/digitalhuman/works/create'
		})
	}


	const rename = () => {
		uni.showModal({
			title: '修改名称',
			editable: true,
			placeholderText: '输入新的名称',
			success(res : any) {
				if (res.confirm && res.content) {
					renameVideo({ name: res.content, id: selectItem.value.id }).then((res1 : any) => {
						popup.value.close()
						uni.showToast({
							title: '修改成功'
						})
						paging.value.reload()
					})
				}
			}
		});
	};

	const del = () => {
		uni.showModal({
			title: '确认删除?',
			content: '确认删除该视频?',
			success(res : any) {
				if (res.confirm) {

					delVideo({ id: selectItem.value.value }).then((res1 : any) => {
						popup.value.close()
						uni.showToast({
							title: '删除成功'
						})
						paging.value.reload()
					})
				}
			}
		});
	};



	const retry = (id : number) => {
		uni.showModal({
			title: '温馨提示',
			content: "确认重试？",
			success(e : any) {
				if (e.confirm) {
					uni.showLoading({ title: "提交中..." })
					retryVideo({ id: id }).then((res : any) => {
						uni.hideLoading
						uni.showToast({
							title: '提交成功'
						})
					})
				}
			}
		})
	}


	const openVideo = (e : string) => {
		videoSrc.value = e
		videoPopup.value.open()
	}

	const more = (e : any) => {
		selectItem.value = e
		popup.value.open()
	}


	const generateRandomString = (length : any) => {
		const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		let result = '';
		const charactersLength = characters.length;

		for (let i = 0; i < length; i++) {
			result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}

		return result;
	}




	const dowmloadVideo = () => {

		uni.showLoading({
			title: '下载中...'
		})
		// #ifdef H5
		let ua = window.navigator.userAgent.toLowerCase();
		console.log(ua.match(/MicroMessenger/i))
		if (ua.match(/MicroMessenger/i) === "micromessenger") {
			uni.setClipboardData({
				data: videoSrc.value,
				success(res) {
					uni.showModal({
						title: '复制成功',
						content: '链接已复制,请在外部浏览器打开下载'
					})
				}
			})
			return;
		}

		uni.downloadFile({
			url: videoSrc.value,
			success: (res) => {
				uni.hideLoading()
				let file_name = generateRandomString(20)
				let file_type = videoSrc.value.split('.').pop()
				var oA = document.createElement("a")
				oA.download = `${file_name}.${file_type}`
				oA.href = res.tempFilePath
				document.body.appendChild(oA)
				oA.click()
				oA.remove()
			}
		})

		// #endif



		// #ifdef MP-WEIXIN
		uni.downloadFile({
			url: videoSrc.value,
			success: (res) => {
				uni.hideLoading();
				uni.saveVideoToPhotosAlbum({
					filePath: res.tempFilePath,
					success: () => {
						uni.showToast({
							title: '保存成功',
							icon: 'success'
						})
					},
					fail: (err : any) => {
						console.log('err', err)
						uni.showToast({
							title: '保存失败',
							icon: 'none'
						})
					}
				})
			},
			fail: () => {
				uni.hideLoading();
				uni.showToast({
					title: '下载失败',
					icon: 'none'
				})
			},
		})
		// #endif
	}
</script>


<style lang='scss'>
	@import '@/digitalhuman/static/iconfont.css';


	page {
		background-color: #000;
	}

	.bg-o {
		background-color: rgba(0, 0, 0, 0.8);
	}

	.line {
		background: linear-gradient(90deg, var(--purple) 100%, var(--purple) 100%);
		background-size: 40% 6rpx;
		background-repeat: no-repeat;
		background-position: bottom;
	}

	.bg-w {
		background-color: rgba(255, 255, 255, 0.1);
	}

	.bg-b {
		background-color: rgba(0, 0, 0, 0.7);
	}

	.spinner {
		background-image: linear-gradient(rgb(186, 66, 255) 35%, rgb(0, 225, 255));
		width: 50px;
		height: 50px;
		text-align: center;
		animation: spinning82341 1.7s linear infinite;
		border-radius: 50px;
		filter: blur(1px);
		box-shadow: 0px -5px 20px 0px rgb(186, 66, 255), 0px 5px 20px 0px rgb(0, 225, 255);
	}

	.spinner1 {
		background-color: rgb(36, 36, 36);
		width: 50px;
		height: 50px;
		border-radius: 50px;
		filter: blur(10px);
	}

	@keyframes spinning82341 {
		to {
			transform: rotate(360deg);
		}
	}
</style>