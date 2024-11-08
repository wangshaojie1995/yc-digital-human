<template>
    <div>
        <el-card class="!border-none mb-4" shadow="never">
            <el-form class="mb-[-16px]" :model="queryParams" inline>
                <el-form-item label="订单号" prop="order_no">
                    <el-input class="w-[280px]" v-model="queryParams.order_no" clearable placeholder="请输入订单号" />
                </el-form-item>
                <el-form-item label="微信侧订单号" prop="wechat_order_no">
                    <el-input class="w-[280px]" v-model="queryParams.wechat_order_no" clearable placeholder="请输入微信侧订单号" />
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="resetPage">查询</el-button>
                    <el-button @click="resetParams">重置</el-button>
                </el-form-item>
            </el-form>
        </el-card>
        <el-card class="!border-none" v-loading="pager.loading" shadow="never">
            <div class="mt-4">
                <el-table :data="pager.lists" @selection-change="handleSelectionChange">
                    <el-table-column label="ID" prop="id" width="70" />
                    <el-table-column label="昵称" prop="user.nickname" show-overflow-tooltip />

                    <el-table-column label="头像">
                        <template #default="{ row }">
                            <el-avatar :src="row.user.avatar" :size="50" />
                        </template>
                    </el-table-column>
                    <el-table-column label="套餐" prop="package.name" show-overflow-tooltip />
                    <el-table-column label="订单号" prop="order_no" show-overflow-tooltip />
                    <el-table-column label="微信侧订单号" prop="wechat_order_no" show-overflow-tooltip />
                    <el-table-column label="支付金额" prop="price" show-overflow-tooltip />
                    <el-table-column label="状态" prop="status">
                        <template #default="{ row }">
                            <el-tag v-if="row.status == 1">未支付</el-tag>
                            <el-tag v-else-if="row.status == 2" type="success">已支付</el-tag>
                            <el-tag v-else type="danger">失败</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="支付时间" prop="pay_time" show-overflow-tooltip />
                </el-table>
            </div>
            <div class="flex mt-4 justify-end">
                <pagination v-model="pager" @change="getLists" />
            </div>
        </el-card>
        <edit-popup v-if="showEdit" ref="editRef" :dict-data="dictData" @success="getLists" @close="showEdit = false" />
    </div>
</template>

<script lang="ts" setup name="dhOrderLists">
import { usePaging } from '@/hooks/usePaging'
import { useDictData } from '@/hooks/useDictOptions'
import { apiDhOrderLists, apiDhOrderDelete } from '@/api/digitalhuman/dh_order'
import { timeFormat } from '@/utils/util'
import feedback from '@/utils/feedback'
import EditPopup from './edit.vue'

const editRef = shallowRef<InstanceType<typeof EditPopup>>()
// 是否显示编辑框
const showEdit = ref(false)


// 查询条件
const queryParams = reactive({
    order_no: '',
    wechat_order_no: ''
})

// 选中数据
const selectData = ref<any[]>([])

// 表格选择后回调事件
const handleSelectionChange = (val: any[]) => {
    selectData.value = val.map(({ id }) => id)
}

// 获取字典数据
const { dictData } = useDictData('')

// 分页相关
const { pager, getLists, resetParams, resetPage } = usePaging({
    fetchFun: apiDhOrderLists,
    params: queryParams
})

// 添加
const handleAdd = async () => {
    showEdit.value = true
    await nextTick()
    editRef.value?.open('add')
}

// 编辑
const handleEdit = async (data: any) => {
    showEdit.value = true
    await nextTick()
    editRef.value?.open('edit')
    editRef.value?.setFormData(data)
}

// 删除
const handleDelete = async (id: number | any[]) => {
    await feedback.confirm('确定要删除？')
    await apiDhOrderDelete({ id })
    getLists()
}

getLists()
</script>

