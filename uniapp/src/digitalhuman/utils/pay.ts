export const pay = (data:any) => {
	return new Promise((resolve, reject) => {
			// #ifdef MP-WEIXIN
			uni.requestPayment({
				"appId": data.appId,
				"timeStamp": data.timeStamp,
				"nonceStr": data.nonceStr,
				"package": data.package,
				"signType": "MD5",
				"paySign": data.paySign,
				success(res:any) {
					resolve(res)
				},
				fail(error:any) {
					reject(error)
				}
			})
			// #endif

			// #ifdef H5
			WeixinJSBridge.invoke('getBrandWCPayRequest', {
				"appId": data.appId,
				"timeStamp": data.timeStamp,
				"nonceStr": data.nonceStr,
				"package": data.package,
				"signType": "MD5",
				"paySign": data.paySign
			}, function(result:any) {
				if (result.err_msg == "get_brand_wcpay_request:ok") {
					resolve(result)
				} else {
					reject()
				}
			})
			// #endif
		
	})
}