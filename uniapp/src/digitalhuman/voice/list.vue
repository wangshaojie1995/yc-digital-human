<template>
	<view class='y-page'>
		<view class='p-20'>
			<view class='bg-grey round-10 p-15 flex flex-y-center grid-gap-10' @click='toVioce'>
				<text class='iconfont icon-jingminglaba fs-25' style="color:var(--purple);"></text>
				<view class='flex flex-column grid-gap-6 flex-1'>
					<text class='text-white fs-18 fw-600'>一比一复制你的声音</text>
					<text class='fs-12 text-grey-1'>高度还原你的声音，说话风格，口音等</text>
				</view>
				<view class='w-20 h-20 flex flex-center round-circle bg-purple'>
					<text class='iconfont icon-youjiantou fs-10' style="color:var(--white);"></text>
				</view>
			</view>


			<view class="grid-gap-10 flex flex-column mt-10">
				<viwe v-for="(item,index) in voiceList" :key='index'
					class="bg-grey-3 flex flex-x-space-between p-15 round-8 flex-y-center" @tap='back(item)'>
					<text class='text-white fs-17 fw-600'>{{item.name}}</text>
					<view class="w-30 h-30 round-circle bg-white flex flex-center"
						@click.stop='play(item.voice_id,item.local_voice_url)'>
						<text class="iconfont  icon-zanting1 fs-13" style="color:var(--purple);"
							v-if='playId==item.voice_id'></text>
						<text class="iconfont icon-bofang fs-13" style="color:var(--purple);" v-else></text>
					</view>
				</viwe>
			</view>
		</view>
		<view class="bg-grey round-top-10 p-15">
			<text class="fs-17 fw-bold text-white">公共声音</text>
			<view class="grid-gap-10 flex flex-column mt-10">
				<viwe v-for="(item,index) in commonList" :key='index'
					class="bg-grey-3 flex flex-x-space-between p-15 round-8" @tap='back(item)'>
					<text class='text-white'>{{item.name}}</text>
					<view class="w-30 h-30 round-circle bg-white flex flex-center"
						@click.stop='play(item.voice_id,item.local_vioce_url)'>
						<text class="iconfont  icon-zanting1 fs-13" style="color:var(--purple);"
							v-if='playId==item.voice_id'></text>
						<text class="iconfont icon-bofang fs-13" style="color:var(--purple);" v-else></text>
					</view>
				</viwe>
			</view>
		</view>
	</view>
</template>

<script setup lang="ts">
	import { getCommonVoiceList, getVoiceList } from '@/digitalhuman/api/voice'
	import { onLoad,onUnload } from '@dcloudio/uni-app'
	import { ref } from 'vue'
	const commonList = ref()
	const status = ref(false)
	const playId = ref()
	const backStatus = ref(false)
	const voiceList = ref([])
	let innerAudioContext = uni.createInnerAudioContext();
	onLoad((e : any) => {
		getCommonVoice()
		getVoice()
		innerAudioContext.onStop(() => {
			console.log('onStop')
			playId.value = ''
			status.value = false
		})

		innerAudioContext.onPlay(() => {
			status.value = true
		})
		innerAudioContext.onPause(() => {
			console.log('onPause')
			playId.value = ''
			status.value = false
		})
		innerAudioContext.onCanplay((res : any) => {
			console.log('res', res)
		})

		innerAudioContext.onError((err : any) => {
			console.log('err', err)
			status.value = false
		})
		if (e.backStatus) {
			backStatus.value = true
		}
	})

	const getCommonVoice = () => {
		getCommonVoiceList().then((res : any) => {
			commonList.value = res.data
		})
	}
	const getVoice = () => {
		getVoiceList({}).then((res : any) => {
			voiceList.value = res.lists
		})
	}

	const play = (id : string, src : string) => {
		if (!src) {
			uni.showToast({ title: '暂无播放地址', icon: 'none' })
			return;
		}
		playId.value = id
		if (status.value) {
			innerAudioContext.pause()
		} else {
			if (innerAudioContext.src != src) {
				innerAudioContext.src = src
			}
			innerAudioContext.play()
		}

	}

	const toVioce = () => {
		uni.navigateTo({
			url: '/digitalhuman/voice/add'
		})
	}

	const back = (e : any) => {
		console.log(e)
		console.log(backStatus.value)
		if (backStatus.value) {
			let pages = getCurrentPages();
			let prevPage = pages[pages.length - 2];
			prevPage.$vm.voice_id = e.voice_id
			prevPage.$vm.name = e.name
			uni.navigateBack()
			return true;
		}
	}
	
	onUnload(() => {
		if (innerAudioContext) {
			try {
				innerAudioContext.pause();
				innerAudioContext.destroy()
			} catch (e) {
				//TODO handle the exception
			}
		}
	})
</script>

<style lang='scss'>
	@import '@/digitalhuman/static/iconfont.css';


	page {
		background-color: #000;
	}
</style>