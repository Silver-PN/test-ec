import users from "../pages/admin/users/index.vue";
import userscreate from "../pages/admin/users/create.vue";

import setting from "../pages/admin/setting/index.vue";
const admin = [
    {
        path: "/admin",
        component: () => import("../layouts/admin.vue"),
        children: [
            // Router User
            {
                path: "users",
                name: "admin-users",
                component: users,
            },
            {
                path: "users/create",
                name: "admin-users-create",
                component: userscreate,
            },

            // Router Setting
            {
                path: "setting",
                name: "admin-setting",
                component: setting,
            },
        ],
    },
];
export default admin;
