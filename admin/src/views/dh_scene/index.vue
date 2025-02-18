<template>
    <div>
        <el-card class="!border-none mb-4" shadow="never">
            <el-form class="mb-[-16px]" :model="queryParams" inline>
                <el-form-item label="场景名称" prop="name">
                    <el-input class="w-[280px]" v-model="queryParams.name" clearable placeholder="请输入场景名称" />
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="resetPage">查询</el-button>
                    <el-button @click="resetParams">重置</el-button>
                </el-form-item>
            </el-form>
        </el-card>
        <el-card class="!border-none" v-loading="pager.loading" shadow="never">
            <div class="mt-4">
                <el-table :data="pager.lists">
                    <el-table-column label="ID" prop="id" show-overflow-tooltip />
                    <el-table-column label="昵称" prop="user.nickname" show-overflow-tooltip />

                    <el-table-column label="头像">
                        <template #default="{ row }">
                            <el-avatar :src="row.user.avatar" :size="50" />
                        </template>
                    </el-table-column>

                    <el-table-column label="场景名称" prop="name" show-overflow-tooltip />
                    <el-table-column label="图片" min-width="100">
                        <template #default="{ row }">
                            <image-contain v-if="row.cover_image" :src="row.cover_image" :width="60" :height="45"
                                :preview-src-list="[row.cover_image]" preview-teleported fit="contain" />
                        </template>
                    </el-table-column>
                    <el-table-column label="视频" min-width="100">
                        <template #default="{ row }">
                            <a :href="row.api_video_url" target="_blank" rel="noopener noreferrer"
                                style="color:red;">点击播放</a>
                        </template>
                    </el-table-column>
                    <el-table-column label="场景ID" prop="scene_id" show-overflow-tooltip />
                    <el-table-column label="任务ID" prop="task_id" show-overflow-tooltip />
                    <el-table-column label="状态" prop="status">
                        <template #default="{ row }">
                            <el-tag v-if="row.status == 1">生成中</el-tag>
                            <el-tag v-else-if="row.status == 2" type="success">生成成功</el-tag>
                            <el-tag v-else type="danger">生成失败</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="渠道" prop="channel">
                        <template #default="{ row }">
                            <el-tag v-if="row.channel == 3">PRO</el-tag>
                            <el-tag v-else type="success">普通</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="错误消息" prop="massage" show-overflow-tooltip />
                    <el-table-column label="操作" width="120" fixed="right">
                        <template #default="{ row }">
                            <el-button v-perms="['dh_scene/delete']" type="danger" link @click="handleDelete(row.id)">
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

<script lang="ts" setup name="dhSceneLists">
import { usePaging } from '@/hooks/usePaging'
import { useDictData } from '@/hooks/useDictOptions'
import { apiDhSceneLists, apiDhSceneDelete } from '@/api/digitalhuman/dh_scene'
import { timeFormat } from '@/utils/util'
import feedback from '@/utils/feedback'
import EditPopup from './edit.vue'

const editRef = shallowRef<InstanceType<typeof EditPopup>>()
// 是否显示编辑框
const showEdit = ref(false)


// 查询条件
const queryParams = reactive({
    name: ''
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
    fetchFun: apiDhSceneLists,
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
    await apiDhSceneDelete({ id })
    getLists()
}

getLists()
</script>

