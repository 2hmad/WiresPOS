<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="dashboard">
            <Sidebar />
            <div class="side">
                <div class="cards">
                    <div class="card">
                        <h4 class="heading">{{ $t("total-earnings") }}</h4>
                        <span class="count">0</span>
                    </div>
                    <div class="card">
                        <h4 class="heading">{{ $t("month-earnings") }}</h4>
                        <span class="count">0</span>
                    </div>
                    <div class="card">
                        <h4 class="heading">{{ $t("invoices") }}</h4>
                        <span class="count">0</span>
                    </div>
                </div>
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
        return {};
    },
    methods: {},
};
</script>
