import request from '@/utils/request'

// 场景列表
export function apiDhSceneLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_scene/lists', params })
}

// 添加场景
export function apiDhSceneAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_scene/add', params })
}

// 编辑场景
export function apiDhSceneEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_scene/edit', params })
}

// 删除场景
export function apiDhSceneDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_scene/delete', params })
}

// 场景详情
export function apiDhSceneDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_scene/detail', params })
}