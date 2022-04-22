<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="addProduct">
            <Sidebar />
            <div class="side">
                <h3>Add Product</h3>
                <form method="POST">
                    <div class="input-group">
                        <label for="productname">Product name</label>
                        <input
                            type="text"
                            placeholder="Product name"
                            id="productname"
                        />
                    </div>
                    <div class="input-group">
                        <label for="details">Product Details</label>
                        <textarea placeholder="Details" id="details" rows="7" />
                    </div>
                    <div class="input-group">
                        <label for="price">Price</label>
                        <input
                            type="number"
                            step="0.1"
                            placeholder="Price"
                            id="price"
                        />
                    </div>
                    <div class="input-group">
                        <label>Sizes</label>
                        <div class="cards">
                            <button
                                type="button"
                                class="size"
                                @click="activeSize"
                            >
                                S
                            </button>
                            <button
                                type="button"
                                class="size"
                                @click="activeSize"
                            >
                                M
                            </button>
                            <button
                                type="button"
                                class="size"
                                @click="activeSize"
                            >
                                L
                            </button>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="cat">Category</label>
                        <select id="cat"></select>
                    </div>
                    <div class="input-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" id="thumbnail" />
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
        return {};
    },
    methods: {
        activeSize(event) {
            event.target.classList.toggle("active");
        },
    },
};
</script>
