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
    setup() {},
};
</script>
