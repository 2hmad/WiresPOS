<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="dashboard">
            <Sidebar />
            <div class="side">
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
