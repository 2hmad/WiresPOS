<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="pic-change">
                        <label for="change">
                            <img
                                src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1649426020~exp=1649426620~hmac=59e916bf81f9ca2cb088c705860504d5bd225d98aae8e957936477c1cf2bba67&w=740"
                            />
                        </label>
                        <input type="file" id="change" />
                    </div>
                    <div class="input-group">
                        <label for="fullname">Full name</label>
                        <input
                            type="text"
                            placeholder="Full name"
                            id="fullname"
                            v-model="form.fullName"
                        />
                    </div>
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            placeholder="Email Address"
                            id="email"
                            v-model="form.email"
                        />
                    </div>
                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input
                            type="tel"
                            placeholder="Phone"
                            id="phone"
                            v-model="form.phone"
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
import store from "../store/";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            form: {
                fullName: "",
                email: "",
                phone: "",
            },
        };
    },
    mounted() {
        this.form.fullName = this.user.full_name;
        this.form.email = this.user.email;
        this.form.phone = this.user.phone;
    },
};
</script>
