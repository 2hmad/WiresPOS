<template>
    <ul class="links">
        <li>
            <router-link to="/setting" class-active="active" exact>
                My Details
            </router-link>
        </li>
        <li>
            <router-link to="/password" class-active="active" exact>
                Password
            </router-link>
        </li>
        <li>
            <router-link to="/permissions" class-active="active" exact>
                Permissions
            </router-link>
        </li>
        <li>
            <router-link to="/system-settings" class-active="active" exact>
                System settings
            </router-link>
        </li>
    </ul>
</template>
<script>
export default {
    date() {},
};
</script>
