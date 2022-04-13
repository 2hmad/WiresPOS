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
                    <router-link to="/setting" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-settings.svg" />
                        </div>
                        <div class="title">Setting</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/setting" class-active="active" exact>
                        <div class="icon">
                            <img src="icons/icons8-logout.svg" />
                        </div>
                        <div class="title">Logout</div>
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    data() {
        return {};
    },
};
</script>
