<template>
	<view class="flex flex-wrap grid-gap-6 fs-13">
		<view v-for="(item,index) in props.list" :key='index' @click="change(item,index)"
			:class="item[props.field]==props.list[current][props.field]?'bg-purple border-white':'bg-grey border-grey-3'"
			class=" round-30  px-15 py-4  block">{{item.name}}</view>
	</view>
</template>

<script setup>
	import { ref } from 'vue';
	const props = defineProps({
		list: {
			type: Array,
			default: []
		},
		field: {
			type: String,
			default: 'id'
		}
	})
	const emit = defineEmits(['change'])
	const current = ref(0)
	const change = (e, i) => {
		current.value = i
		emit('change', e)
	}
</script>

<style lang='scss'>
</style>