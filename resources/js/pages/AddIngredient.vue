<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="add-ingredient-page">
            <Sidebar />
            <div class="side">
                <div class="container" style="gap: 0">
                    <div class="header">
                        <h3>{{ $t("add-ingredient") }}</h3>
                        <router-link to="/calculator">
                            <font-awesome-icon :icon="['fas', 'angle-left']" />
                            {{ $t("ingredients-calculator") }}
                        </router-link>
                    </div>
                    <form @submit.prevent="addIngredient">
                        <div class="input-group">
                            <label for="product">
                                {{ $t("product") }}
                            </label>
                            <select id="product" v-model="form.product">
                                <option
                                    v-for="product in products"
                                    :key="product.id"
                                    :value="product.id"
                                >
                                    {{ product.product_name }}
                                </option>
                            </select>
                        </div>
                        <div class="group" v-for="n in countInputs" :key="n">
                            <div class="input-group" style="width: 100%">
                                <label :for="`ingredient-${n}`">
                                    {{ $t("ingredient") }} {{ n }}
                                </label>
                                <input
                                    :id="`ingredient-${n}`"
                                    v-model="ings['ingredient_' + n]"
                                />
                            </div>
                            <div class="input-group" style="width: 100%">
                                <label :for="`ingredient-qt-${n}`">
                                    {{ $t("quantity") }} ({{ $t("gram") }}) /
                                    {{ $t("unit") }}
                                </label>
                                <input
                                    type="number"
                                    :id="`ingredient-qt-${n}`"
                                    step="0.001"
                                    v-model="
                                        ings['ingredient_' + n + '_quantity']
                                    "
                                />
                            </div>
                        </div>
                        <button
                            type="button"
                            style="
                                display: flex;
                                width: 30px;
                                height: 30px;
                                align-items: center;
                                justify-content: center;
                                background: #336699;
                                padding: 6px 6px;
                                border-radius: 50%;
                            "
                            @click="countInputs += 1"
                            v-if="countInputs < 5"
                        >
                            <img
                                src="/icons/icons8-plus-math.svg"
                                style="max-width: 15px"
                            />
                        </button>
                        <input
                            type="submit"
                            class="save"
                            :value="$t('add-ingredient')"
                        />
                    </form>
                    <vue-good-table
                        :columns="columns"
                        :rows="rows"
                        :pagination-options="{
                            enabled: true,
                            perPage: 15,
                            perPageDropdownEnabled: false,
                            nextLabel: 'next',
                            prevLabel: 'prev',
                        }"
                        :search-options="{
                            enabled: false,
                        }"
                        style="margin-top: 3%; direction: ltr"
                    >
                        <template #table-row="props">
                            <span v-if="props.column.field == 'option'">
                                <div class="action-btns">
                                    <button
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 5px;
                                            background: #ef5350;
                                            padding: 0 10px;
                                            border-radius: 3px;
                                            color: white;
                                            font-size: 13px;
                                        "
                                        @click="deleteIngredient(props.row.id)"
                                    >
                                        <font-awesome-icon
                                            :icon="['fas', 'trash']"
                                        />
                                        {{ $t("delete") }}
                                    </button>
                                </div>
                            </span>
                            <span v-else>
                                {{ props.formattedRow[props.column.field] }}
                            </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import axios from "axios";
import { VueGoodTable } from "vue-good-table-next";
import "vue-good-table-next/dist/vue-good-table-next.css";
export default {
    components: {
        Sidebar,
        VueGoodTable,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            countInputs: 1,
            products: [],
            ings: {
                ingredient_1: "",
                ingredient_1_quantity: null,
                ingredient_2: "",
                ingredient_2_quantity: null,
                ingredient_3: "",
                ingredient_3_quantity: null,
                ingredient_4: "",
                ingredient_4_quantity: null,
                ingredient_5: "",
                ingredient_5_quantity: null,
            },
            form: {
                product: null,
                ingredients: [],
            },
            columns: [
                {
                    label: this.$t("id"),
                    field: "id",
                    hidden: true,
                },
                {
                    label: this.$t("product"),
                    field: "product.product_name",
                    sortable: false,
                },
                {
                    label: this.$t("option"),
                    field: "option",
                    sortable: false,
                },
            ],
            rows: [],
        };
    },
    async mounted() {
        await axios
            .post("/api/products", {}, { headers: { token: this.user.token } })
            .then((result) => (this.products = result.data))
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/all-ingredients",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => (this.rows = result.data))
            .catch((err) => console.log(err));
    },
    methods: {
        collect() {
            if (this.ings.ingredient_1 !== "") {
                this.form.ingredients.push([
                    {
                        ingredient: this.ings.ingredient_1,
                        qty: this.ings.ingredient_1_quantity,
                    },
                ]);
            }
            if (this.ings.ingredient_2 !== "") {
                this.form.ingredients.push([
                    {
                        ingredient: this.ings.ingredient_2,
                        qty: this.ings.ingredient_2_quantity,
                    },
                ]);
            }
            if (this.ings.ingredient_3 !== "") {
                this.form.ingredients.push([
                    {
                        ingredient: this.ings.ingredient_3,
                        qty: this.ings.ingredient_3_quantity,
                    },
                ]);
            }
            if (this.ings.ingredient_4 !== "") {
                this.form.ingredients.push([
                    {
                        ingredient: this.ings.ingredient_4,
                        qty: this.ings.ingredient_4_quantity,
                    },
                ]);
            }
            if (this.ings.ingredient_5 !== "") {
                this.form.ingredients.push([
                    {
                        ingredient: this.ings.ingredient_5,
                        qty: this.ings.ingredient_5_quantity,
                    },
                ]);
            }
        },
        addIngredient() {
            this.collect();
            axios
                .post(
                    "/api/add-ingredient",
                    {
                        product_id: this.form.product,
                        ingredients: this.form.ingredients,
                    },
                    {
                        headers: {
                            token: this.user.token,
                        },
                    }
                )
                .then((succ) => {
                    alert(this.$t("done"));
                    // this.$router.push("/branches");
                })
                .catch((err) => {
                    alert(this.$t("something-went-wrong"));
                });
        },
        deleteIngredient(id) {
            axios
                .post(
                    "/api/delete-ingredient",
                    {
                        id: id,
                    },
                    {
                        headers: {
                            token: this.user.token,
                        },
                    }
                )
                .then((succ) => {
                    alert(this.$t("done")), location.reload();
                })
                .catch((err) => {
                    alert(this.$t("something-went-wrong"));
                });
        },
    },
};
</script>
