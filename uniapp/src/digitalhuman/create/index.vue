<template>

	<view class='y-page'>
		<view class="p-20">
			<view class='mb-tab'>
				<view class='p-15 bg-grey round-8'>
					<text class="fs-17 fw-600 text-white">名字</text>
					<input placeholder="请输入视频名称" placeholder-class="fs-12" v-model="form.name"
						class='fs-12 mt-8 text-white' />
				</view>
				<view class='bg-grey p-10 round-8 mt-10'>
					<video :src="detail?.local_video_url" class='w-p-100' v-if='detail'></video>
					<view class='p-20'>
						<view class='bg-purple round-30 py-10 text-center text-white' object-fit='cover'
							@click='toScene'>
							选择分身
						</view>
					</view>
				</view>

				<view class='mt-8 '>
					<view class='bg-grey p-10 round-8'>
						<view class="p-30 flex flex-x-space-between fs-19 fw-600 text-grey-1">
							<text :class='form.voice_type==1?"text-white":""' @click='form.voice_type=1'>语音驱动</text>
							<text :class='form.voice_type==2?"text-white":""' @click='form.voice_type=2'>文本驱动</text>
						</view>
						<view v-if='form.voice_type==1' class='p-15'>
							<yRecorder @success="recorderSuccess"></yRecorder>

						</view>
						<view class='mt-10' v-if='form.voice_type==2'>
							<view class='bg-black p-10 round-8'>
								<textarea placeholder="请输入文本" class="fs-13 text-white" placeholder-class="text-grey-1"
									v-model='form.text'></textarea>
							</view>
							<view class='p-10 round-8 border-grey-3 flex flex-y-center flex-x-space-between mt-10'>
								<view class='text-white'>
									<text class='iconfont icon-laba fs-17'></text>
									<text class="fs-15 ml-4">{{voice.name}}</text>
								</view>
								<view class='text-grey-4'>
									<text class='iconfont icon-qiehuan'></text>
									<text class='ml-4' @click='toVoiceList'>切换</text>
								</view>
							</view>
						</view>
					</view>
				</view>
				<view class="p-20 text-white text-center fw-600 ls-2">
					<view class='bg-purple-1 round-30 py-15' v-if='form.name==""||form.scene_id==0'>
						提交</view>
					<view class='bg-purple round-30 py-15' v-else @click='submit'>提交</view>
				</view>
			</view>
			<yPopup type='video'></yPopup>
			<tabbar />
		</view>
	</view>
</template>

<script setup lang="ts">
	import yPopup from '@/digitalhuman/components/y-popup/y-popup'
	import { onLoad, onShow } from '@dcloudio/uni-app'
	import { ref } from 'vue'
	import { detailScene } from '@/digitalhuman/api/scene'
	import { uploadVoice } from '@/digitalhuman/api/voice'
	import { createVideo } from '@/digitalhuman/api/video'
	import yRecorder from '@/digitalhuman/components/recorder/recorder'
	const detail = ref()
	const voice = ref({
		name: '请选择',
		voice_id: ''
	})
	const form = ref({
		name: '',
		scene_id: 0,
		voice_type: 1,
		local_voice_url: '',
		text: ''
	})
	const recorder = ref({
		file: '',
		duration: 0,
		currentTime: 0,
		url: '',
		text: '',
		voice_id: ''
	});
	onLoad((e : any) => {
		if (e.id) {
			getDetail(e.id)
		}
	})
	onShow((e : any) => {
		let pages = getCurrentPages();
		let currentPage = pages[pages.length - 1];
		if (currentPage.$vm.scene_id) {
			getDetail(currentPage.$vm.scene_id)
		}
		if (currentPage.$vm.voice_id) {
			voice.value.voice_id = currentPage.$vm.voice_id
			voice.value.name = currentPage.$vm.name
		}
	})
	const getDetail = (id : number) => {
		detailScene({ id: id }).then((res : any) => {
			detail.value = res
			form.value.scene_id = id
		})
	}

	const toScene = () => {
		uni.navigateTo({
			url: '/digitalhuman/scene/index?backStatus=true'
		})
	}
	const toVoiceList = () => {
		uni.navigateTo({
			url: '/digitalhuman/voice/list?backStatus=true'
		})
	}

	const recorderSuccess = (res : any) => {
		// #ifdef H5
		recorder.value.file = res.file;
		// #endif
		recorder.value.duration = res.duration;
		recorder.value.url = res.url;
	}


	const submit = () => {
		if (form.value.voice_type == 1 && form.value.local_voice_url == '') {
			if (recorder.value.url == '') {
				uni.showToast({
					title: '请上传音频文件',
					icon: 'none'
				})
				return;
			}
			let data = {}
			// #ifdef H5
			data = { file: recorder.value.file }
			// #endif
			// #ifndef H5
			data = { filePath: recorder.value.url }
			// #endif
			uploadVoice(data).then((res : any) => {
				form.value.local_voice_url = res.url
				create()
			})
			return;
		}
		if (form.value.voice_type == 2 && form.value.text == '' || voice.value.voice_id == '') {
			if (recorder.value.url == '') {
				uni.showToast({
					title: '请完善数据',
					icon: 'none'
				})
				return;
			}
		}
		form.value.voice_id = voice.value.voice_id
		create()
	}

	const create = () => {
		uni.showLoading({
			title: '提交创作中...',
			mask: false
		})
		createVideo(form.value).then((res : any) => {
			uni.hideLoading()
			uni.showToast({
				title: '已提交创作',
				icon: 'none'
			})
		}).catch((err : any) => {
			uni.hideLoading()
		})
	}
</script>

<style lang="scss">
	@import '@/digitalhuman/static/iconfont.css';

	page {
		background-color: #000;
	}
</style>