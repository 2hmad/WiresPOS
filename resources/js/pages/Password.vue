<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("settings") }}</h3>
                <SettingMenu />
                <form method="POST" @submit.prevent="changePassword">
                    <div class="input-group">
                        <label for="oldPassword">
                            {{ $t("old-password") }}
                        </label>
                        <input
                            type="password"
                            id="oldPassword"
                            v-model="form.old_password"
                        />
                    </div>
                    <div class="input-group">
                        <label for="newPassword">
                            {{ $t("new-password") }}
                        </label>
                        <input
                            type="password"
                            id="newPassword"
                            v-model="form.new_password"
                        />
                    </div>
                    <div class="input-group">
                        <label for="ConfPassword">
                            {{ $t("confirm-new-password") }}
                        </label>
                        <input
                            type="password"
                            id="ConfPassword"
                            v-model="confirm_new_password"
                        />
                    </div>
                    <input
                        type="submit"
                        class="save"
                        :value="$t('save-changes')"
                    />
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import SettingMenu from "../components/SettingMenu.vue";
import axios from "axios";
import { mapActions } from "vuex";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            confirm_new_password: "",
            form: {
                old_password: "",
                new_password: "",
            },
        };
    },
    methods: {
        ...mapActions(["LogOut"]),
        changePassword() {
            if (this.form.new_password === this.confirm_new_password) {
                axios
                    .post("/api/update-password", this.form, {
                        headers: {
                            token: this.user.token,
                        },
                    })
                    .then((result) => {
                        alert(this.$t("password-changed")), this.logout();
                    })
                    .catch((err) => {
                        alert(this.$t("old-password-incorrect"));
                    });
            } else {
                alert(this.$t("password-and-confirm-not-match"));
            }
        },
        async logout() {
            try {
                await this.LogOut();
                location.reload();
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
