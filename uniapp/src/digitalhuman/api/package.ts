import request from '@/utils/request'


export function getPackageList(data : any) {
	return request.get({ url: '/digitalhuman.Package/lists', data: data },{isAuth:true})
}


export function createOrder(data : any) {
	return request.post({ url: '/digitalhuman.Package/createOrder', data: data },{isAuth:true})
}