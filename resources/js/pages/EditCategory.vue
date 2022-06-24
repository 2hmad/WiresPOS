<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="addProduct">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("edit-category") }}</h3>
                <form method="POST" @submit.prevent="editCategory">
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
                id: this.$route.params.id,
                category_name: "",
            },
        };
    },
    async mounted() {
        await axios.get(`/api/get-category/${this.form.id}`).then((res) => {
            this.form.category_name = res.data.category_name;
        });
    },
    methods: {
        editCategory() {
            axios
                .post("/api/edit-category", this.form, {
                    headers: {
                        token: this.user.token,
                    },
                })
                .then((result) => {
                    alert(this.$t("operation-successful")), location.reload();
                })
                .catch((err) => {
                    alert(this.$t("something-went-wrong"));
                });
        },
    },
};
</script>
