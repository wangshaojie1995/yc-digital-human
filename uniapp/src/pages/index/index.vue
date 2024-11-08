<template>
	<view>
		<view class='pt-[30rpx] px-[20rpx]'>
			<template v-for="(item, index) in state.pages" :key="index">
				<template v-if="item.name == 'banner'">
					<w-banner :content="item.content" :styles="item.styles" :isLargeScreen="isLargeScreen"
						@change="handleBanner" />
				</template>
			</template>
		</view>

		<view class='p-[40rpx]  flex gap-x-5 text-xl text-white ls-2'>
			<view class='bg-[#1a1a1a] flex-1 flex flex-col gap-y-2 py-[30rpx] text-center rounded-[10rpx] '
				@click='to(1)'>
				<text class='iconfont icon-xiaofeifenshenguanli' style="font-size: 35px;color:#a853fd;"></text>
				<text>形象克隆</text>
			</view>
			<view class='bg-[#1a1a1a] flex-1 flex flex-col gap-y-2 py-[30rpx] text-center rounded-[10rpx] '
				@click='to(2)'>
				<text class='iconfont icon-shengwen' style="font-size: 35px;color:#a853fd;"></text>
				<text>声音克隆</text>
			</view>
		</view>


		<view class="px-[40rpx]  text-[#e5e5e5] article  pb-[140rpx]" v-if="state.article.length">
			<view class="flex  article-title mx-[20rpx] my-[30rpx] text-xl font-bold">
				使用教程
			</view>
			<view class='gap-y-6 flex flex-col'>
				<news-card v-for="item in state.article" :key="item.id" :news-id="item.id" :item="item" />
			</view>
		</view>

		<!--  #ifdef MP  -->
		<!--  微信小程序隐私弹窗  -->
		<MpPrivacyPopup></MpPrivacyPopup>
		<!--  #endif  -->
		<tabbar />
	</view>
</template>

<script setup lang="ts">
	import { getIndex } from '@/api/shop'
	import { onLoad, onPageScroll } from "@dcloudio/uni-app";
	import { computed, reactive, ref } from 'vue'
	import { useAppStore } from '@/stores/app'

	// #ifdef MP
	import MpPrivacyPopup from './component/mp-privacy-popup.vue'
	// #endif

	const state = reactive<{
		pages : any[]
		meta : any[]
		article : any[]
		bannerImage : string
	}>({
		pages: [],
		meta: [],
		article: [],
		bannerImage: ''
	})
	const scrollTop = ref<number>(0)
	const percent = ref<number>(0)

	// 是否联动背景图
	const isLinkage = computed(() => {
		return state.pages.find((item : any) => item.name === 'banner')?.content.bg_style === 1
	})
	// 是否大屏banner
	const isLargeScreen = computed(() => {
		return state.pages.find((item : any) => item.name === 'banner')?.content.style === 2
	})


	const getData = async () => {
		const data = await getIndex()
		state.pages = JSON.parse(data?.page?.data)
		state.meta = JSON.parse(data?.page?.meta)
		state.article = data.article
		uni.setNavigationBarTitle({
			title: state.meta[0].content.title
		})
	}

	onPageScroll((event : any) => {
		scrollTop.value = event.scrollTop
		const top = uni.upx2px(100)
		percent.value = event.scrollTop / top > 1 ? 1 : event.scrollTop / top
	})

	const to = (e : number) => {
		if (e == 1) {
			uni.navigateTo({
				url: '/digitalhuman/scene/add'
			})
		}

		if (e == 2) {
			uni.navigateTo({
				url: '/digitalhuman/voice/add'
			})
		}
	}
	onLoad(() => { getData() })
</script>

<style lang="scss">
	@import '@/static/iconfont.css';

	page {
		background-color: #000;
	}

	.ls-2 {
		letter-spacing: 4rpx;
	}
</style>