import request from '@/utils/request'

// 获取我的视频
export function getSceneList(data : any) {
	return request.get({ url: '/digitalhuman.Scene/lists', data: data },{isAuth:true})
}

//上传
export function uploadVideo(file : any, token ?: any) {
	return request.uploadFile({
		url: '/upload/video',
		filePath: file,
		name: 'file',
		header: {
			token
		},
		fileType: 'video'
	})
}

//添加视频信息
export function createScene(data : any) {
	return request.post({ url: '/digitalhuman.Scene/createScene', data: data },{isAuth:true})
}

//删除视频
export function delScene(data : any) {
	return request.post({ url: '/digitalhuman.Scene/del', data: data },{isAuth:true})
}
//修改名称
export function renameScene(data : any) {
	return request.post({ url: '/digitalhuman.Scene/rename', data: data },{isAuth:true})
}
//获取视频详情
export function detailScene(data : any) {
	return request.get({ url: '/digitalhuman.Scene/detail', data: data },{isAuth:true})
}
export function retryScene(data : any) {
	return request.post({ url: '/digitalhuman.Scene/retry', data: data },{isAuth:true})
}
