<template>
    <nav class="sidebar">
        <div class="brand">
            <img src="/images/WiresPOS.svg" />
        </div>
        <div class="items">
            <ul>
                <li>
                    <router-link to="/" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-home.svg" />
                        </div>
                        <div class="title">Home</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/menu" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-cooking-pot.svg" />
                        </div>
                        <div class="title">Menu</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/history" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-clock.svg" />
                        </div>
                        <div class="title">History</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/products" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-product.svg" />
                        </div>
                        <div class="title">Products</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/setting" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-settings.svg" />
                        </div>
                        <div class="title">Setting</div>
                    </router-link>
                </li>
                <li>
                    <a href="#" @click="logout">
                        <div class="icon">
                            <img src="icons/icons8-logout.svg" />
                        </div>
                        <div class="title">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {};
    },
    methods: {
        ...mapActions(["LogOut"]),
        async logout() {
            try {
                await this.LogOut();
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
