<template>
	<view class='text-white'>
		<view class="flex flex-y-center flex-column grid-gap-8" v-if="status === 1">
			<view class="w-90 h-90 bg-purple flex border-purple-2 flex-center round-circle" style="border-width: 12rpx;"
				@tap="start">
				<text class="iconfont icon-maikefeng" style="font-size: 100rpx;"></text>
			</view>
			<view class=" fs-12 text-center flex flex-column grid-gap-4 text-grey-1">
				<text>点击录制自己的声音</text>
				<text>录制15~30秒</text>
			</view>
		</view>

		<view class="flex flex-y-center flex-column grid-gap-8" v-if="status === 2">
			<view class="flex flex-column grid-gap-4 text-center">
				<text class="text-white fs-18 fw-600">{{duration}}</text>
				<text class="fs-14 text-grey-1">录音中</text>
			</view>
			<view class="w-90 h-90 bg-purple flex border-purple-2 flex-center round-circle" style="border-width: 12rpx;"
				@tap="stop">
				<text class="iconfont icon-zanting" style="font-size: 70rpx;"></text>
			</view>
		</view>

		<view class="flex flex-y-center flex-column grid-gap-8" v-if="status === 3">
			<view class="flex flex-column grid-gap-4 text-center">
				<text class="text-white fs-18 fw-600">{{duration}}</text>
				<text class="fs-14 text-grey-1">录音结束</text>
			</view>
			<view class="flex flex-center text-center">
				<view @click="status = 1">
					<view class="w-50 h-50 flex flex-center bg-purple-2 round-circle mb-6">
						<text class="iconfont icon-zhongshi" style="font-size: 40rpx;"></text>
					</view>
					<text>重录</text>
				</view>
				<view class="w-90 h-90 ml-30 bg-purple flex border-purple-2 flex-center round-circle" @click="play">
					<text class="iconfont icon-bofang" style="font-size: 70rpx;" v-if='audioStatus==false'></text>
					<text class="iconfont icon-zanting1" style="font-size: 70rpx;" v-else></text>
				</view>
			</view>
		</view>

		<!-- #ifdef MP-WEIXIN -->
		<view class='border-white p-8 mt-30 round-10 flex flex-y-center' style='border-style: dashed;'  @click='chooseMessageFile'>
			<view class='bg-grey-3 w-60 h-60 round-8 flex flex-center'>
				<text class='iconfont icon-shangchuanwenjian text-white fs-25'></text>
			</view>
			<view class="flex flex-column grid-gap-8 ml-8">
				<text class='fw-600 text-white fs-16'>从微信中选择</text>
				<text class='fs-12 text-grey-1'>格式要求:mp3 m4a wav</text>
			</view>
		</view>
		<!-- #endif -->
		<!-- #ifdef H5 -->
		<view class='border-white p-8 mt-30 round-10 flex flex-y-center' style='border-style: dashed;' @click='chooseFile'>
			<view class='bg-grey-3 w-60 h-60 round-8 flex flex-center'>
				<text class='iconfont icon-shangchuanwenjian text-white fs-25'></text>
			</view>
			<view class="flex flex-column grid-gap-8 ml-8" >
				<text class='fw-600 text-white fs-16'>从文件中选择</text>
				<text class='fs-12 text-grey-1'>格式要求:mp3 m4a wav</text>
			</view>
		</view>
		<!-- #endif -->

	</view>
</template>

