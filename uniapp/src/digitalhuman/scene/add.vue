<template>
	<view class='p-20 text-white'>
		<view class="bg-grey p-15 round-8">
			<text class="fs-17 fw-600">名字</text>
			<input placeholder="请输入声音名称" placeholder-class="fs-12" v-model="form.name" class='fs-12 mt-8' />
		</view>

		<view class="bg-grey mt-7 p-15 round-8">
			<text class="fs-17 fw-600">上传本地视频</text>
			<view class="flex flex-center py-15">
				<view class="w-150 h-150 round-8 border-purple bg-grey-3 flex flex-column flex-center grid-gap-6"
					style="border-style: dashed;" @click="upload" v-if='tempUrl==""'>
					<text class='iconfont icon-shangchuanshipin fs-30'></text>
					<text class='fs-14'>上传视频</text>
				</view>
				<video :src="tempUrl" v-else></video>
			</view>

			<view class="w-p-100 p-15 border-grey-3 text-grey-4  round-8">
				<text class="fs-14  fw-900">视频要求</text>
				<view class="flex flex-column grid-gap-10 mt-10 fs-11 ls-1">
					<text>
						1.视频格式要求为MP4/MOV;
					</text>
					<text>
						2.视频大小低于100M;
					</text>
					<text>
						3.不要使用有多人的视频;
					</text>
					<text>
						4.不要遍挡面部，确保人脸不出屏幕，并使面部究度占整体画面宽度的1/4以上;</text>
					<text>
						5.分辨率不低于360p，且不高于4K。视频长度不少于5秒且不超过30分钟
					</text>
				</view>
			</view>
		</view>

		<view class="p-20 text-white text-center fw-600 ls-2">
			<view class='bg-purple-1 round-30 py-15' v-if='form.name==""||form.local_video_url==""'>提交</view>
			<view class='bg-purple round-30 py-15' v-else @click='submit'>提交</view>
		</view>
		<yPopup type='scene'></yPopup>
	</view>
</template>

<script setup lang='ts'>
	import yPopup from '@/digitalhuman/components/y-popup/y-popup'
	import { uploadVideo, createScene } from '@/digitalhuman/api/scene'
	import { ref } from 'vue'
	const tempUrl = ref('')
	const form = ref({
		name: '',
		local_video_url: '',
	})
	const submit = () => {
		uni.showLoading({
			title: "提交中..."
		})
		createScene(form.value).then((res: any) => {
			uni.hideLoading()
			uni.showToast({
				title: '添加成功',
				icon: 'none'
			})
			setTimeout(() => {
				uni.navigateBack()
			}, 500)
		}).catch((err: any) => {
			uni.hideLoading()
			uni.$u.toast(err);
		})

	}

	const upload = () => {
		uni.chooseVideo({
			sourceType: ['album'],
			compressed:false,
			success(res) {
				uni.showLoading({
					title: '视频上传中...'
				})
				uploadVideo(res.tempFilePath).then((res: any) => {
					uni.hideLoading()
					form.value.local_video_url = res.url
					tempUrl.value = res.uri
					uni.showToast({
						title: '视频上传成功'
					})
				}).catch((err: any) => {
					uni.hideLoading()
				})
			}
		})
	}
</script>

<style lang="scss">
	@import '@/digitalhuman/static/iconfont.css';
	@import '@/digitalhuman/static/yy.scss';

	page {
		background-color: #000;
	}

	.ls-1 {
		letter-spacing: 2rpx;
	}
</style>