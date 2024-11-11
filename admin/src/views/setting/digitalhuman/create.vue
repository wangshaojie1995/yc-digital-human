<template>
    <div class="">
        <el-form ref="formRef" :rules="rules" class="ls-form" :model="formData" label-width="200px" scroll-to-error>

            <el-card shadow="never" class="!border-none ">
                <div class="text-xl font-medium mb-[20px]">创作配置</div>


                <el-form-item label="创作视频使用平台">
                    <div>
                        <el-radio-group v-model="formData.type">
                            <el-radio value="yiding">壹定</el-radio>
                            <el-radio value="guiji">硅基</el-radio>
                            <el-radio value="feiying" disabled>飞影</el-radio>
                            <el-radio value="shanjian" disabled>闪剪</el-radio>
                            <el-radio value="feitian" disabled>飞天</el-radio>
                        </el-radio-group>
                        <div v-if="formData.type == 'yiding'">
                            <a style="color: red; font-size: 12px;"
                                href="https://api.yidevs.com/?icode=nxNKa7bQ7pj6%2F3rDfdYvjW5lbjFKczVublRnSDgxS1ljSHVXbUE9PQ%3D%3D"
                                target="_blank">点击申请壹定开放平台</a>
                        </div>
                    </div>
                </el-form-item>



                <el-form-item label="壹定开发平台服务" v-if="formData.type == 'yiding'">
                    <div>
                        <el-radio-group v-model="formData.channel">
                            <el-radio :value="1">免费</el-radio>
                            <el-radio :value="2">付费</el-radio>
                            <el-radio :value="3">PRO</el-radio>
                        </el-radio-group>
                        <div style="color: red; font-size: 12px;">PRO接口无法与其他接口共享场景，需单独创建PRO场景</div>
                    </div>
                </el-form-item>

                <el-form-item label="合成音频使用平台">
                    <div>
                        <el-radio-group v-model="formData.voice_type">
                            <el-radio value="yiding">壹定</el-radio>
                        </el-radio-group>
                    </div>
                </el-form-item>

                <el-form-item label="用户可同时生成视频数量" prop="video_number">
                    <div class="w-80">
                        <el-input-number :controls="false" v-model.trim="formData.video_number" placeholder="请输入"
                            show-word-limit />
                    </div>
                </el-form-item>


                <el-form-item label="场景复刻扣除点数" prop="scene_points">
                    <div class="w-80">
                        <el-input-number :controls="false" v-model.trim="formData.scene_points" placeholder="请输入"
                            show-word-limit />
                    </div>
                </el-form-item>

                <el-form-item label="声音复刻扣除点数" prop="voice_points">
                    <div class="w-80">
                        <el-input-number :controls="false" v-model.trim="formData.voice_points" placeholder="请输入"
                            show-word-limit />
                    </div>
                </el-form-item>

                <el-form-item label="视频创作扣除点数(每秒)" prop="create_points">
                    <div class="w-80">
                        <el-input-number :controls="false" v-model.trim="formData.create_points" placeholder="请输入"
                            show-word-limit />
                    </div>
                </el-form-item>
            </el-card>

            <el-card shadow="never" class="!border-none mt-4">
                <div class="text-xl font-medium mb-[20px]">壹定开放平台配置</div>
                <el-form-item label="TOKEN" prop="token">
                    <div class="w-80">
                        <el-input v-model.trim="formData.token" placeholder="请输入TOKEN" show-word-limit />
                    </div>
                </el-form-item>
            </el-card>

            <el-card shadow="never" class="!border-none mt-4">
                <div class="text-xl font-medium mb-[20px]">硅语平台配置</div>
                <el-form-item label="appId(appKey)" prop="appid">
                    <div class="w-80">
                        <el-input v-model.trim="formData.appid" placeholder="请输入Appid" show-word-limit />
                    </div>
                </el-form-item>

                <el-form-item label="appSecret" prop="app_secret">
                    <div class="w-80">
                        <el-input v-model.trim="formData.app_secret" placeholder="请输入appSecret" show-word-limit />
                    </div>
                </el-form-item>
            </el-card>



        </el-form>
        <footer-btns v-perms="['setting.digitalhuman.create/setConfig']">
            <el-button type="primary" @click="handleSubmit">保存</el-button>
        </footer-btns>
    </div>
</template>

<script lang="ts" setup name="yiDing">
import { getConfig, setConfig } from '@/api/digitalhuman/three'


const formData = ref({
    token: '',
    channel: 1,
    voice_type: 'yiding',
    type: 'yiding',
    scene_points: 0,
    create_points: 0,
    voice_points: 0,
    video_number: 0,
    appid: '',
    app_secret: '',
})
const formRef = ref<FormInstance>()

const rules = {
    // appid: [
    //     {
    //         required: true,
    //         message: '请输入Appid',
    //         trigger: ['blur']
    //     }
    // ],
    // app_secret: [
    //     {
    //         required: true,
    //         message: '请输入AppSecret',
    //         trigger: ['blur']
    //     }
    // ]
}

const getData = async () => {
    const data = await getConfig()
    formData.value = data
}

const handleSubmit = async () => {
    await formRef.value?.validate()
    await setConfig(formData.value)
    getData()
}

getData()
</script>
