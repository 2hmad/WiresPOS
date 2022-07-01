<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="upgrade-page">
            <Sidebar />
            <div class="side">
                <div class="cards">
                    <div class="free-card">
                        <div class="heading">
                            <h3>{{ $t("free-package") }}</h3>
                            <p>{{ $t("we-provide-free-package-for-you") }}</p>
                        </div>
                        <div class="benefits">
                            <ul>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("limited-invoices-10") }}
                                </li>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("branches-limited-1") }}
                                </li>
                            </ul>
                        </div>
                        <div class="price">
                            <span v-if="company.plan == 'free'">
                                <font-awesome-icon
                                    :icon="['fas', 'check-circle']"
                                />
                                {{ $t("current-package") }}
                            </span>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="heading">
                            <h3>{{ $t("premium-package") }}</h3>
                            <p>
                                {{ $t("we-provide-premium-package-for-you") }}
                            </p>
                        </div>
                        <div class="benefits">
                            <ul>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("unlimited-invoices") }}
                                </li>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("unlimited-branches") }}
                                </li>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("integrated-cashier") }}
                                </li>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("professional-reports") }}
                                </li>
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check']"
                                    />
                                    {{ $t("share-via-sms-email") }}
                                </li>
                            </ul>
                        </div>
                        <div class="price">
                            <div>
                                <div class="replace-packages">
                                    <span>{{ $t("monthly") }}</span>
                                    <input
                                        type="checkbox"
                                        name="switch"
                                        id="switch"
                                        v-if="yearly"
                                        @click="yearly = false"
                                    />
                                    <input
                                        type="checkbox"
                                        name="switch"
                                        id="switch"
                                        v-else-if="!yearly"
                                        @click="yearly = true"
                                        checked
                                    />
                                    <label for="switch"></label>
                                    <span>{{ $t("yearly") }}</span>
                                </div>
                                <span class="price" v-if="yearly">
                                    90 <span class="currency">USD / </span>
                                    <span class="duration">
                                        {{ $t("yearly") }}
                                    </span>
                                </span>
                                <span class="price" v-else-if="!yearly">
                                    8 <span class="currency">USD / </span>
                                    <span class="duration">
                                        {{ $t("monthly") }}
                                    </span>
                                </span>
                                <button class="subscribe-btn">
                                    <font-awesome-icon
                                        :icon="['fas', 'crown']"
                                    />
                                    {{ $t("upgrade") }}
                                </button>
                            </div>
                            <span v-if="company.plan == 'premium'">
                                <font-awesome-icon
                                    :icon="['fas', 'check-circle']"
                                />
                                {{ $t("current-package") }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import axios from "axios";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            company: [],
            yearly: true,
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
                this.company = result.data;
            })
            .catch((err) => console.log(err));
    },
};
</script>
