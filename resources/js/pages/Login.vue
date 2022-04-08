<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="login">
            <div class="sides">
                <div class="side">
                    <div class="image"></div>
                    <div class="text">
                        <h4>New Scheduling and Routing Options</h4>
                        <p>
                            We also updated the format of podcasts and rewards
                        </p>
                    </div>
                </div>
                <div class="side">
                    <div class="container">
                        <div class="header">
                            <div class="brand">
                                <img
                                    src="https://digitwires.com/WiresPOS.svg"
                                />
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
                            <h2>{{ $t("hello-again") }}</h2>
                            <p>
                                Duis nostrud consectetur est eiusmod aliquip
                                minim ea ut qui in mollit excepteur consequat.
                            </p>
                            <form method="POST">
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
                                        autocomplete="off"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <label
                                        class="input-label"
                                        for="password-input"
                                        autocomplete="off"
                                    >
                                        {{ $t("password") }}
                                    </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password-input"
                                        required
                                    />
                                </div>
                                <a
                                    href="#"
                                    style="text-align: right; color: #3154aa"
                                >
                                    {{ $t("recovery-password") }}
                                </a>
                                <input
                                    type="submit"
                                    name="login"
                                    :value="$t('login')"
                                    class="login-btn"
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {},
    data() {
        return {};
    },
    methods: {
        setLanguage(item) {
            console.log(item);
            if (item == "en") {
                this.$i18n.locale = "en";
                this.$store.commit("setAppLanguage", "en");
            } else if (item == "ar") {
                this.$i18n.locale = "ar";
                this.$store.commit("setAppLanguage", "ar");
            }
        },
    },
};
</script>
