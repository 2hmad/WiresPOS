<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="history">
            <Sidebar />
            <div class="side">
                <!-- <h3>Payments</h3>
                <div class="row">
                    <div class="card">
                        <div class="title">Total recieved</div>
                        <div class="amount">
                            <span class="currency">$</span>
                            <span class="number">84,254</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="title">today recieved</div>
                        <div class="amount">
                            <span class="currency">$</span>
                            <span class="number">200,00</span>
                        </div>
                    </div>
                </div> -->
                <div class="invoices">
                    <div class="heading">
                        <div style="width: 100%">
                            <h3>Invoices</h3>
                            <p>List of all of your recent transactions.</p>
                        </div>
                        <div>
                            <router-link to="/menu">
                                <button class="add">
                                    <img src="/icons/icons8-plus-math.svg" />
                                    New Invoice
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {};
    },
};
</script>
