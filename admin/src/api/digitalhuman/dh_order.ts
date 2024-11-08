import request from '@/utils/request'

// 订单列表
export function apiDhOrderLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_order/lists', params })
}

// 添加订单
export function apiDhOrderAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_order/add', params })
}

// 编辑订单
export function apiDhOrderEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_order/edit', params })
}

// 删除订单
export function apiDhOrderDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_order/delete', params })
}

// 订单详情
export function apiDhOrderDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_order/detail', params })
}