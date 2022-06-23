<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="addProduct">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("new-category") }}</h3>
                <form method="POST" @submit.prevent="addProduct">
                    <div class="input-group">
                        <label for="productname">
                            {{ $t("category-name") }}
                        </label>
                        <input
                            type="text"
                            :placeholder="$t('category-name')"
                            id="productname"
                            v-model="form.category_name"
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
import axios from "axios";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            form: {
                category_name: "",
                image: null,
            },
        };
    },

    methods: {
        onFileChange(e) {
            this.form.image = e.target.files[0];
        },
        addProduct() {
            const data = new FormData();
            data.append("image", this.form.image, this.form.image.name);
            const details = JSON.stringify({
                category_name: this.form.category_name,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: this.user.token,
                },
            };
            axios
                .post("/api/add-category", data, config)
                .then((result) => {
                    alert(this.$t("operation-successful")), location.reload();
                })
                .catch((err) => {
                    alert(this.$t("added-before"));
                });
        },
    },
};
</script>
