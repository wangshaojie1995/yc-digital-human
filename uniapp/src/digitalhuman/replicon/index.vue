<template>
	<view class="y-page">
		<view class="mb-tab text-white">
			<view class="overflow-hidden  pt-4 px-8 ">
				<view class="flex overflow-x-scroll w-p-100 flex-x-space-around" style="scrollbar-height: none;">
					<view v-for="(item,index) in tabsList" :key='index'>
						<view class="px-12 p-8" :class="type==item.type?'line fw-bold' : ''" @click="changeTabs(item)">
							<text class="fs-20  text-nowrap">{{item.name}}</text>
						</view>
					</view>
				</view>
			</view>
			<view class="flex flex-x-space-between flex-y-center p-20">
				<text>我的{{type==1?'形象':'声音'}}</text>
				<view class="block px-12 py-4 fs-13 bg-purple round-30 " @click="toAdd">新建</view>
			</view>

			<z-paging ref='paging' v-model='list' @query='getList' use-page-scroll>
				<view class='p-20 flex flex-column grid-gap-10' v-if='type==2'>
					<viwe v-for="(item,index) in list" :key='index' class="bg-grey-3 flex  flex-y-center p-15 round-8 ">
						<view class="flex flex-y-center grid-gap-14 flex-1">
							<yPlay width='40' fontSize='18' :src='item.local_voice_url' @togglePlay='togglePlay'>
							</yPlay>
							<view class="flex flex-column grid-gap-8">
								<text class='text-white fs-16 fw-bold'>{{item.name}}</text>
							</view>
						</view>
						<text class='iconfont icon-_gengduo fs-20' style="color:var(--purple)"
							@click="more(item)"></text>
					</viwe>
				</view>
				<view class="grid-columns-3  mt-15 grid-gap-20 px-12" v-if='type==1'>
					<view
						class="round-10 position-relative flex flex-center grid-gap-8 h-180 w-110 over-hidden border-grey-3 box-sizing"
						v-for="(item,index) in list" :key='index'>
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

						<!-- <view class="position-absolute bottom--1 right--1 left--1   text-center font-bold py-2"
							:class='item.status=="2"?"bg-b":"bg-w"'>
							{{item.name}}
						</view> -->
						<!-- <view @click.stop="more(item)" v-if='item.status!="1"'
							class="position-absolute top--1 right--1  text-center py-1  px-6  fs-14 bg-purple round-bottom-left-10 round-top-right-10">
							更多</view> -->
							
							<view v-if='item.status!="1"'
								class="position-absolute bottom--1 right--1 left--1 fs-12  py-6 flex flex-x-space-between px-12" :class='item.status=="2"?"bg-b":"bg-w"'>
								<text>{{item.name}}</text>
								<text class="iconfont icon-_gengduo text-white fs-13 ml-2" style="transform: rotate(90deg);"
									@click.stop="more(item)"></text>
							</view>
					</view>

				</view>
			</z-paging>
		</view>
		<tabbar />
		<u-popup ref='popup' borderRadius='20' bgColor="#fff" mode='bottom'>
			<view class='p-20 text-black text-center fs-15 round-top-10'>
				<view class="bg-grey-2 round-30 py-15" @click="rename">重命名</view>
				<view class="bg-grey-2 round-30 py-15 mt-15" @click="del">删除</view>
			</view>
		</u-popup>
	</view>
</template>

<script lang="ts" setup>
	import yPlay from '@/digitalhuman/components/y-play/y-play'
	import { reactive, ref } from 'vue';
	import { getVoiceList, renameVoice, delVoice } from '@/digitalhuman/api/voice'
	import { getSceneList, renameScene, delScene } from '@/digitalhuman/api/scene'
	import { onLoad, onUnload } from '@dcloudio/uni-app'
	const type = ref(1)
	const list = ref([])
	const id = ref(0)
	const paging = ref()
	const tabsList = reactive([
		{ name: '形象', type: 1 },
		{ name: '声音', type: 2 },
	])
	const popup = ref()

	let innerAudioContext = uni.createInnerAudioContext();

	onLoad(() => {
		getList(1, 10)
	})

	const togglePlay = (e : any) => {
		if (innerAudioContext.src != e.src) {
			innerAudioContext.src = e.src
		}
		if (e.status) {
			innerAudioContext.play()
		} else {
			innerAudioContext.pause()
		}
	}

	const getList = (page : number, limit : number) => {
		if (type.value == 2) {
			getVoiceList({ page: page, limit: limit }).then((res : any) => {
				paging.value.complete(res.lists)
			})
		}
		if (type.value == 1) {
			getSceneList({ page: page, limit: limit }).then((res : any) => {
				paging.value.complete(res.lists)
			})
		}
	}

	const toAdd = () => {
		if (type.value == 1) {
			uni.navigateTo({
				url: '/digitalhuman/scene/add'
			})
		}
		if (type.value == 2) {
			uni.navigateTo({
				url: '/digitalhuman/voice/add'
			})
		}
	}

	const more = (e : any) => {
		id.value = e.id
		popup.value.open()
	}


	const changeTabs = (e : any) => {
		type.value = e.type
		paging.value.reload()
		innerAudioContext.pause()
	}


	const rename = () => {
		uni.showModal({
			title: '修改名称',
			editable: true,
			placeholderText: '输入新的名称',
			success(res) {
				if (res.confirm && res.content) {
					handleRenameAction(type.value, res.content);
				}
			}
		});
	};

	const del = () => {
		uni.showModal({
			title: '确认删除?',
			content: '确认删除该视频?',
			success(res) {
				if (res.confirm) {
					handleDeleteAction(type.value);
				}
			}
		});
	};

	const handleRenameAction = (type : number, name : string) => {
		const actionMap : Record<number, Function> = {
			1: renameScene,
			2: renameVoice,
		};

		actionMap[type]?.({ id: id.value, name }).then(() => {
			closePopupWithMessage('修改成功');
			paging.value.reload();
		});
	};

	const handleDeleteAction = (type : number) => {
		const actionMap : Record<number, Function> = {
			1: delVoice,
			2: delScene,
		};

		actionMap[type]?.({ id: id.value }).then(() => {
			closePopupWithMessage('删除成功');
		});
	};

	const closePopupWithMessage = (message : string) => {
		popup.value.close();
		uni.showToast({
			title: message
		});
	}


	const retry = (id : number) => {

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

	.bg-w {
		background-color: rgba(255, 255, 255, 0.1);
	}

	.bg-b {
		background-color: rgba(0, 0, 0, 0.7);
	}

	.line {
		background: linear-gradient(90deg, var(--purple) 100%, var(--purple) 100%);
		background-size: 40% 6rpx;
		background-repeat: no-repeat;
		background-position: bottom;
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