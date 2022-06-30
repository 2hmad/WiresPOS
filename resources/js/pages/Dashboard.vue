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
                    data: [],
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
                if (result.data.Jan) {
                    this.lineSeries[0].data.push(
                        result.data.Jan.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Feb) {
                    this.lineSeries[0].data.push(
                        result.data.Feb.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Mar) {
                    this.lineSeries[0].data.push(
                        result.data.Mar.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Apr) {
                    this.lineSeries[0].data.push(
                        result.data.Apr.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.May) {
                    this.lineSeries[0].data.push(
                        result.data.May.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Jun) {
                    this.lineSeries[0].data.push(
                        result.data.Jun.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Jul) {
                    this.lineSeries[0].data.push(
                        result.data.Jul.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Aug) {
                    this.lineSeries[0].data.push(
                        result.data.Aug.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Sep) {
                    this.lineSeries[0].data.push(
                        result.data.Sep.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Oct) {
                    this.lineSeries[0].data.push(
                        result.data.Oct.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Nov) {
                    this.lineSeries[0].data.push(
                        result.data.Nov.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
                if (result.data.Dec) {
                    this.lineSeries[0].data.push(
                        result.data.Dec.reduce((accumulator, object) => {
                            return (
                                parseInt(accumulator) +
                                parseInt(object.subtotal)
                            );
                        }, 0)
                    );
                } else {
                    this.lineSeries[0].data.push(0);
                }
            })
            .catch((err) => console.log(err));
    },
};
</script>
