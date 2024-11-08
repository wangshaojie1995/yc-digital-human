<template>
	<view class='vw-100 vh-100 flex flex-center flex-column grid-gap-20'>
		<text class="fs-25  fw-bold text-white ls-2">卡密兑换</text>
		<view class="bg-grey round-8 px-20 py-15 w-p-80">
			<input placeholder="请输入卡密" class='text-white fs-19' v-model="key" />
		</view>
		<view class="p-20 text-white text-center fw-600 ls-2 w-p-70">
			<view class='bg-purple-1 round-30 py-14' v-if='key==""'>提交</view>
			<view class='bg-purple round-30 py-15' v-else @click='submit'>提交</view>
		</view>
	</view>
</template>

<script lang='ts' setup>
	import { ref } from 'vue';
	import { exchange } from '@/digitalhuman/api/index'
	const key = ref<any>("")
	const submit = () => {
		exchange({ key: key.value }).then((res: any) => {
			uni.showToast({
				title: '兑换成功'
			})
			key.value = ''
		})
	}
</script>

<style lang='scss'>
	@import '@/digitalhuman/static/yy.scss';

	page {
		background-color: #000;
	}
</style>