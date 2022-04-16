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
                                <button
                                    type="submit"
                                    style="display: flex; align-items: center"
                                >
                                    <img
                                        src="icons/icons8-search.svg"
                                        style="width: 23px"
                                    />
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
                                <Slide v-for="item in items" :key="item">
                                    <button @click="setCat(item.id)">
                                        <div
                                            class="card"
                                            :class="{
                                                active:
                                                    this.selectedCat == item.id,
                                            }"
                                        >
                                            <div class="icon">
                                                <img :src="item.icon" alt="" />
                                            </div>
                                            <div class="title">
                                                {{ item.title }}
                                            </div>
                                        </div>
                                    </button>
                                </Slide>
                            </Carousel>
                        </div>
                    </div>
                    <h2 style="font-weight: 600; margin-top: 3%">
                        {{
                            selectedCat
                                ? items.find((item) => item.id === selectedCat)
                                      .title + " Menu"
                                : ""
                        }}
                    </h2>
                    <div class="products">
                        <div
                            class="product"
                            v-for="product in filterProducts"
                            :key="product.id"
                        >
                            <div class="info">
                                <div class="image">
                                    <img :src="product.image" />
                                </div>
                                <div class="details">
                                    <span class="title">
                                        {{ product.title }}
                                        <button
                                            class="add"
                                            @click="addBill(product.id)"
                                        >
                                            <img
                                                src="/icons/icons8-plus-math.svg"
                                            />
                                        </button>
                                    </span>
                                    <span class="desc">
                                        {{ product.desc }}
                                    </span>
                                    <span class="price">
                                        <span class="currency">EGP</span>
                                        {{ product.price }}
                                    </span>
                                </div>
                            </div>
                            <div class="sizes">
                                <h3>Size</h3>
                                <div class="cards">
                                    <button class="size" @click="activeSize">
                                        S
                                    </button>
                                    <button class="size" @click="activeSize">
                                        M
                                    </button>
                                    <button class="size" @click="activeSize">
                                        L
                                    </button>
                                </div>
                            </div>
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
                                <img
                                    src="icons/icons8-notification.svg"
                                    style="max-width: 27px"
                                />
                            </v-badge>
                        </div>
                    </div>
                    <div class="bills">
                        <h2>Bills</h2>
                        <div class="cards">
                            <div
                                class="card"
                                v-for="(bill, index) in filterBills"
                                :key="index"
                            >
                                <div class="image">
                                    <img
                                        src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1649426020~exp=1649426620~hmac=59e916bf81f9ca2cb088c705860504d5bd225d98aae8e957936477c1cf2bba67&w=740"
                                    />
                                </div>
                                <div class="info">
                                    <span class="title">
                                        {{ bill.title }}
                                    </span>
                                    <div class="quantity">
                                        <span class="number">1</span>
                                        <span class="price">
                                            ${{ bill.price }}
                                        </span>
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
                                    <img src="icons/icons8-money.svg" />
                                </div>
                                <div class="title">Cash</div>
                            </div>
                            <div
                                class="card"
                                @click="payment(2)"
                                v-bind:class="{ active: this.method == 2 }"
                            >
                                <div class="icon">
                                    <img src="icons/icons8-debit-card.svg" />
                                </div>
                                <div class="title">Credit Card</div>
                            </div>
                            <div
                                class="card"
                                @click="payment(3)"
                                v-bind:class="{ active: this.method === 3 }"
                            >
                                <div class="icon">
                                    <img
                                        src="icons/icons8-business-card-scanner.svg"
                                    />
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
export default {
    name: "menu",
    components: {
        Sidebar,
        Carousel,
        Slide,
    },
    data() {
        return {
            method: null,
            selectedCat: null,
            items: [
                {
                    id: 1,
                    title: "All",
                    icon: "https://cdn-icons-png.flaticon.com/512/924/924514.png",
                },
                {
                    id: 2,
                    title: "Coffee",
                    icon: "https://cdn-icons-png.flaticon.com/512/924/924514.png",
                },
            ],
            products: [
                {
                    id: 1,
                    title: "Caramel Frappaccino",
                    desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    image: "https://images.pexels.com/photos/312418/pexels-photo-312418.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260",
                    price: "3.95",
                    cat: 1,
                },
                {
                    id: 2,
                    title: "Caramel",
                    desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    image: "https://images.pexels.com/photos/312418/pexels-photo-312418.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260",
                    price: "4.95",
                    cat: 2,
                },
            ],
            filterProducts: [],
            bill: null,
            filterBills: [],
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
        };
    },
    methods: {
        payment(id) {
            this.method = id;
            console.log(this.payment);
        },
        setCat(id) {
            this.selectedCat = id;
            if (id == 1) {
                this.filterProducts = this.products;
            } else {
                this.filterProducts = this.products.filter(
                    (p) => p.cat === this.selectedCat
                );
            }
        },
        activeSize(event) {
            event.target.classList.toggle("active");
        },
        addBill(id) {
            this.bill = id;
            this.filterBills.push(
                this.products.filter((p) => p.id === this.bill)
            );
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
