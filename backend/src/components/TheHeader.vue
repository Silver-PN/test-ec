<template>
    <div class="containter-fluid">
        <div
            class="row text-white"
            style="background-color: #0c713d; padding: 1rem"
        >
            <div
                class="col-1 d-flex d-sm-none align-items-center justify-content-center"
            >
                <span @click="showDrawer()">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </div>
            <div
                class="col-10 d-flex align-items-center justify-content-center"
            >
                <img
                    src="../assets/Glory.png"
                    alt="Logo"
                    height="32"
                    width="34"
                    class="ms-3 me-3"
                />
            </div>

            <div
                class="col-1 d-flex d-sm-none align-items-center justify-content-center"
            >
                <span @click="showAdminDrawer()"> X </span>
            </div>
        </div>
    </div>
    <a-drawer
        v-model:open="open"
        style="color: rgb(84, 21, 232)"
        title="Menu"
        placement="left"
    >
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
    </a-drawer>
    <a-drawer
        v-model:open="open"
        style="color: rgb(84, 21, 232)"
        title="Menu User"
        placement="left"
    >
        <TheMenu />
    </a-drawer>
    <a-drawer
        v-model:open="open2"
        style="color: rgb(255, 0, 0)"
        title="Menu Admin"
        placement="right"
    >
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
    </a-drawer>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import TheMenu from "./TheMenu.vue";
const open = ref<boolean>(false);
const open2 = ref<boolean>(false);

// const afterOpenChange = (bool: boolean) => {
//     console.log("open", bool);
// };

const showDrawer = () => {
    open.value = true;
};
const showAdminDrawer = () => {
    open2.value = true;
};
</script>
