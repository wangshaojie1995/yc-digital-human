<template>
	<view>
		<u-popup ref="popup" mode='center' borderRadius='20' :maskCloseAble="false">
			<view class='vw-80 overflow-auto text-center round-10 text-black p-20 position-relative '>
				<text class="iconfont icon-guanbi position-absolute right-10 top-10 text-666" @click="close"></text>
				<text class='fw-bold fs-18'>使用协议</text>
				<view class='my-15'>
					<scroll-view scroll-y="true" style="height: 50vh;">
						<u-parse :html="agreementContent"></u-parse>
					</scroll-view>
				</view>
				<view>
					<view class="mx-15 round-30 bg-purple text-center text-white py-12" @click='agree'>我已阅读并同意</view>
				</view>
			</view>
		</u-popup>
	</view>
</template>

<script setup lang='ts'>
	import { ref, onMounted } from 'vue';
	import { getContent } from '@/digitalhuman/api/index'
	const emit = defineEmits(['close', 'confirm']);
	const agreementContent = ref('')
	const popup = ref()
	const props = withDefaults(
		defineProps < {
			type: string
		} > (), {
			type: 'voice',
		}
	);
	onMounted(() => {
		getData(props.type)
	})

	const agree = () => {
		popup.value.close()
	}

	const getData = async (type: any) => {
		const res = await getContent({ type })
		agreementContent.value = res.content
		popup.value.open()
	}

	const close = () => {
		const pages = getCurrentPages();
		const currentPage = pages[pages.length - 1];
		const pagePath = currentPage.route;
		if (pages.length == 1) {
			uni.switchTab({
				url: "/pages/index/index",
				fail(err) {
					console.log(err)
				}
			})
		} else {
			uni.navigateBack()
		}
	}
</script>

<style lang="scss">
	@import '@/digitalhuman/static/yy.scss';
</style>