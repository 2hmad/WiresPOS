<template>
    <div :class="`app-${$i18n.locale}`">
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
                                    <v-icon :icon="mdiMagnify" />
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="categories">
                        <div class="cards">
                            <div class="card" v-for="n in 7">
                                <div class="icon">
                                    <img
                                        src="https://cdn-icons-png.flaticon.com/512/924/924514.png"
                                        alt=""
                                    />
                                </div>
                                <div class="title">Coffee</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="side">
                    <div class="account">
                        <div style="display: flex; gap: 10px">
                            <div class="avatar">
                                <img
                                    src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1649426020~exp=1649426620~hmac=59e916bf81f9ca2cb088c705860504d5bd225d98aae8e957936477c1cf2bba67&w=740"
                                />
                            </div>
                            <div class="name">
                                <span class="job-title"> I'm a Cashier </span>
                                <span class="fullname"> Ahmed Mohamed </span>
                            </div>
                        </div>
                        <div class="notification">
                            <v-badge dot color="red">
                                <v-icon :icon="mdiBellOutline" />
                            </v-badge>
                        </div>
                    </div>
                    <div class="bills">
                        <h2>Bills</h2>
                        <div class="cards">
                            <div class="card" v-for="n in 3">
                                <div class="image">
                                    <img
                                        src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1649426020~exp=1649426620~hmac=59e916bf81f9ca2cb088c705860504d5bd225d98aae8e957936477c1cf2bba67&w=740"
                                    />
                                </div>
                                <div class="info">
                                    <span class="title">
                                        Caramel Frappuccino
                                    </span>
                                    <div class="quantity">
                                        <span class="number">1</span>
                                        <span class="price">$3.95</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            style="
                                display: flex;
                                flex-direction: column;
                                gap: 5px;
                            "
                        >
                            <div class="subtotal">
                                <span class="title">Subtotal</span>
                                <span class="price">$18.31</span>
                            </div>
                            <div class="tax">
                                <span class="title">Tax (14%)</span>
                                <span class="price">$2</span>
                            </div>
                            <div class="total">
                                <span class="title">Total</span>
                                <span class="price">$20.31</span>
                            </div>
                        </div>
                    </div>
                    <div class="payment"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import { mdiBellOutline, mdiMagnify } from "@mdi/js";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {
            mdiBellOutline,
            mdiMagnify,
        };
    },
};
</script>
