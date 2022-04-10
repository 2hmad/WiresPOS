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
                            <Carousel
                                :settings="settings"
                                :breakpoints="breakpoints"
                            >
                                <Slide v-for="n in 9" :key="n">
                                    <div class="card">
                                        <div class="icon">
                                            <img
                                                src="https://cdn-icons-png.flaticon.com/512/924/924514.png"
                                                alt=""
                                            />
                                        </div>
                                        <div class="title">Coffee</div>
                                    </div>
                                </Slide>
                            </Carousel>
                        </div>
                    </div>
                </div>
                <!-- Menu -->
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
                            <div class="card" v-for="n in 10">
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
                    <div class="payment">
                        <h2>Payment Method</h2>
                        <div class="cards">
                            <div
                                class="card"
                                @click="payment(1)"
                                v-bind:class="{ active: this.method == 1 }"
                            >
                                <div class="icon">
                                    <v-icon :icon="mdiCash" />
                                </div>
                                <div class="title">Cash</div>
                            </div>
                            <div
                                class="card"
                                @click="payment(2)"
                                v-bind:class="{ active: this.method == 2 }"
                            >
                                <div class="icon">
                                    <v-icon :icon="mdiCreditCard" />
                                </div>
                                <div class="title">Credit Card</div>
                            </div>
                            <div
                                class="card"
                                @click="payment(3)"
                                v-bind:class="{ active: this.method === 3 }"
                            >
                                <div class="icon">
                                    <v-icon :icon="mdiQrcodeScan" />
                                </div>
                                <div class="title">E-Wallet</div>
                            </div>
                        </div>
                    </div>
                    <button class="print-bill">Print Bill</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide } from "vue3-carousel";
import {
    mdiBellOutline,
    mdiMagnify,
    mdiCash,
    mdiCreditCard,
    mdiQrcodeScan,
} from "@mdi/js";
export default {
    name: "menu",
    components: {
        Sidebar,
        Carousel,
        Slide,
    },
    data: () => ({
        mdiBellOutline,
        mdiMagnify,
        mdiCash,
        mdiCreditCard,
        mdiQrcodeScan,
        method: null,
        settings: {
            itemsToShow: 1,
            snapAlign: "start",
        },
        breakpoints: {
            700: {
                itemsToShow: 3.5,
                snapAlign: "start",
            },
            1024: {
                itemsToShow: 7,
                snapAlign: "start",
            },
        },
    }),
    methods: {
        payment(id) {
            this.method = id;
            console.log(this.payment);
        },
    },
};
</script>
<style lang="scss">
.carousel {
    max-width: 750px;
    @media screen and (min-width: 1024px) {
        max-width: 100%;
        width: 100%;
    }
}
</style>
