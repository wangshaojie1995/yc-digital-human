<template>
	<view class="text-white vh-100 box-sizing">
		<view class="pt-20 px-20">
			<text class='fs-17 font-bold'>我的分身</text>
		</view>
		<view class="mb-30 p-20">
			<view class="grid-columns-3  mt-15 grid-gap-20">
				<view class="round-10 position-relative h-180 w-110 over-hidden" v-for="(item,index) in userScene"
					:key='index' @click.stop="toCreate(item)">
					<view v-if='item.status=="1"' class="text-center">
						<view class="spinner mb-10">
							<view class='spinner1'></view>
						</view>
						<text class='fs-10'>生成中...</text>
					</view>
					<image class="w-110 round-10 h-180" mode="aspectFill" :src="item.cover_image"
						v-if='item.status=="2"'>
					</image>
					
					<view class='flex flex-column grid-gap-10 text-center' v-if="item.status=='3'"
						@click.stop="retry">
						<text class="iconfont icon-zhongshi text-purple fs-20"></text>
						<text class="fs-10">克隆失败,点击重试</text>
					</view>
					
						
						<view v-if='item.status!="1"'
							class="position-absolute bottom--1 right--1 left--1 fs-12  py-6 flex flex-x-space-between px-12" :class='item.status=="2"?"bg-b":"bg-w"'>
							<text>{{item.name}}</text>
							<text class="iconfont icon-_gengduo text-white fs-13 ml-2" style="transform: rotate(90deg);"
								@click.stop="more(item)"></text>
						</view>
				</view>

				<view class="  h-180 w-110  flex flex-center">
					<view class="w-90 text-center bg-purple round-30 py-12 fw-700" @click='toAdd'>新增</view>
				</view>
			</view>
		</view>
		<!-- <view class="bg-grey p-20  min-h-full  round-top-16">
			<text class='fs-17 font-bold'>公共分身</text>
			<view class="grid-columns-3  mt-15 grid-gap-20">
				<view class="round-10 position-relative h-180 over-hidden w-110" v-for="i in 10">
					<image class="w-110 round-10 h-180" mode="aspectFill"
						src="https://img0.baidu.com/it/u=2032395918,2258396154&fm=253&fmt=auto?w=500&h=500">
					</image>
					<view class="position-absolute bottom-0 w-full bg-o text-center font-bold py-2">发撒的</view>
				</view>
			</view>
		</view> -->

		<u-popup ref='popup' borderRadius='20' bgColor="#fff" mode='bottom'>
			<view class='p-20 text-black text-center fs-15 round-top-10'>
				<view class="bg-grey-2 round-30 py-15" @click="rename">重命名</view>
				<view class="bg-grey-2 round-30 py-15 mt-15" @click="del">删除</view>
			</view>
		</u-popup>
	</view>
</template>

<script setup lang='ts'>
	import { onLoad } from '@dcloudio/uni-app'
	import { ref } from 'vue'
	import { getSceneList, delScene, renameScene, retryScene } from '@/digitalhuman/api/scene'
	const id = ref(0)
	const userScene = ref()
	const popup = ref()
	const backStatus = ref(false)
	onLoad((e: any) => {
		if (e.backStatus) {
			backStatus.value = true
		}
		getScene()
	})

	const getScene = (type: Number = 1) => {
		getSceneList({ page_type: type ,status:'2'}).then(res => {
			userScene.value = res.lists
		})
	}

	const del = () => {
		uni.showModal({
			title: '确认删除?',
			content: '确认删除该视频?',
			success(res) {
				if (res.confirm) {
					delScene({ id: id.value }).then(res => {
						popup.value.close()
						uni.showToast({
							title: '删除成功'
						})
						getScene()
					})
				}
			}
		})
	}

	const more = (e: number) => {
		id.value = e
		popup.value.open()
	}

	const rename = () => {
		uni.showModal({
			title: '修改名称',
			editable: true,
			placeholderText: '输入新的名称',
			success(res) {
				if (res.confirm) {
					renameScene({ id: id.value, name: res.content }).then((res: any) => {
						popup.value.close()
						uni.showToast({
							title: '修改成功'
						})
						getScene()
					})
				}
			}
		})
	}
	const toCreate = (e: any) => {
		if (backStatus.value == true) {
			let pages = getCurrentPages();
			let prevPage = pages[pages.length - 2];
			prevPage.$vm.scene_id = e.id
			prevPage.$vm.name = e.name
			uni.navigateBack()
			return true;
		}
	}
	const toAdd = () => {
		uni.navigateTo({
			url: '/digitalhuman/scene/add'
		})
	}


	const retry = (id: number) => {
		uni.showModal({
			title: '温馨提示',
			content: "确认重试？",
			success(e: any) {
				if (e.confirm) {
					uni.showLoading({ title: "提交中..." })
					retryScene({ id: id }).then((res: any) => {
						uni.hideLoading
						uni.showToast({
							title: '提交成功'
						})
					})
				}
			}
		})
	}
</script>

<style lang='scss'>
	@import '@/digitalhuman/static/iconfont.css';

	@import '@/digitalhuman/static/yy.scss';

	page {
		background-color: #000;
	}

	.bg-w {
		background-color: rgba(255, 255, 255, 0.1);
	}
	
	.bg-b {
		background-color: rgba(0, 0, 0, 0.7);
	}
</style>