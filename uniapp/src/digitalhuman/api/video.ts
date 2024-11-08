import request from '@/utils/request'

//添加视频
export function createVideo(data : any) {
	return request.post({ url: '/digitalhuman.Video/createVideo', data: data },{isAuth:true})
}

//获取列表
export function getVideoList(data : any) {
	return request.get({ url: '/digitalhuman.Video/lists', data: data },{isAuth:true})
}


//删除视频
export function delVideo(data : any) {
	return request.post({ url: '/digitalhuman.Video/del', data: data },{isAuth:true})
}
//修改名称
export function renameVideo(data : any) {
	return request.post({ url: '/digitalhuman.Video/rename', data: data },{isAuth:true})
}

//失败重试
export function retryVideo(data : any) {
	return request.post({ url: '/digitalhuman.Video/retry', data: data },{isAuth:true})
}