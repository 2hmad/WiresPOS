<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="input-group">
                        <label for="branchName">Branch name</label>
                        <input
                            type="text"
                            placeholder="Branch name"
                            id="branchName"
                        />
                    </div>
                    <div class="input-group">
                        <label for="branchAddress">Branch address</label>
                        <input
                            type="text"
                            placeholder="Branch address"
                            id="branchAddress"
                        />
                    </div>
                    <div class="input-group">
                        <label for="branchTel">Branch phone</label>
                        <input
                            type="tel"
                            placeholder="Branch phone"
                            id="branchTel"
                        />
                    </div>
                    <input type="submit" class="save" value="Add User" />
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
