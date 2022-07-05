<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="calc-page">
            <Sidebar />
            <div class="side">
                <div class="heading">
                    <div style="width: 100%">
                        <h3>{{ $t("ingredients-calculator") }}</h3>
                        <p>
                            {{ $t("calculate-your-products-ingredients") }}
                        </p>
                    </div>
                    <div>
                        <router-link to="/add-ingredient">
                            <button class="add">
                                <img src="/icons/icons8-plus-math.svg" />
                                {{ $t("add-ingredient") }}
                            </button>
                        </router-link>
                    </div>
                </div>
                <div class="container" style="gap: 0">
                    <div class="header">
                        <h3>{{ $t("ingredients-calculator") }}</h3>
                    </div>
                    <form method="POST" @submit.prevent>
                        <div class="input-group">
                            <label for="product">
                                {{ $t("product") }}
                            </label>
                            <select
                                id="product"
                                v-model="form.product"
                                @change="getIngredient(form.product)"
                            >
                                <option
                                    v-for="product in products"
                                    :key="product.id"
                                    :value="product.product.id"
                                >
                                    {{ product.product.product_name }}
                                </option>
                            </select>
                        </div>
                        <div v-if="productDetails !== null">
                            <div
                                v-for="(detail, index) in JSON.parse(
                                    productDetails.ingredients
                                )"
                                :key="index"
                            >
                                <div class="input-group" style="width: 100%">
                                    <label :for="`ingredient-qt-${index}`">
                                        {{ detail[0].ingredient }}
                                    </label>
                                    <input
                                        type="number"
                                        :id="`ingredient-qt`"
                                        step="0.001"
                                        :placeholder="
                                            $t('quantity') +
                                            ' (' +
                                            $t('gram') +
                                            ')'
                                        "
                                        v-model="
                                            inputs[`${detail[0].ingredient}`]
                                        "
                                    />
                                </div>
                            </div>
                        </div>
                        <input
                            type="submit"
                            class="save"
                            :value="$t('add-ingredient')"
                            v-if="productDetails !== null"
                            @click="calculate"
                        />
                        <div v-if="machineResult !== null">
                            <h3 style="text-align: center">
                                الكمية المنتجة :
                                <span>
                                    {{ machineResult.count }}
                                    {{ $t("unit") }}
                                </span>
                            </h3>
                            <hr />
                            <span style="text-align: center; display: block">
                                المتبقي في المخزون
                            </span>
                            <table
                                style="
                                    width: 100%;
                                    position: relative;
                                    border-collapse: collapse;
                                    text-align: center;
                                "
                            >
                                <tr>
                                    <th
                                        style="border: 1px solid #999"
                                        v-for="(
                                            count, index
                                        ) in machineResult.overflow"
                                        :key="index"
                                    >
                                        {{ index }}
                                    </th>
                                </tr>
                                <tr>
                                    <td
                                        style="border: 1px solid #999"
                                        v-for="count in machineResult.overflow"
                                        :key="count"
                                    >
                                        {{ count }} {{ $t("gram") }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import Sidebar from "../components/Sidebar.vue";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            products: [],
            productDetails: null,
            machineResult: null,
            inputs: {},
            form: {
                product: null,
            },
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/all-ingredients",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => (this.products = result.data))
            .catch((err) => console.log(err));
    },
    methods: {
        getIngredient(id) {
            axios
                .post(
                    "/api/ingredient",
                    { product_id: id },
                    { headers: { token: this.user.token } }
                )
                .then((result) => (this.productDetails = result.data))
                .catch((err) => console.log(err));
        },
        calculate() {
            var details = this.productDetails["ingredients"];
            const coffeeingrediants = {};
            JSON.parse(details).forEach((element) => {
                var e1 = element[0];
                coffeeingrediants[e1.ingredient] = e1.qty;
            });
            const coffeeStock = this.inputs;
            this.machineResult = this.machine({
                ingrediants: coffeeingrediants,
                stock: coffeeStock,
            });
        },
        machine({ ingrediants, stock }) {
            let outputs = {};
            let overflow = {};

            Object.keys(stock).forEach((stockKey) => {
                const ingrediantAmount = ingrediants[stockKey];
                const ingrediantInStockAmount = stock[stockKey];
                outputs[stockKey] = ingrediantInStockAmount / ingrediantAmount;
            });

            const minOutput = Math.min(...Object.values(outputs));
            Object.keys(stock).forEach((stockKey) => {
                overflow[stockKey] =
                    (outputs[stockKey] - minOutput) * ingrediants[stockKey];
            });
            return { overflow, count: minOutput };
        },
    },
};
</script>
