import request from '@/utils/request'

// 卡密列表
export function apiDhCdkeyLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_cdkey/lists', params })
}

// 添加卡密
export function apiDhCdkeyAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_cdkey/add', params })
}

// 编辑卡密
export function apiDhCdkeyEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_cdkey/edit', params })
}

// 删除卡密
export function apiDhCdkeyDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_cdkey/delete', params })
}

// 卡密详情
export function apiDhCdkeyDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_cdkey/detail', params })
}