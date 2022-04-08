<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="dashboard">
            <Sidebar />
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
