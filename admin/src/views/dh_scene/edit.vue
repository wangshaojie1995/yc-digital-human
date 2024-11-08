<template>
    <div class="edit-popup">
        <popup ref="popupRef" :title="popupTitle" :async="true" width="550px" @confirm="handleSubmit" @close="handleClose">
            <el-form ref="formRef" :model="formData" label-width="90px" :rules="formRules">
                <el-form-item label="场景名称" prop="name">
                    <el-input v-model="formData.name" clearable placeholder="请输入场景名称" />
                </el-form-item>
                <el-form-item label="图片" prop="cover_image">
                    <el-input v-model="formData.cover_image" clearable placeholder="请输入图片" />
                </el-form-item>
                <el-form-item label="视频地址" prop="video_url">
                    <el-input v-model="formData.video_url" clearable placeholder="请输入视频地址" />
                </el-form-item>
                <el-form-item label="场景ID" prop="scene_id">
                    <el-input v-model="formData.scene_id" clearable placeholder="请输入场景ID" />
                </el-form-item>
                <el-form-item label="" prop="robotid">
                    <el-input v-model="formData.robotid" clearable placeholder="请输入" />
                </el-form-item>
                <el-form-item label="" prop="uid">
                    <el-input v-model="formData.uid" clearable placeholder="请输入" />
                </el-form-item>
                <el-form-item label="视频地址" prop="apiVideoUrl">
                    <el-input v-model="formData.apiVideoUrl" clearable placeholder="请输入视频地址" />
                </el-form-item>
                <el-form-item label="" prop="type">
                    <el-input v-model="formData.type" clearable placeholder="请输入" />
                </el-form-item>
                <el-form-item label="任务ID" prop="task_id">
                    <el-input v-model="formData.task_id" clearable placeholder="请输入任务ID" />
                </el-form-item>
                <el-form-item label="状态" prop="status">
                    <el-input v-model="formData.status" clearable placeholder="请输入状态" />
                </el-form-item>
                <el-form-item label="错误消息" prop="massage">
                    <el-input v-model="formData.massage" clearable placeholder="请输入错误消息" />
                </el-form-item>
            </el-form>
        </popup>
    </div>
</template>

<script lang="ts" setup name="dhSceneEdit">
import type { FormInstance } from 'element-plus'
import Popup from '@/components/popup/index.vue'
import { apiDhSceneAdd, apiDhSceneEdit, apiDhSceneDetail } from '@/api/digitalhuman/dh_scene'
import { timeFormat } from '@/utils/util'
import type { PropType } from 'vue'
defineProps({
    dictData: {
        type: Object as PropType<Record<string, any[]>>,
        default: () => ({})
    }
})
const emit = defineEmits(['success', 'close'])
const formRef = shallowRef<FormInstance>()
const popupRef = shallowRef<InstanceType<typeof Popup>>()
const mode = ref('add')


// 弹窗标题
const popupTitle = computed(() => {
    return mode.value == 'edit' ? '编辑场景' : '新增场景'
})

// 表单数据
const formData = reactive({
    id: '',
    name: '',
    cover_image: '',
    video_url: '',
    scene_id: '',
    robotid: '',
    uid: '',
    apiVideoUrl: '',
    type: '',
    task_id: '',
    status: '',
    massage: '',
})


// 表单验证
const formRules = reactive<any>({

})


// 获取详情
const setFormData = async (data: Record<any, any>) => {
    for (const key in formData) {
        if (data[key] != null && data[key] != undefined) {
            //@ts-ignore
            formData[key] = data[key]
        }
    }


}

const getDetail = async (row: Record<string, any>) => {
    const data = await apiDhSceneDetail({
        id: row.id
    })
    setFormData(data)
}


// 提交按钮
const handleSubmit = async () => {
    await formRef.value?.validate()
    const data = { ...formData, }
    mode.value == 'edit'
        ? await apiDhSceneEdit(data)
        : await apiDhSceneAdd(data)
    popupRef.value?.close()
    emit('success')
}

//打开弹窗
const open = (type = 'add') => {
    mode.value = type
    popupRef.value?.open()
}

// 关闭回调
const handleClose = () => {
    emit('close')
}



defineExpose({
    open,
    setFormData,
    getDetail
})
</script>
