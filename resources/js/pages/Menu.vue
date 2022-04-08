<template>
    <v-app :class="`app-${$i18n.locale}`">
        <div class="menu">
            <Sidebar />
            <div class="sides">
                <div class="side">
                    <div class="heading">
                        <div class="title">
                            <h2>Choose Category</h2>
                        </div>
                        <div class="search">
                            <form>
                                <input
                                    type="text"
                                    placeholder="Search menu..."
                                    class="search-box"
                                />
                                <button type="submit">
                                    <font-awesome-icon
                                        icon="magnifying-glass"
                                    />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="side"></div>
            </div>
        </div>
    </v-app>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
export default {
    components: {
        Sidebar,
    },
    data() {},
};
</script>
