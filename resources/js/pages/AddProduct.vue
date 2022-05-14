<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="addProduct">
            <Sidebar />
            <div class="side">
                <h3>Add Product</h3>
                <form method="POST" @submit.prevent="addProduct">
                    <div class="input-group">
                        <label for="productname">Product name</label>
                        <input
                            type="text"
                            placeholder="Product name"
                            id="productname"
                            v-model="form.productName"
                        />
                    </div>
                    <div class="input-group">
                        <label for="details">Product Details</label>
                        <textarea
                            placeholder="Details"
                            id="details"
                            rows="7"
                            v-model="form.productDetails"
                        />
                    </div>
                    <div class="input-group">
                        <label for="price">Price</label>
                        <input
                            type="number"
                            step="0.1"
                            min="1"
                            placeholder="Price"
                            id="price"
                            v-model="form.productPrice"
                            autocomplete="off"
                        />
                    </div>
                    <div class="input-group">
                        <label for="cat">Category</label>
                        <select id="cat" v-model="form.category">
                            <option
                                v-for="cat in cats"
                                :key="cat.id"
                                :value="cat.id"
                            >
                                {{ cat.category_name }}
                            </option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="code">Code</label>
                        <input
                            type="text"
                            id="code"
                            placeholder="Code"
                            v-model="form.code"
                        />
                    </div>
                    <div class="input-group">
                        <label for="thumbnail">Image</label>
                        <input
                            type="file"
                            id="thumbnail"
                            @change="onFileChange"
                        />
                    </div>
                    <input type="submit" class="save" value="Save Changes" />
                </form>
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
            cats: [],
            form: {
                productName: "",
                productDetails: "",
                productPrice: null,
                category: null,
                code: "",
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
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
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
