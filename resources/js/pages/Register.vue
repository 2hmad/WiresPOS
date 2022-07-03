<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="login">
            <img
                src="/images/ill-bg-shade.svg"
                style="position: absolute; left: 0"
            />
            <div class="sides">
                <div class="side">
                    <div class="container">
                        <div class="header">
                            <div class="brand">
                                <img src="/images/WiresPOS.svg" class="logo" />
                            </div>
                            <div class="lang-switcher">
                                <a @click="setLanguage('en')">
                                    <img
                                        src="https://img.icons8.com/color/30/000000/great-britain.png"
                                        v-if="$i18n.locale == 'ar'"
                                    />
                                </a>
                                <a @click="setLanguage('ar')">
                                    <img
                                        src="https://img.icons8.com/color/30/000000/saudi-arabia.png"
                                        v-if="$i18n.locale == 'en'"
                                    />
                                </a>
                            </div>
                        </div>
                        <div class="form">
                            <h2>
                                {{ $t("important-tools-to-help-you-sell") }}
                            </h2>
                            <p>
                                {{ $t("get-your-money-anytime-anywhere") }}
                            </p>
                            <form @submit.prevent="register" autocomplete="off">
                                <div class="form-group">
                                    <label class="input-label" for="name-input">
                                        {{ $t("full-name") }}
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name-input"
                                        v-model="form.name"
                                        autocomplete="false"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <label
                                        class="input-label"
                                        for="email-input"
                                    >
                                        {{ $t("email") }}
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email-input"
                                        v-model="form.email"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <label
                                        class="input-label"
                                        for="phone-input"
                                    >
                                        {{ $t("phone") }}
                                    </label>
                                    <vue-tel-input
                                        v-model="form.phone"
                                        id="phone-input"
                                        mode="international"
                                        :inputOptions="telInputOptions"
                                        required
                                    ></vue-tel-input>
                                </div>
                                <div class="form-group">
                                    <label
                                        class="input-label"
                                        for="password-input"
                                    >
                                        {{ $t("password") }}
                                    </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password-input"
                                        autocomplete="off"
                                        v-model="form.password"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <label
                                        class="input-label"
                                        for="business-type-input"
                                    >
                                        {{ $t("business-type") }}
                                    </label>
                                    <select
                                        id="business-type"
                                        v-model="form.business_type"
                                        required
                                    >
                                        <option value="1">
                                            {{ $t("retail-grocery-store") }}
                                        </option>
                                        <option value="2">
                                            {{ $t("cafe-restaurant") }}
                                        </option>
                                    </select>
                                </div>
                                <input
                                    type="submit"
                                    name="login"
                                    :value="$t('register')"
                                    class="login-btn"
                                />
                            </form>
                            <span
                                style="
                                    text-align: center;
                                    display: block;
                                    padding: 9px;
                                    font-size: 14px;
                                "
                            >
                                {{ $t("dont-have-an-account") }}
                                <router-link
                                    to="/"
                                    style="
                                        color: #336699;
                                        text-decoration: underline;
                                    "
                                >
                                    {{ $t("sign-in-now") }}
                                </router-link>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <img
                src="/images/ill-bg-shade-bottom.svg"
                style="position: absolute; right: 0; bottom: 0"
            />
        </div>
    </div>
</template>
<script>
import store from "../store/";
import { VueTelInput } from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
import axios from "axios";
import Swal from "sweetalert2";
export default {
    components: {
        VueTelInput,
    },

    data() {
        return {
            telInputOptions: {
                placeholder: this.$t("phone"),
            },
            form: {
                name: "",
                email: "",
                phone: "",
                password: "",
                business_type: "",
            },
        };
    },
    methods: {
        register() {
            axios
                .post("/api/register", this.form)
                .then((succ) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    Toast.fire({
                        icon: "success",
                        title: this.$t("successfully-registered"),
                    });
                    this.$router.push("/login");
                })
                .catch((err) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    Toast.fire({
                        icon: "error",
                        title: this.$t("email-or-phone-already-taken"),
                    });
                });
        },

        setLanguage(item) {
            if (item == "en") {
                this.$i18n.locale = "en";
                store.commit("setAppLanguage", "en");
            } else if (item == "ar") {
                this.$i18n.locale = "ar";
                store.commit("setAppLanguage", "ar");
            }
        },
    },
};
</script>
<style scoped>
.app-ar .side {
    margin-right: 0 !important;
}
</style>
