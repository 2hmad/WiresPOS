<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="input-group">
                        <label for="oldPassword">Old Password</label>
                        <input
                            type="password"
                            placeholder="Old Password"
                            id="oldPassword"
                        />
                    </div>
                    <div class="input-group">
                        <label for="newPassword">New Password</label>
                        <input
                            type="password"
                            placeholder="New Password"
                            id="newPassword"
                        />
                    </div>
                    <div class="input-group">
                        <label for="ConfPassword">Confirm New Password</label>
                        <input
                            type="password"
                            placeholder="Confirm New Password"
                            id="ConfPassword"
                        />
                    </div>
                    <input type="submit" class="save" value="Change Password" />
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import SettingMenu from "../components/SettingMenu.vue";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {};
    },
};
</script>
