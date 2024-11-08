<template>
    <div>
        <el-card class="!border-none mb-4" shadow="never">
            <el-form class="mb-[-16px]" :model="queryParams" inline>
                <el-form-item label="卡密" prop="code">
                    <el-input class="w-[280px]" v-model="queryParams.code" clearable placeholder="请输入" />
                </el-form-item>
                <el-form-item label="使用状态" prop="used_status">
                    <el-select class="w-[280px]" v-model="queryParams.used_status" clearable placeholder="请选择"
                        style="width: 180px;">
                        <el-option label="全部" value=""></el-option>
                        <el-option v-for="(item, index) in dictData.used_status" :key="index" :label="item.name"
                            :value="item.value" />
                    </el-select>
                </el-form-item>
                <el-form-item label="卡密状态" prop="status">
                    <el-select class="w-[280px]" v-model="queryParams.status" clearable placeholder="请选择"
                        style="width: 180px;">
                        <el-option label="全部" value=""></el-option>
                        <el-option v-for="(item, index) in dictData.system_disable" :key="index" :label="item.name"
                            :value="item.value" />
                    </el-select>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="resetPage">查询</el-button>
                    <el-button @click="resetParams">重置</el-button>
                </el-form-item>
            </el-form>
        </el-card>
        <el-card class="!border-none" v-loading="pager.loading" shadow="never">
            <el-button v-perms="['digitalhuman.dh_cdkey/add']" type="primary" @click="handleAdd">
                <template #icon>
                    <icon name="el-icon-Plus" />
                </template>
                新增
            </el-button>
            <el-button v-perms="['digitalhuman.dh_cdkey/delete']" :disabled="!selectData.length"
                @click="handleDelete(selectData)">
                删除
            </el-button>
            <div class="mt-4">
                <el-table :data="pager.lists" @selection-change="handleSelectionChange">
                    <el-table-column type="selection" width="55" />
                    <el-table-column label="使用状态" prop="used_status">
                        <template #default="{ row }">
                            <!-- <dict-value :options="dictData.used_status" :value="row.used_status" /> -->
                            <el-tag v-if="row.used_status == 1">未使用</el-tag>
                            <el-tag v-else type="danger">已使用</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="卡密值" prop="code" show-overflow-tooltip />
                    <el-table-column label="兑换点数" prop="points" show-overflow-tooltip />
                    <el-table-column label="状态" prop="status">
                        <template #default="{ row }">
                            <el-tag v-if="row.status == 1" type="danger">禁用</el-tag>
                            <el-tag v-else>正常</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="操作" width="120" fixed="right">
                        <template #default="{ row }">
                            <el-button v-perms="['digitalhuman.dh_cdkey/delete']" type="danger" link
                                @click="handleDelete(row.id)">
                                删除
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
            <div class="flex mt-4 justify-end">
                <pagination v-model="pager" @change="getLists" />
            </div>
        </el-card>
        <edit-popup v-if="showEdit" ref="editRef" :dict-data="dictData" @success="getLists" @close="showEdit = false" />
    </div>
</template>

<script lang="ts" setup name="dhCdkeyLists">
import { usePaging } from '@/hooks/usePaging'
import { useDictData } from '@/hooks/useDictOptions'
import { apiDhCdkeyLists, apiDhCdkeyDelete } from '@/api/digitalhuman/dh_cdkey'
import { timeFormat } from '@/utils/util'
import feedback from '@/utils/feedback'
import EditPopup from './edit.vue'

const editRef = shallowRef<InstanceType<typeof EditPopup>>()
// 是否显示编辑框
const showEdit = ref(false)


// 查询条件
const queryParams = reactive({
    used_status: '',
    code: '',
    status: '',
    points: ''
})

// 选中数据
const selectData = ref<any[]>([])

// 表格选择后回调事件
const handleSelectionChange = (val: any[]) => {
    selectData.value = val.map(({ id }) => id)
}

// 获取字典数据
const { dictData } = useDictData('used_status,system_disable')

// 分页相关
const { pager, getLists, resetParams, resetPage } = usePaging({
    fetchFun: apiDhCdkeyLists,
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
    await apiDhCdkeyDelete({ id })
    getLists()
}

getLists()
</script>

