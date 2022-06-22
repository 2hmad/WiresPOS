<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("settings") }}</h3>
                <SettingMenu />
                <form @submit.prevent="updateProfile">
                    <div class="pic-change">
                        <label for="change">
                            <img
                                :src="`/storage/users/${user.pic}`"
                                v-if="user.pic !== ''"
                            />
                            <img :src="`/images/default.jpg`" v-else />
                        </label>
                        <input type="file" id="change" @change="uploadPic" />
                    </div>
                    <div class="input-group">
                        <label for="fullname">{{ $t("full-name") }}</label>
                        <input
                            type="text"
                            placeholder="Full name"
                            id="fullname"
                            v-model="form.fullName"
                        />
                    </div>
                    <div class="input-group">
                        <label for="email">{{ $t("email") }}</label>
                        <input
                            type="email"
                            placeholder="Email Address"
                            id="email"
                            v-model="form.email"
                        />
                    </div>
                    <div class="input-group">
                        <label for="phone">{{ $t("phone") }}</label>
                        <input
                            type="tel"
                            placeholder="Phone"
                            id="phone"
                            v-model="form.phone"
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
            form: {
                fullName: "",
                email: "",
                phone: "",
                pic: null,
            },
        };
    },
    mounted() {
        this.form.fullName = this.user.full_name;
        this.form.email = this.user.email;
        this.form.phone = this.user.phone;
    },
    methods: {
        ...mapActions(["LogOut"]),
        uploadPic(e) {
            this.form.pic = e.target.files[0];
        },
        updateProfile() {
            if (this.form.pic !== null) {
                const data = new FormData();
                data.append("pic", this.form.pic, this.form.pic.name);
                const details = JSON.stringify({
                    full_name: this.form.fullName,
                    email: this.form.email,
                    phone: this.form.phone,
                });
                data.append("data", details);
                const config = {
                    headers: {
                        "content-type": "multipart/form-data",
                        token: this.user.token,
                    },
                };
                axios
                    .post("/api/update-profile", data, config)
                    .then((result) => {
                        alert(this.$t("profile-updated")), this.logout();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            } else {
                axios
                    .post("/api/update-profile", this.form, {
                        headers: {
                            token: this.user.token,
                        },
                    })
                    .then((result) => {
                        alert(this.$t("profile-updated")), this.logout();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
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
