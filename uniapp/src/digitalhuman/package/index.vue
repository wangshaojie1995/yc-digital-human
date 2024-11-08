<template>
	<view>
		<view class=" bg-blue py-30 px-20 flex flex-y-center flex-x-space-between">
			<view class="flex flex-column grid-gap-10 text-white">
				<text class='fs-15'>我的算力</text>
				<text class="fw-bold fs-25">{{wallet.points}}</text>
			</view>
			<view class='bg-white round-30 text-center py-4 px-12 text-blue' @click="toAccount">明细</view>
		</view>
		<view class="p-20">
			<view class="p-6 round-2">
				<view class="grid-columns-3 grid-gap-12 text-center">
					<view class=" rounded-3  flex flex-column py-15 round-8 grid-gap-10  box-shadow "  v-for="(item,index) in list"
						:key='index' @click="id=item.id"  :class='id==item.id?"border-blue mask":"border-grey-2"'>
						<text class='fs-14' :class='id==item.id?"text-blue":"text-333"'>{{item.name}}</text>
						<text class="fs-16 fw-bold">{{item.points}}</text>
						<text class=" fw-bold fs-14 text-blue" :class='id==item.id?"text-blue":"text-333"'>￥{{item.price}}</text>
					</view>
				</view>
			</view>
		</view>


		<view class="p-20 position-fixed bottom-0 box-sizing w-p-100">
			<view class="bg-blue round-30 py-10 text-center text-white" @click="submit">立即充值</view>
			<view class="fs-13  flex flex-x-center mt-10 flex-y-center">
				<checkbox-group @change="onChange" activeBorderColor='#a853fd' iconColor='#a853fd'>
					<checkbox value='1' :checked="status" style="transform:scale(0.7)" />
				</checkbox-group>
				已阅读<text class='text-blue' @click='toAgreement'>《充值协议》</text>
			</view>
		</view>
	</view>
</template>

<script setup lang="ts">
	import { onLoad } from '@dcloudio/uni-app'
	import { getPackageList, createOrder } from '@/digitalhuman/api/package'
	import { rechargeConfig } from '@/api/recharge'
	import { pay } from '@/digitalhuman/utils/pay'
	import { ref } from 'vue'
	const id = ref(0)
	const status = ref(false)
	const list = ref()

	onLoad(() => {
		getPackage()
		getWallet()
	})
	const submit = () => {
		if (status.value == false) {
			uni.showToast({
				title: '请先阅读充值协议',
				icon: 'none'
			})
			return;
		}
		if (!id.value) {
			uni.showToast({
				title: '请选择套餐',
				icon: 'none'
			})
			return;
		}
		uni.showLoading({
			title: '加载中...',
			mask: true
		})
		createOrder({ id: id.value }).then((res : any) => {
			pay(res).then((result : any) => {
				uni.hideLoading()
				uni.showToast({
					title: '支付成功'
				})
				setTimeout(() => {
					uni.navigateBack
				}, 500)
			}).catch((err : any) => {
				uni.hideLoading()
				uni.showToast({
					title: '支付失败',
					icon: 'none'
				})
			})
		})
	}


	const getPackage = () => {
		getPackageList({}).then((res : any) => {
			list.value = res.lists
		})
	}

	const onChange = (e : any) => {
		if (e.detail.value.length == 1) {
			status.value = true
		} else {
			status.value = false
		}
	}

	const toAccount = () => {
		uni.reLaunch({
			url: '/packages/pages/user_wallet/user_wallet'
		})
	}

	const wallet = ref<any>({})
	const getWallet = async () => {
		wallet.value = await rechargeConfig()
	}
	
	const toAgreement=()=>{
		uni.navigateTo({
			url:"/pages/agreement/agreement?type=recharge"
		})
	}
</script>

<style lang='scss'>
	@import '@/digitalhuman/static/iconfont.css';
	@import '@/digitalhuman/static/yy.scss';

	.box-shadow {
		box-shadow: 0rpx 8rpx 12rpx 0rpx rgba(8, 75, 123, 0.05);
	}

	page {
		background-color: #fff;
	}

	.uni-checkbox-input {
		border-radius: 50% !important;
	}
	
	.mask{
		background-color:rgba(32, 128, 246, 0.05);
	}
</style>