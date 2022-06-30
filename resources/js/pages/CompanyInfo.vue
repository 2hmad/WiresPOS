<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <div class="container" style="gap: 0">
                    <div class="header">
                        <h3>{{ $t("company-info") }}</h3>
                        <router-link to="/settings">
                            <font-awesome-icon :icon="['fas', 'angle-left']" />
                            {{ $t("settings") }}
                        </router-link>
                    </div>
                    <form @submit.prevent="updateStore">
                        <div class="pic-change">
                            <label for="change">
                                <img
                                    :src="`/storage/stores/${store_logo}`"
                                    v-if="
                                        store_logo !== null && store_logo !== ''
                                    "
                                />
                                <img
                                    :src="`/images/placeholder-restaurant.png`"
                                    v-else
                                />
                            </label>
                            <input
                                type="file"
                                id="change"
                                accept="jpg,png,jpeg,svg"
                                @change="uploadPic"
                            />
                        </div>
                        <div class="input-group">
                            <label for="fullname">{{
                                $t("company-name")
                            }}</label>
                            <input
                                type="text"
                                id="fullname"
                                v-model="form.name"
                            />
                        </div>
                        <div class="input-group">
                            <label for="email">{{ $t("company-email") }}</label>
                            <input
                                type="email"
                                id="email"
                                v-model="form.email"
                            />
                        </div>
                        <div class="input-group">
                            <label for="email">{{
                                $t("company-address")
                            }}</label>
                            <input
                                type="text"
                                id="email"
                                v-model="form.address"
                            />
                        </div>
                        <div class="input-group">
                            <label for="phone">{{ $t("company-phone") }}</label>
                            <vue-tel-input
                                v-model="form.phone"
                                mode="international"
                                :inputOptions="telInputOptions"
                            ></vue-tel-input>
                        </div>
                        <div class="input-group">
                            <label for="website">{{
                                $t("company-website")
                            }}</label>
                            <input
                                type="url"
                                id="website"
                                v-model="form.website"
                            />
                        </div>
                        <div class="input-group">
                            <label for="lagally">
                                {{ $t("legally-registered") }}
                            </label>
                            <select id="lagally" v-model="form.legally">
                                <option value="yes">{{ $t("yes") }}</option>
                                <option value="no">{{ $t("no") }}</option>
                            </select>
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
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";

import axios from "axios";
import { mapActions } from "vuex";
import { VueTelInput } from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
export default {
    components: {
        Sidebar,
        VueTelInput,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            store_logo: "",
            telInputOptions: {
                placeholder: this.$t("phone"),
            },
            form: {
                id: JSON.parse(localStorage.getItem("wiresPOSUser")).store,
                name: "",
                email: "",
                address: "",
                phone: "",
                website: "",
                legally: "",
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
                (this.form.name = result.data.store_name),
                    (this.form.email = result.data.email),
                    (this.form.address = result.data.address),
                    (this.form.phone = result.data.phone),
                    (this.form.website = result.data.website),
                    (this.form.legally = result.data.legally),
                    (this.store_logo = result.data.logo);
            })
            .catch((err) => console.log(err));
    },
    methods: {
        uploadPic(e) {
            this.form.pic = e.target.files[0];
        },
        updateStore() {
            if (this.form.pic !== null) {
                const data = new FormData();
                data.append("pic", this.form.pic, this.form.pic.name);
                const details = JSON.stringify({
                    id: this.user.store,
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
                    .post("/api/update-store", data, config)
                    .then((result) => {
                        alert(this.$t("store-updated")), location.reload();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            } else {
                axios
                    .post("/api/update-store", this.form, {
                        headers: {
                            token: this.user.token,
                        },
                    })
                    .then((result) => {
                        alert(this.$t("store-updated")), location.reload();
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
