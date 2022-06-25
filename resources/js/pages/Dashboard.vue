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
                            10500
                            <span class="currency">
                                {{ systemSettings.currency }}
                            </span>
                        </span>
                    </div>
                    <div class="card">
                        <h4 class="heading">{{ $t("today-revenue") }}</h4>
                        <div class="line"></div>
                        <span class="count">
                            1500
                            <span class="currency">
                                {{ systemSettings.currency }}
                            </span>
                        </span>
                    </div>
                    <div class="card">
                        <h4 class="heading">{{ $t("month-invoices") }}</h4>
                        <div class="line"></div>
                        <span class="count"> 100 </span>
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
            lineOptions: {
                chart: {
                    id: "vuechart-example",
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
                    name: "series-1",
                    data: [30, 40, 45, 50, 49, 60, 70, 91, 50, 40],
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
    },
};
</script>
