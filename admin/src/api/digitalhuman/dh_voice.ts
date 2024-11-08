import request from '@/utils/request'

// 声音列表
export function apiDhVoiceLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_voice/lists', params })
}

// 添加声音
export function apiDhVoiceAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_voice/add', params })
}

// 编辑声音
export function apiDhVoiceEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_voice/edit', params })
}

// 删除声音
export function apiDhVoiceDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_voice/delete', params })
}

// 声音详情
export function apiDhVoiceDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_voice/detail', params })
}