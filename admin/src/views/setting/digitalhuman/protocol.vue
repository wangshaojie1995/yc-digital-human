<template>
    <div class="xl:flex">
        <el-card class="!border-none flex-1 xl:mr-4 mb-4" shadow="never">
            <template #header>
                <span class="font-medium">场景复刻</span>
            </template>
            <el-form :model="formData" label-width="80px">
                <el-form-item label="协议名称">
                    <el-input v-model="formData.scene_title" />
                </el-form-item>
            </el-form>

            <editor class="mb-10" v-model="formData.scene_content" height="500"></editor>
        </el-card>
        <el-card class="!border-none flex-1 mb-4 xl:mr-4" shadow="never">
            <template #header>
                <span class="font-medium">声音复刻</span>
            </template>
            <el-form :model="formData" label-width="80px">
                <el-form-item label="协议名称">
                    <el-input v-model="formData.voice_title" />
                </el-form-item>
            </el-form>

            <editor class="mb-10" v-model="formData.voice_content" height="500"></editor>
        </el-card>

        <el-card class="!border-none flex-1 mb-4" shadow="never">
            <template #header>
                <span class="font-medium">视频合成</span>
            </template>
            <el-form :model="formData" label-width="80px">
                <el-form-item label="协议名称">
                    <el-input v-model="formData.video_title" />
                </el-form-item>
            </el-form>

            <editor class="mb-10" v-model="formData.video_content" height="500"></editor>
        </el-card>
    </div>
    <footer-btns v-perms="['setting.digitalhuman.agreement/set']">
        <el-button type="primary" @click="handleProtocolEdit">保存</el-button>
    </footer-btns>
</template>

<script setup lang="ts" naem="webProtocol">
import { getAgreementConfig, setAgreementConfig } from '@/api/digitalhuman/three'

interface formDataObj {
    scene_title: string
    scene_content: string
    voice_title: string
    voice_content: string
    video_title: string
    video_content: string
}
const formData = ref<formDataObj>({
    scene_title: '',
    scene_content: '',
    voice_title: '',
    voice_content: '',
    video_title: '',
    video_content: ''
})
const protocolGet = async () => {
    formData.value = await getAgreementConfig()
}

const handleProtocolEdit = async (): Promise<void> => {
    await setAgreementConfig({ ...formData.value })
    protocolGet()
}
protocolGet()
</script>
