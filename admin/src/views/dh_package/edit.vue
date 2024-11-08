<template>
    <div class="edit-popup">
        <popup ref="popupRef" :title="popupTitle" :async="true" width="550px" @confirm="handleSubmit" @close="handleClose">
            <el-form ref="formRef" :model="formData" label-width="130px" :rules="formRules">
                <el-form-item label="套餐名称" prop="name">
                    <el-input v-model="formData.name" clearable placeholder="请输入套餐名称" />
                </el-form-item>
                <el-form-item label="套餐价格" prop="price">
                    <el-input-number :controls="false" v-model="formData.price" clearable placeholder="请输入套餐价格" />
                </el-form-item>
                <el-form-item label="套餐点数" prop="points">
                    <el-input-number :controls="false" v-model="formData.points" clearable placeholder="请输入套餐点数" />
                </el-form-item>
                <el-form-item label="排序（升序）" prop="sort">
                    <el-input-number :controls="false" v-model="formData.sort" clearable placeholder="请输入排序（升序）" />
                </el-form-item>
            </el-form>
        </popup>
    </div>
</template>

<script lang="ts" setup name="dhPackageEdit">
import type { FormInstance } from 'element-plus'
import Popup from '@/components/popup/index.vue'
import { apiDhPackageAdd, apiDhPackageEdit, apiDhPackageDetail } from '@/api/digitalhuman/dh_package'
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
    return mode.value == 'edit' ? '编辑套餐' : '新增套餐'
})

// 表单数据
const formData = reactive({
    id: '',
    name: '',
    price: '',
    points: '',
    sort: '',
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
    const data = await apiDhPackageDetail({
        id: row.id
    })
    setFormData(data)
}


// 提交按钮
const handleSubmit = async () => {
    await formRef.value?.validate()
    const data = { ...formData, }
    mode.value == 'edit'
        ? await apiDhPackageEdit(data)
        : await apiDhPackageAdd(data)
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
