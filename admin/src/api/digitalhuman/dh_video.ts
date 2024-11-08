import request from '@/utils/request'

// 记录列表
export function apiDhVideoLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_video/lists', params })
}

// 添加记录
export function apiDhVideoAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_video/add', params })
}

// 编辑记录
export function apiDhVideoEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_video/edit', params })
}

// 删除记录
export function apiDhVideoDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_video/delete', params })
}

// 记录详情
export function apiDhVideoDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_video/detail', params })
}