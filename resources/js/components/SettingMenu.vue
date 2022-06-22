<template>
    <ul class="links">
        <li>
            <router-link to="/setting" class-active="active" exact>
                {{ $t("my-details") }}
            </router-link>
        </li>
        <li>
            <router-link to="/password" class-active="active" exact>
                {{ $t("password") }}
            </router-link>
        </li>
        <li>
            <router-link to="/branches" class-active="active" exact>
                {{ $t("branches") }}
            </router-link>
        </li>
        <li v-if="user.role == 'admin'">
            <router-link to="/permissions" class-active="active" exact>
                {{ $t("permissions") }}
            </router-link>
        </li>
        <li>
            <router-link to="/system-settings" class-active="active" exact>
                {{ $t("system-settings") }}
            </router-link>
        </li>
    </ul>
</template>
<script>
export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
        };
    },
};
</script>
