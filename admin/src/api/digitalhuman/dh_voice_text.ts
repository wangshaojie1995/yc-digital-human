import request from '@/utils/request'

// 文本列表
export function apiDhVoiceTextLists(params: any) {
    return request.get({ url: '/digitalhuman.dh_voice_text/lists', params })
}

// 添加文本
export function apiDhVoiceTextAdd(params: any) {
    return request.post({ url: '/digitalhuman.dh_voice_text/add', params })
}

// 编辑文本
export function apiDhVoiceTextEdit(params: any) {
    return request.post({ url: '/digitalhuman.dh_voice_text/edit', params })
}

// 删除文本
export function apiDhVoiceTextDelete(params: any) {
    return request.post({ url: '/digitalhuman.dh_voice_text/delete', params })
}

// 文本详情
export function apiDhVoiceTextDetail(params: any) {
    return request.get({ url: '/digitalhuman.dh_voice_text/detail', params })
}