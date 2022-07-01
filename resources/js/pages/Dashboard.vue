<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="dashboard">
            <Sidebar />
            <div class="side">
                <div class="card-steps">
                    <div class="info">
                        <img
                            src="/icons/icons8-celebration.svg"
                            style="max-width: 60px"
                        />
                        <h4>{{ $t("welcome-at-wirespos") }}</h4>
                        <p>{{ $t("get-your-money-anytime-anywhere") }}</p>
                    </div>
                    <div class="steps">
                        <ul>
                            <router-link to="/company-info">
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        v-if="
                                            company.store_name == null ||
                                            company.email == null ||
                                            company.address == null ||
                                            company.phone == null ||
                                            company.legally == null ||
                                            company.logo == null
                                        "
                                    />
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        class="completed"
                                        v-else
                                    />
                                    <span>
                                        {{ $t("fill-company-info") }} 🏢
                                    </span>
                                </li>
                            </router-link>
                            <router-link to="/branches">
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        v-if="branches.length == 0"
                                    />
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        v-else
                                        class="completed"
                                    />
                                    <span>
                                        {{ $t("add-branch-to-your-store") }}
                                        📜
                                    </span>
                                </li>
                            </router-link>
                            <router-link to="/system-settings">
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        v-if="
                                            systemSettings.tax_rate == null ||
                                            systemSettings.service_rate ==
                                                null ||
                                            systemSettings.currency == null
                                        "
                                    />
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        class="completed"
                                        v-else
                                    />
                                    <span>
                                        {{ $t("adjust-system-settings") }}
                                        ⚙️​
                                    </span>
                                </li>
                            </router-link>
                            <router-link to="/upgrade">
                                <li>
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        v-if="company.plan == 'free'"
                                    />
                                    <font-awesome-icon
                                        :icon="['fas', 'check-circle']"
                                        class="completed"
                                        v-else
                                    />
                                    <span>
                                        {{ $t("upgrade-to-premium-plan") }}
                                        👑​
                                    </span>
                                </li>
                            </router-link>
                        </ul>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <h4 class="heading">{{ $t("month-revenue") }}</h4>
                        <div class="line"></div>
                        <span class="count">
                            {{ monthly_revenue }}
                            <span class="currency">
                                {{ systemSettings.currency }}
                            </span>
                        </span>
                    </div>
                    <div class="card">
                        <h4 class="heading">{{ $t("today-revenue") }}</h4>
                        <div class="line"></div>
                        <span class="count">
                            {{ day_revenue }}
                            <span class="currency">
                                {{ systemSettings.currency }}
                            </span>
                        </span>
                    </div>
                    <div class="card">
                        <h4 class="heading">{{ $t("month-invoices") }}</h4>
                        <div class="line"></div>
                        <span class="count"> {{ monthly_invoices }} </span>
                    </div>
                </div>
                <br /><br />
                <apexchart
                    width="100%"
                    height="300px"
                    type="line"
                    :options="lineOptions"
                    :series="lineSeries"
                />
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            systemSettings: [],
            company: [],
            branches: [],
            monthly_revenue: null,
            day_revenue: null,
            monthly_invoices: null,
            jun_number: null,
            lineOptions: {
                chart: {
                    id: "revenue report",
                },
                fill: {
                    colors: "#336699",
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                },
            },
            lineSeries: [
                {
                    name: "revenue",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                },
            ],
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-branches",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => {
                this.branches = result.data;
            })
            .catch((err) => {
                console.log(err);
            });
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
        await axios
            .post(
                "/api/get-settings",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => (this.systemSettings = result.data))
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/revenue/month",
                {},
                {
                    headers: { token: this.user.token },
                }
            )
            .then((result) => {
                this.monthly_revenue = result.data;
            })
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/revenue/day",
                {},
                {
                    headers: { token: this.user.token },
                }
            )
            .then((result) => {
                this.day_revenue = result.data;
            })
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/monthly-invoices",
                {},
                {
                    headers: { token: this.user.token },
                }
            )
            .then((result) => {
                this.monthly_invoices = result.data;
            })
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/revenue-statistics",
                {},
                {
                    headers: { token: this.user.token },
                }
            )
            .then((result) => {
                Object.keys(result.data).map((item) => {
                    var rank = this.lineOptions.xaxis.categories.indexOf(item);
                    var lineData = this.lineSeries[0].data;
                    var reduce = result.data[item].reduce(
                        (accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        },
                        0
                    );
                    lineData[rank] = reduce;
                });
            })
            .catch((err) => console.log(err));
    },
};
</script>
