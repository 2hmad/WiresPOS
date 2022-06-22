<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("settings") }}</h3>
                <SettingMenu />
                <form @submit.prevent="updateStore">
                    <div class="pic-change">
                        <label for="change">
                            <img
                                :src="`/storage/stores/${store_logo}`"
                                v-if="store_logo !== null && store_logo !== ''"
                            />
                            <img
                                :src="`/images/placeholder-restaurant.png`"
                                v-else
                            />
                        </label>
                        <input type="file" id="change" @change="uploadPic" />
                    </div>
                    <div class="input-group">
                        <label for="fullname">{{ $t("company-name") }}</label>
                        <input type="text" id="fullname" v-model="form.name" />
                    </div>
                    <div class="input-group">
                        <label for="email">{{ $t("company-address") }}</label>
                        <input type="email" id="email" v-model="form.address" />
                    </div>
                    <div class="input-group">
                        <label for="phone">{{ $t("company-phone") }}</label>
                        <input type="tel" id="phone" v-model="form.phone" />
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
            store_logo: null,
            form: {
                name: "",
                address: "",
                phone: "",
                pic: null,
            },
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-store",
                {},
                {
                    headers: {
                        token: this.user.token,
                    },
                }
            )
            .then((result) => {
                (this.form.name = result.data.name),
                    (this.form.address = result.data.address),
                    (this.form.phone = result.data.phone),
                    (this.store_logo = result.data.logo);
            })
            .catch((err) => console.log(err));
    },
    methods: {
        uploadPic(e) {
            this.form.pic = e.target.files[0];
        },
        updateProfile() {
            if (this.form.pic !== null) {
                const data = new FormData();
                data.append("pic", this.form.pic, this.form.pic.name);
                const details = JSON.stringify({
                    name: this.form.name,
                    address: this.form.address,
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
