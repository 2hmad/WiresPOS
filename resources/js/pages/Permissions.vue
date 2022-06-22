<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("settings") }}</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="input-group">
                        <label for="fullname">{{ $t("full-name") }}</label>
                        <input type="text" id="fullname" />
                    </div>
                    <div class="input-group">
                        <label for="email">{{ $t("email") }}</label>
                        <input type="email" id="email" />
                    </div>
                    <div class="input-group">
                        <label for="password">{{ $t("password") }}</label>
                        <input type="password" id="password" />
                    </div>
                    <div class="input-group">
                        <label for="conf-pass">
                            {{ $t("confirm-password") }}
                        </label>
                        <input type="password" id="conf-pass" />
                    </div>
                    <div class="input-group">
                        <label for="phone">{{ $t("phone") }}</label>
                        <input type="tel" id="phone" />
                    </div>
                    <div class="input-group">
                        <label for="phone">{{ $t("branch") }}</label>
                        <select>
                            <option>Alexandria</option>
                            <option>Cairo</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="phone">{{ $t("role") }}</label>
                        <select>
                            <option>{{ $t("admin") }}</option>
                            <option>{{ $t("employee") }}</option>
                        </select>
                    </div>
                    <input type="submit" class="save" :value="$t('add-user')" />
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
