import request from '@/utils/request'

export function getContent(data : any) {
	return request.get({ url: '/digitalhuman.Agreement/getConfig', data: data },{isAuth:true})
}


export function exchange(data : any) {
	return request.post({ url: '/digitalhuman.Cdkey/exchange', data: data },{isAuth:true})
}