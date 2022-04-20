<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST">
                    <div class="input-group">
                        <label for="fullname">Full name</label>
                        <input
                            type="text"
                            placeholder="Full name"
                            id="fullname"
                        />
                    </div>
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            placeholder="Email Address"
                            id="email"
                        />
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            placeholder="Password"
                            id="password"
                        />
                    </div>
                    <div class="input-group">
                        <label for="conf-pass">Confirm Password</label>
                        <input
                            type="password"
                            placeholder="Confirm Password"
                            id="conf-pass"
                        />
                    </div>
                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input type="tel" placeholder="Phone" id="phone" />
                    </div>
                    <div class="input-group">
                        <label for="phone">Branch</label>
                        <select>
                            <option>Alexandria</option>
                            <option>Cairo</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="phone">Role</label>
                        <select>
                            <option>Admin</option>
                            <option>Employee</option>
                        </select>
                    </div>
                    <input type="submit" class="save" value="Add User" />
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
};
</script>
