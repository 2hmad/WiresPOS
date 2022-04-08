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
                            <font-awesome-icon icon="house" />
                        </div>
                        <div class="title">Home</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/menu" class-active="active" exact>
                        <div class="icon">
                            <font-awesome-icon icon="bowl-rice" />
                        </div>
                        <div class="title">Menu</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/history" class-active="active" exact>
                        <div class="icon">
                            <font-awesome-icon icon="clock-rotate-left" />
                        </div>
                        <div class="title">History</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/wallet" class-active="active" exact>
                        <div class="icon">
                            <font-awesome-icon icon="wallet" />
                        </div>
                        <div class="title">Wallet</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/promos" class-active="active" exact>
                        <div class="icon">
                            <font-awesome-icon icon="percent" />
                        </div>
                        <div class="title">Promos</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/setting" class-active="active" exact>
                        <div class="icon">
                            <font-awesome-icon icon="gear" />
                        </div>
                        <div class="title">Setting</div>
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    data() {},
};
</script>
