import request from '@/utils/request'

// 获取配置
export function getConfig() {
    return request.get({ url: '/setting.digitalhuman.create/getConfig' })
}


// 设置配置
export function setConfig(params: any) {
    return request.post({ url: '/setting.digitalhuman.create/setConfig', params })
}







// 获取配置
export function getAgreementConfig() {
    return request.get({ url: '/setting.digitalhuman.agreement/getConfig' })
}


// 设置配置
export function setAgreementConfig(params: any) {
    return request.post({ url: '/setting.digitalhuman.agreement/setConfig', params })
}

