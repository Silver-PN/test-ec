<template>
    <a-card title="Tạo mới Tài khoản" style="width: 100%">
        <div class="row mb-3">
            <div class="col-12 col-sm-4 mb-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <a-avatar shape="square" :size="200">
                            <template #icon>
                                <img
                                    src="../../../assets/UserAvatar.png"
                                    alt=""
                                />
                            </template>
                        </a-avatar>
                    </div>

                    <div class="col-12 d-flex justify-content-center">
                        <a-button type="primary">
                            <i class="fa-solid fa-plus me-2"></i>
                            <span>Chọn ảnh</span>
                        </a-button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-8">
                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Tình trạng:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-select
                            show-search
                            placeholder="Tình trạng"
                            style="width: 100%"
                            :options="users_status"
                            :filter-option="filterOption"
                            allow-clear
                        ></a-select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Tên Tài khoản:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-input placeholder="Tên Tài khoản" allow-clear />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Họ và Tên:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-input placeholder="Họ và Tên" allow-clear />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Email:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-input placeholder="Email" allow-clear />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Phòng ban:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-select
                            show-search
                            placeholder="Phòng ban"
                            style="width: 100%"
                            :options="departments"
                            :filter-option="filterOption"
                            allow-clear
                        ></a-select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Mật khẩu:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-input-password placeholder="Mật khẩu" allow-clear />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-sm-3 text-start text-sm-end">
                        <label>
                            <span class="text-danger me-1">*</span>
                            <span>Xác nhận mật khẩu:</span>
                        </label>
                    </div>

                    <div class="col-12 col-sm-5">
                        <a-input-password
                            placeholder="Xác nhận mật khẩu"
                            allow-clear
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
                <a-button class="me-0 me-sm-2 mb-3 mb-sm-0">
                    <router-link :to="{ name: 'admin-users' }">
                        <span>Hủy</span>
                    </router-link>
                </a-button>

                <a-button type="primary">
                    <span>Lưu</span>
                </a-button>
            </div>
        </div>
    </a-card>
</template>
<script setup>
import { ref } from "vue";
import { useMenu } from "../../../store/use-menu";
useMenu().onSelectedKeys(["admin-users"]);
const users_status = ref([]);
const departments = ref([]);
const getUsersCreate = () => {
    axios
        .get("http://127.0.0.1:8000/api/users/create")
        .then((response) => {
            users_status.value = response.data.users_status;
            departments.value = response.data.departments;
        })
        .catch((error) => {
            console.log(error);
        });
};
const filterOption = (input, option) => {
    return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

getUsersCreate();
</script>
<style scoped></style>
