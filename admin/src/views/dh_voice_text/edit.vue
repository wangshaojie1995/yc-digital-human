<template>
    <div class="edit-popup">
        <popup ref="popupRef" :title="popupTitle" :async="true" width="550px" @confirm="handleSubmit" @close="handleClose">
            <el-form ref="formRef" :model="formData" label-width="90px" :rules="formRules">
                <el-form-item label="标题" prop="name">
                    <el-input v-model="formData.name" clearable placeholder="请输入" />
                </el-form-item>
                <el-form-item label="文本内容" prop="content">
                    <el-input v-model="formData.content" type="textarea" clearable placeholder="请输入" />
                </el-form-item>
                <el-form-item label="排序" prop="sort">
                    <el-input-number v-model="formData.sort" clearable placeholder="请输入" />
                </el-form-item>
            </el-form>
        </popup>
    </div>
</template>

<script lang="ts" setup name="dhVoiceTextEdit">
import type { FormInstance } from 'element-plus'
import Popup from '@/components/popup/index.vue'
import { apiDhVoiceTextAdd, apiDhVoiceTextEdit, apiDhVoiceTextDetail } from '@/api/digitalhuman/dh_voice_text'
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
    return mode.value == 'edit' ? '编辑文本' : '新增文本'
})

// 表单数据
const formData = reactive({
    id: '',
    name: '',
    content: '',
    sort: '',
})


// 表单验证
const formRules = reactive<any>({
    name: [{
        required: true,
        message: '请输入',
        trigger: ['blur']
    }],
    content: [{
        required: true,
        message: '请输入',
        trigger: ['blur']
    }],
    sort: [{
        required: true,
        message: '请输入',
        trigger: ['blur']
    }]
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
    const data = await apiDhVoiceTextDetail({
        id: row.id
    })
    setFormData(data)
}


// 提交按钮
const handleSubmit = async () => {
    await formRef.value?.validate()
    const data = { ...formData, }
    mode.value == 'edit'
        ? await apiDhVoiceTextEdit(data)
        : await apiDhVoiceTextAdd(data)
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
