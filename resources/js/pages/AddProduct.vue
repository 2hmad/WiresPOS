<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="addProduct">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("new-product") }}</h3>
                <form method="POST" @submit.prevent="addProduct">
                    <div class="input-group">
                        <label for="productname">
                            {{ $t("product-name") }}
                        </label>
                        <input
                            type="text"
                            :placeholder="$t('product-name')"
                            id="productname"
                            v-model="form.productName"
                        />
                    </div>
                    <div class="input-group">
                        <label for="details">{{ $t("product-details") }}</label>
                        <textarea
                            :placeholder="$t('product-details')"
                            id="details"
                            rows="7"
                            v-model="form.productDetails"
                        />
                    </div>
                    <div class="input-group">
                        <label for="price">{{ $t("price") }}</label>
                        <input
                            type="number"
                            step="0.1"
                            min="1"
                            :placeholder="$t('price')"
                            id="price"
                            v-model="form.productPrice"
                            autocomplete="off"
                        />
                    </div>
                    <div class="input-group">
                        <label for="code">{{ $t("code") }}</label>
                        <input
                            type="text"
                            id="code"
                            placeholder="Code"
                            v-model="form.code"
                        />
                    </div>
                    <div class="input-group">
                        <label for="thumbnail">{{ $t("image") }}</label>
                        <input
                            type="file"
                            id="thumbnail"
                            @change="onFileChange"
                        />
                    </div>
                    <input
                        type="submit"
                        class="save"
                        :value="$t('save-changes')"
                    />
                </form>
                <br />
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import SettingMenu from "../components/SettingMenu.vue";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            cats: [],
            form: {
                productName: "",
                productDetails: "",
                productPrice: null,
                category: this.$route.params.cat_id,
                code: "",
                store: JSON.parse(localStorage.getItem("wiresPOSUser")).store,
                thumbnail: null,
            },
        };
    },
    mounted() {
        this.form.code = new Date().getTime();
        axios
            .get("/api/categories")
            .then((result) => {
                this.cats = result.data;
            })
            .catch((err) => console.log(err));
    },
    methods: {
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.form.thumbnail = files[0];
        },
        addProduct() {
            const data = new FormData();
            data.append(
                "thumbnail",
                this.form.thumbnail,
                this.form.thumbnail.name
            );
            const details = JSON.stringify({
                productName: this.form.productName,
                productDetails: this.form.productDetails,
                productPrice: this.form.productPrice,
                category: this.form.category,
                code: this.form.code,
                store: this.form.store,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: this.user.token,
                },
            };
            axios
                .post("/api/add-product", data, config)
                .then((result) => {
                    alert("Done"), location.reload();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
