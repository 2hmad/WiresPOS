<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="input-group">
                        <label for="tax">Tax rate (%)</label>
                        <input type="number" id="tax" />
                    </div>
                    <div class="input-group">
                        <label for="language">Language</label>
                        <select id="language">
                            <option>English</option>
                            <option>Arabic</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="currency">Currency</label>
                        <select id="currency">
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
