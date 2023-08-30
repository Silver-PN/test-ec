<template>
    <a-card title="User List" style="width: 100%">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-3">
                <a-button type="primary">
                    <router-link :to="{ name: 'admin-users-create' }">
                        <i class="fa-solid fa-user-plus" />
                    </router-link>
                </a-button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a-table
                    :dataSource="users"
                    :columns="columns"
                    :scroll="{ x: 576 }"
                >
                    <template #bodyCell="{ column, index, record }">
                        <template v-if="column.key === 'index'">
                            <span>
                                {{ index + 1 }}
                            </span>
                        </template>

                        <template v-if="column.key === 'status'">
                            <span
                                v-if="record.status_id == 1"
                                class="text-primary"
                            >
                                {{ record.status }}
                            </span>
                            <span
                                v-else-if="record.status_id == 2"
                                class="text-danger"
                            >
                                {{ record.status }}
                            </span>
                        </template>
                    </template>
                </a-table>
            </div>
        </div>
    </a-card>
</template>

<script setup>
import { ref } from "vue";
import { useMenu } from "../../../store/use-menu";
useMenu().onSelectedKeys(["admin-users"]);
const users = ref([]);
const columns = [
    {
        title: "STT",
        key: "index",
    },
    {
        title: "Tài Khoản",
        dataIndex: "username",
        key: "username",
        // responsive: ["sm"],
        // hide column: sm phone, md desktop,lg size view
    },
    {
        title: "Họ và Tên",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Email",
        dataIndex: "email",
        key: "email",
    },
    {
        title: "Vai Trò",
        dataIndex: "departments",
        key: "departments",
    },
    {
        title: "Trạng Thái",
        dataIndex: "status",
        key: "status",
        fixed: "right",
    },
];
const getFullUser = () => {
    axios
        .get("http://127.0.0.1:8000/api/users")
        .then(function (response) {
            // xử trí khi thành công
            users.value = response.data;
            // console.log(users.value);
        })
        .catch(function (error) {
            // xử trí khi bị lỗi
            console.log(error);
        })
        .finally(function () {
            // luôn luôn được thực thi
        });
};
getFullUser();
</script>
