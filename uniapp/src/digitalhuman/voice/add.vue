<template>
	<view class='y-page'>
		<view class='p-20 text-white'>
			<view class="bg-grey p-15 round-8">
				<text class="fs-17 fw-600">名字</text>
				<input placeholder="请输入声音名称" placeholder-class="fs-12" class='fs-12 mt-8' v-model='form.name' />
			</view>

			<view class="bg-grey mt-7 p-15 round-8">
				<text class="fs-17 fw-600">参考音频</text>
				<view class="round-8 border-purple p-15 mt-7">
					<view class="flex flex-x-space-between mb-6">
						<text class='fs-15 fw-600 '>朗读文本</text>
						<view class="bg-white fs-12 round-4 text-purple flex flex-y-center px-6 py-4" @click='open'>
							<text class='iconfont icon-qiehuan' style="color:var(--purple);"></text>
							切换文本
						</view>
					</view>
					<text class='fs-11 text-grey-4 ls-2'>
						{{selectItem?.content}}
					</text>
				</view>

				<view class='p-30'>
					<yRecorder @success="recorderSuccess"></yRecorder>
				</view>
			</view>
			<!-- <view class='bg-grey mt-7 p-10 round-8'>
				<view class="p-30 flex flex-x-space-between fs-19 fw-600 text-grey-1"
					v-if='config.voice_type=="yiding"'>
					<text :class='form.voice_type==1?"text-white":""' @click='form.voice_type=1'>普通声音</text>
					<text :class='form.voice_type==2?"text-white":""' @click='form.voice_type=2'>专业声音</text>
				</view>
				<view v-if='form.voice_type==2'>
					<view>
						<text>性别:</text>
						<view class="mt-10">
							<yRadio :list='sexList'></yRadio>
						</view>
					</view>
					<view class="mt-20">
						<text>年龄:</text>
						<view class="mt-10">
							<yRadio :list='ageGroupList'></yRadio>
						</view>
					</view>
				</view>
				<view class='p-30'>
					<yRecorder @success="recorderSuccess"></yRecorder>
				</view>
			</view> -->

			<view class="p-20 text-white text-center fw-600 ls-2">
				<view class='bg-purple-1 round-30 py-15   ' v-if='form.name==""||recorder.url==""'>提交</view>
				<view class='bg-purple round-30 py-15   ' v-else @click='submit'>提交</view>
			</view>

			<u-popup ref='popup' borderRadius='20' mode="bottom">
				<view class="p-20 text-black" style="max-height: 50vh;">
					<view class=' fw-600 text-center'>
						<text>选择朗读文本</text>
					</view>
					<view class='flex flex-column mt-7 grid-gap-6 overflow-y-scroll'>
						<view class="round-10 p-15 bg-grey-2 flex flex-column grid-gap-4"
							v-for="(item,index) in textList" :key='index' @click="select(item)"
							:class='selectItem.id==item.id?"border-purple":"border-grey-2"'>
							<text class="fw-600">{{item.name}}</text>
							<text class='ls-2 fs-12'>{{item.content}}</text>
						</view>
					</view>
				</view>
			</u-popup>
			<yPopup></yPopup>
		</view>
	</view>
</template>

<script setup lang="ts">
	import yRecorder from '@/digitalhuman/components/recorder/recorder'
	import yRadio from '@/digitalhuman/components/y-radio/y-radio'
	import yPopup from '@/digitalhuman/components/y-popup/y-popup'
	import { getVoiceTextList, createVoice, uploadVoice } from '@/digitalhuman/api/voice'
	import { getConfig } from '@/digitalhuman/api/index'
	import { onLoad } from '@dcloudio/uni-app'
	import { ref, reactive } from 'vue'
	import { useUserStore } from '@/stores/user'
	const textList = ref()
	const popup = ref()
	const selectItem = ref()

	const sexList = reactive([
		{ name: '男', id: 1 },
		{ name: '女', id: 2 }
	])
	const ageGroupList = reactive([
		{ name: '儿童', id: 1 },
		{ name: '青年', id: 2 },
		{ name: '中年', id: 3 },
		{ name: '中老年', id: 4 },
	])
	const recorder = ref({
		file: '',
		duration: 0,
		currentTime: 0,
		url: ''
	});
	const yidingVoice = ref({
		sex: 1,
		ageGroup: 1
	})
	const form = ref({
		name: '',
		local_voice_url: '',
		duration: 0,
		voice_type: 1
	})
	const userStore = useUserStore()
	const config = ref({
		voice_type: ''
	})
	onLoad(() => {
		getTextList()
		getConfigInfo()
	})

	const getConfigInfo = () => {
		getConfig().then((res : any) => {
			config.value = res
		})
	}

	const getTextList = () => {
		getVoiceTextList().then((res : any) => {
			textList.value = res.lists
			selectItem.value = textList.value[0]
		})
	}

	const open = () => {
		popup.value.open()
	}

	const select = (e : any) => {
		selectItem.value = e
		popup.value.close()
	}

	const recorderSuccess = (res : any) => {
		// #ifdef H5
		recorder.value.file = res.file;
		// #endif
		recorder.value.duration = res.duration;
		recorder.value.url = res.url;
	}

	const submit = () => {
		if (form.value.local_voice_url == '') {
			let data = {}
			// #ifdef H5
			data = { file: recorder.value.file }
			// #endif
			// #ifndef H5
			data = { filePath: recorder.value.url }
			// #endif
			uploadVoice(data, userStore.token).then((res : any) => {
				form.value.local_voice_url = res.url
				add()
			})
		} else {
			add()
		}
	}
	const add = () => {
		uni.showLoading({
			title: '创建中...'
		})
		createVoice(form.value).then((res : any) => {
			uni.showToast({
				title: '添加成功',
				icon: 'none'
			})
			uni.hideLoading()
			setTimeout(() => {
				uni.navigateBack()
			}, 500)
		})
	}
</script>

<style lang="scss">
	@import '@/digitalhuman/static/iconfont.css';

	page {
		background-color: #000;
	}
</style>