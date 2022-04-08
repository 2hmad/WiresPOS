<template>
    <nav class="sidebar">
        <div class="brand">
            <img src="https://digitwires.com/WiresPOS.svg" />
        </div>
        <div class="items">
            <ul>
                <li>
                    <router-link to="/" class-active="active" exact>
                        <div class="icon">
                            <v-icon :icon="mdiHomeVariantOutline" />
                        </div>
                        <div class="title">Home</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/menu" class-active="active" exact>
                        <div class="icon">
                            <v-icon :icon="mdiBlenderOutline" />
                        </div>
                        <div class="title">Menu</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/history" class-active="active" exact>
                        <div class="icon">
                            <v-icon :icon="mdiHistory" />
                        </div>
                        <div class="title">History</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/wallet" class-active="active" exact>
                        <div class="icon">
                            <v-icon :icon="mdiWallet" />
                        </div>
                        <div class="title">Wallet</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/promos" class-active="active" exact>
                        <div class="icon">
                            <v-icon :icon="mdiPercentOutline" />
                        </div>
                        <div class="title">Promos</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/setting" class-active="active" exact>
                        <div class="icon">
                            <v-icon :icon="mdiCogOutline" />
                        </div>
                        <div class="title">Setting</div>
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
import {
    mdiHomeVariantOutline,
    mdiBlenderOutline,
    mdiHistory,
    mdiWallet,
    mdiPercentOutline,
    mdiCogOutline,
} from "@mdi/js";
export default {
    data() {
        return {
            mdiHomeVariantOutline,
            mdiBlenderOutline,
            mdiHistory,
            mdiWallet,
            mdiPercentOutline,
            mdiCogOutline,
        };
    },
};
</script>
