import request from '@/utils/request'

// 获取文本列表
export function getVoiceTextList() {
	return request.get({ url: '/digitalhuman.VoiceText/lists' },{isAuth:true})
}
export function getTraintext() {
	return request.get({ url: '/digitalhuman.Voice/getTraintext' },{isAuth:true})
}

//上传音频
export function uploadVoice(options ?: any, token ?: any) {
	return request.uploadFile({
		url: '/upload/voice',
		...options,
		name: 'file',
		header: {
			token
		},
		fileType: 'audio'
	})
}

//添加音频信息
export function createVoice(data : any) {
	return request.post({ url: '/digitalhuman.Voice/createVoice', data: data },{isAuth:true})
}



//公共声音
export function getCommonVoiceList(){
	return request.get({ url: '/digitalhuman.Voice/getCommonVoiceList' },{isAuth:true})
}



//声音
export function getVoiceList(data:any){
	return request.get({ url: '/digitalhuman.Voice/lists',data:data },{isAuth:true})
}


//修改名称
export function renameVoice(data : any) {
	return request.post({ url: '/digitalhuman.Voice/rename', data: data },{isAuth:true})
}
//删除视频
export function delVoice(data : any) {
	return request.post({ url: '/digitalhuman.Voice/del', data: data },{isAuth:true})
}