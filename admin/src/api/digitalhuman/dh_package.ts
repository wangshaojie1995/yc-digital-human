import request from '@/utils/request'

// 套餐列表
export function apiDhPackageLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_package/lists', params })
}

// 添加套餐
export function apiDhPackageAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_package/add', params })
}

// 编辑套餐
export function apiDhPackageEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_package/edit', params })
}

// 删除套餐
export function apiDhPackageDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_package/delete', params })
}

// 套餐详情
export function apiDhPackageDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_package/detail', params })
}