<script setup lang="ts">
	import { ref, onMounted, defineProps, onUnmounted } from 'vue';
	const props = withDefaults(defineProps<{
		iconSize ?: string | number
		maxDuration ?: number
	}>(), {
		iconSize: '50',
		maxDuration: 19
	});
	const status = ref(1)
	const emit = defineEmits(['start', 'success']);
	const recorderState = ref(false);
	const h5RecorderState = ref(true);
	let mediaRecorder : MediaRecorder;
	let mediaStream : MediaStream;
	let recordedBlobs : BlobPart[] = [];
	let isUserMedia = false;
	let audio : HTMLAudioElement;
	let startTime : number;
	let startTimeEr : any;
	const duration = ref(0);
	let innerAudioContext = uni.createInnerAudioContext();
	// #ifndef H5
	const recorderManager = uni.getRecorderManager();
	// #endif
	// #ifdef H5
	const checkUserMedia = () => {
		if (location.protocol !== 'https:') {
			uni.showModal({
				content: '录音只能在HTTPS环境中使用'
			})
			return h5RecorderState.value = false;
		}
		if (!navigator.mediaDevices || !window.MediaRecorder) {
			uni.showModal({
				content: '当前浏览器不支持录音，请更换浏览器或在微信中打开。'
			})
			return h5RecorderState.value = false;
		}
		audio = document.createElement('audio')
		navigator.mediaDevices.getUserMedia({ audio: true })
			.then(stream => {
				isUserMedia = true;
				stream.getTracks().forEach((track) => {
					track.stop()
				})
			})
			.catch(error => console.error('Error:', error));
	}
	// #endif
	const start = () => {
		duration.value = 0;
		// #ifdef H5
		if (!isUserMedia) {
			uni.showToast({
				title: '请允许使用麦克风',
				icon: 'none'
			})
			return;
		}
		emit('start')
		navigator.mediaDevices.getUserMedia({ audio: true }).then(stream => {
			status.value = 2
			recordedBlobs = []
			mediaStream = stream
			mediaRecorder = new MediaRecorder(stream, {
				audioBitsPerSecond: 128000
			})
			mediaRecorder.ondataavailable = (event) => {
				recorderState.value = true;
				recordedBlobs.push(event.data)
			}
			mediaRecorder.onstop = () => {
				clearInterval(startTimeEr);
				recorderState.value = false;
				const file = new File(recordedBlobs, 'recorder.mp3', { type: 'audio/mp3' });
				const url = URL.createObjectURL(file);
				innerAudioContext.src = url
				emit('success', { url, file, duration: duration.value })
			}
			mediaRecorder.start()
			startTime = new Date().getTime();
			startTimeEr = setInterval(() => {
				duration.value = Math.floor((new Date().getTime() - startTime) / 1000);
				if (props.maxDuration && duration.value >= props.maxDuration) {
					stop();
				}
			}, 1000)
			recorderState.value = true;
		}).catch(err => {
			let content = '';
			switch (err.name) {
				case 'NotAllowedError':
					content = '当前浏览器不支持录音，请更换浏览器或在微信中打开。';
					break;
				case 'NotReadableError':
					content = '麦克风权限被拒绝，请刷新页面后授权麦克风权限。';
					break
				default:
					content = '未知错误，请刷新页面重试：' + JSON.stringify(err);
					break
			}
			uni.showModal({
				content: content,
				success: (res : any) => {
					if (res.confirm) {
						uni.navigateBack()
					}
				}
			})
		})
		// #endif
		// #ifndef H5
		emit('start')
		startTime = new Date().getTime();
		startTimeEr = setInterval(() => {
			duration.value = Math.floor((new Date().getTime() - startTime) / 1000);
			if (props.maxDuration && duration.value >= props.maxDuration) {
				stop();
			}
		}, 1000)
		recorderState.value = true;
		let options = {
			duration: 600000,
			format: 'mp3',
		};
		if (props.maxDuration) {
			options.duration = props.maxDuration * 1000;
		}
		recorderManager.start(options);
		// #endif
	}
	const stop = () => {
		status.value = 3
		// #ifdef H5
		mediaRecorder.stop()
		mediaStream.getTracks().forEach((track) => {
			track.stop()
		})
		// #endif
		// #ifndef H5
		recorderManager.stop();
		// #endif
	}
	onMounted(() => {
		// #ifdef H5
		checkUserMedia()
		// #endif
		innerAudioContext.onCanplay(() => {
			if (innerAudioContext.duration != Infinity) {
				duration.value = Math.ceil(innerAudioContext.duration)
			}
		})

		innerAudioContext.onPlay(() => {
			audioStatus.value = true
		})

		innerAudioContext.onStop(() => {
			audioStatus.value = false
		})

		innerAudioContext.onPause(() => {
			audioStatus.value = false
		})

		// #ifndef H5
		recorderManager.onStop((res : any) => {
			clearInterval(startTimeEr);
			recorderState.value = false;
			innerAudioContext.src = res.tempFilePath
			emit('success', { url: res.tempFilePath, duration: duration.value })
		});
		recorderManager.onError((err : any) => {
			uni.showModal({
				title: '录制失败:',
				content: err.errMsg
			})
			status.value = 1
			clearInterval(startTimeEr);
			recorderState.value = false;
		});

		recorderManager.onStart(() => {
			status.value = 2
		})
		// #endif
	})
	defineExpose({
		start,
		stop
	})
	const audioStatus = ref(false)
	const play = () => {
		if (audioStatus.value == false) {
			innerAudioContext.play()
		} else {
			innerAudioContext.pause()
		}
	}

	const chooseMessageFile = () => {
		wx.chooseMessageFile({
			count: 1,
			type: 'file',
			extension: ['mp3', 'wav', 'm4a', 'webm'],
			success: (res : any) => {
				const file = res.tempFiles[0];
				innerAudioContext.src = res.tempFiles[0]
				status.value = 3
				setTimeout(() => {
					emit('success', { url: file.path, duration: duration.value })
				}, 300)

			}, fail: (err : any) => {
				console.log('err', err)
			}
		})
	}
	const chooseFile = () => {
		uni.chooseFile({
			count: 1,
			extension: ['mp3', 'wav', 'm4a', 'webm'],
			success: (res : any) => {
				innerAudioContext.src = res.tempFilePaths[0]
				status.value = 3
				emit('success', { url: res.tempFilePaths[0], file: res.tempFiles[0], duration: duration.value })
			}
		});
	}

	onUnmounted(() => {
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

<style lang="scss" scoped>
	@import '@/digitalhuman/static/iconfont.css';
</style>