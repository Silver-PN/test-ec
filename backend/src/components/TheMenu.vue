<template>
    <a-menu
        v-model:openKeys="store.$state.openKeys"
        v-model:selectedKeys="store.$state.selectedKeys"
        mode="inline"
    >
        <a-menu-item key="admin-users">
            <router-link :to="{ name: 'admin-users' }">
                <i class="fa-solid fa-user" style="margin-right: 0.5rem"></i>
                <span> Tài khoản </span>
            </router-link>
        </a-menu-item>

        <a-menu-item key="admin-setting">
            <router-link :to="{ name: 'admin-setting' }">
                <i
                    class="fa-solid fa-gear mr-10"
                    style="margin-right: 0.5rem"
                ></i>
                <span> Cài Đặt </span>
            </router-link>
        </a-menu-item>
    </a-menu>
</template>

<script setup>
import { useMenu } from "../store/use-menu";
const store = useMenu();
</script>

<!-- <script>
import { defineComponent } from "vue";
import { storeToRefs } from "pinia";
import { useMenu } from "../store/use-menu";
export default defineComponent({
    setup() {
        const store = useMenu();
        return {
            ...storeToRefs(store),
        };
    },
});
</script> -->
