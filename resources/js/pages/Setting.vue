<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side"></div>
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
};
</script>
