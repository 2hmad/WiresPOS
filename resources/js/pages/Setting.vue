<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
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
                        <router-link
                            to="/notifications"
                            class-active="active"
                            exact
                        >
                            Notifications
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            to="/permissions"
                            class-active="active"
                            exact
                        >
                            Permissions
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            to="/system-settings"
                            class-active="active"
                            exact
                        >
                            System settings
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {};
    },
};
</script>
