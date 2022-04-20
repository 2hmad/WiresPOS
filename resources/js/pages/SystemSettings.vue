<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="input-group">
                        <label for="fullname">Language</label>
                        <select>
                            <option>English</option>
                            <option>Arabic</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="email">Currency</label>
                        <select>
                            <option>US Dollar</option>
                            <option>Egyptian Pound</option>
                        </select>
                    </div>
                    <input type="submit" class="save" value="Save Change" />
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
