<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="menu">
            <Sidebar />
            <div class="menu-sides">
                <div class="menu-side">
                    <div class="heading">
                        <div class="title">
                            <h2>{{ $t("choose-category") }}</h2>
                        </div>
                        <div class="search">
                            <form>
                                <input
                                    type="text"
                                    :placeholder="$t('search-menu') + '...'"
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
                                                <img
                                                    :src="`/storage/cats/${item.icon}`"
                                                />
                                            </div>
                                            <div class="title">
                                                {{ item.category_name }}
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
                                      .category_name + " Menu"
                                : ""
                        }}
                    </h2>
                    <div class="products">
                        <div
                            class="product"
                            v-for="product in filterProducts"
                            :key="product.id"
                            @click="addBill(product.id)"
                        >
                            <div class="info">
                                <div class="image">
                                    <img
                                        :src="`/storage/products/${product.image}`"
                                    />
                                </div>
                                <div class="details">
                                    <span class="title">
                                        {{ product.product_name }}
                                    </span>
                                    <span class="desc">
                                        {{ product.product_details }}
                                    </span>
                                    <span class="price">
                                        <span class="currency">EGP</span>
                                        {{ product.price }}
                                    </span>
                                </div>
                            </div>
                            <!-- <div class="sizes">
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
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Menu -->
                <div class="menu-side">
                    <div class="account">
                        <div style="display: flex; gap: 10px">
                            <div class="avatar">
                                <img
                                    :src="`/storage/users/${user.pic}`"
                                    v-if="user.pic !== ''"
                                />
                                <img :src="`/images/default.jpg`" v-else />
                            </div>
                            <div class="name">
                                <span
                                    class="job-title"
                                    v-if="user.role == 'employee'"
                                >
                                    {{ $t("im-a-cashier") }}
                                </span>
                                <span
                                    class="job-title"
                                    v-else-if="user.role == 'admin'"
                                >
                                    {{ $t("im-a-manager") }}
                                </span>
                                <span class="fullname">
                                    {{ user.full_name }}
                                </span>
                            </div>
                        </div>
                        <router-link to="/notifications">
                            <div class="notification">
                                <div class="badge"></div>
                                <img
                                    src="icons/icons8-notification.svg"
                                    style="max-width: 27px"
                                />
                            </div>
                        </router-link>
                    </div>
                    <div class="bills">
                        <h3>{{ $t("bills") }}</h3>
                        <div class="cards">
                            <div
                                class="card"
                                v-for="bill in filterBills"
                                :key="bill.id"
                            >
                                <div class="image">
                                    <img
                                        src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1649426020~exp=1649426620~hmac=59e916bf81f9ca2cb088c705860504d5bd225d98aae8e957936477c1cf2bba67&w=740"
                                    />
                                </div>
                                <div
                                    class="info"
                                    v-for="billInfo of bill"
                                    :key="billInfo.id"
                                >
                                    <span class="title">
                                        {{ billInfo.product_name }}
                                        <button
                                            @click="deleteBill(billInfo.id)"
                                        >
                                            <img
                                                src="/icons/icons8-remove.svg"
                                                style="max-width: 20px"
                                            />
                                        </button>
                                    </span>
                                    <div class="quantity">
                                        <span class="number">
                                            <input
                                                type="number"
                                                value="1"
                                                min="1"
                                                style="
                                                    border: none;
                                                    padding: 3px;
                                                    max-width: auto;
                                                    outline: none;
                                                "
                                            />
                                        </span>
                                        <span class="price">
                                            ${{ billInfo.price * 1 }}
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
                                <span class="title">{{ $t("subtotal") }}</span>
                                <span class="price">
                                    ${{ parseInt(subTotal) }}
                                </span>
                            </div>
                            <div class="tax">
                                <span class="title">{{ $t("tax") }} (14%)</span>
                                <span class="price">
                                    ${{ parseInt(subTotal + subTotal * 0.14) }}
                                </span>
                            </div>
                            <div class="total">
                                <span class="title">{{ $t("total") }}</span>
                                <span class="price">
                                    ${{ parseInt(subTotal + subTotal * 0.14) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="payment">
                        <h3>{{ $t("payment-method") }}</h3>
                        <div class="cards">
                            <div
                                class="card"
                                @click="payment(1)"
                                v-bind:class="{ active: this.method == 1 }"
                            >
                                <div class="icon">
                                    <img src="icons/icons8-money.svg" />
                                </div>
                                <div class="title">{{ $t("cash") }}</div>
                            </div>
                            <div
                                class="card"
                                @click="payment(2)"
                                v-bind:class="{ active: this.method == 2 }"
                            >
                                <div class="icon">
                                    <img src="icons/icons8-debit-card.svg" />
                                </div>
                                <div class="title">{{ $t("credit-card") }}</div>
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
                                <div class="title">{{ $t("e-wallet") }}</div>
                            </div>
                        </div>
                    </div>
                    <button class="print-bill">{{ $t("print-bill") }}</button>
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
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            method: null,
            selectedCat: null,
            subTotal: 0,
            items: [],
            products: [],
            filterProducts: [],
            bill: null,
            filterBills: [],
            settings: {
                itemsToShow: 1,
                snapAlign: "start",
            },
            breakpoints: {
                700: {
                    itemsToShow: 4,
                    snapAlign: "start",
                },
                1024: {
                    itemsToShow: 6,
                    snapAlign: "start",
                },
            },
        };
    },
    mounted() {
        axios
            .get("/api/categories")
            .then((result) => (this.items = result.data))
            .catch((err) => console.log(err));
        axios
            .get("/api/products")
            .then((result) => (this.products = result.data))
            .catch((err) => console.log(err));
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
                    (p) => parseInt(p.category) === this.selectedCat
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
            this.subTotal = this.filterBills.reduce(
                (accumulator, current) => accumulator + current[0].price,
                0
            );
        },
        deleteBill(billId) {
            this.filterBills.map((item, index) => {
                if (item[0].id === billId) {
                    this.subTotal = this.subTotal - item[0].price;
                    this.filterBills.splice(index, 1);
                }
            });
        },
    },
};
</script>
<style lang="scss" scoped>
.app-ar {
}
.carousel {
    max-width: 750px;
    @media screen and (min-width: 1024px) {
        max-width: 100%;
        width: 100%;
    }
}
</style>
