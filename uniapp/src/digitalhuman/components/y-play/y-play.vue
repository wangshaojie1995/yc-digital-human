<template>
	<view>
		<view class=" flex  flex-center round-circle" @click="togglePlay" :style="buttonStyle">
			<text class="iconfont" :class="isPlaying ? 'icon-zanting1' : 'icon-bofang'" :style="iconStyle"></text>
		</view>
	</view>
</template>

<script setup lang="ts">
	import { ref, computed } from 'vue';

	const emit = defineEmits(['togglePlay']);
	const props = withDefaults(
		defineProps<{
			width : number | number;
			fontSize : string | number;
			color : string;
			bgColor : string;
			src : string
		}>(),
		{
			width: 60,
			fontSize: '50rpx',
			bgColor: '--white',
			color: '--purple',
			src: ''
		}
	);

	const isPlaying = ref(false);

	const togglePlay = () => {
		isPlaying.value = !isPlaying.value;
		emit('togglePlay', { src: props.src, status: isPlaying.value })
	};

	const ensurePx = (value : string | number) => {
		return typeof value === 'number' ? `${value}px` : value.endsWith('px') ? value : `${value}px`;
	}

	const buttonStyle = computed(() => ({
		width: ensurePx(props.width),
		height: ensurePx(props.width),
		backgroundColor: `var(${props.bgColor})`,
	}));

	const iconStyle = computed(() => ({
		fontSize: ensurePx(props.fontSize),
		color: `var(${props.color})`,
	}));
</script>

<style lang="scss">
	@import '@/digitalhuman/static/iconfont.css';
	@import '@/digitalhuman/static/yy.scss';
</style>