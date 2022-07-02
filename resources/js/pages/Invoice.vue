<template>
    <div class="ticket">
        <img
            :src="`/storage/stores/${company.logo}`"
            v-if="company.logo !== null && company.logo !== ''"
        />
        <p class="centered">
            {{ company.store_name }}
        </p>
        <p class="centered">{{ company.address }}</p>
        <p class="centered">Tel: {{ company.phone }}</p>
        <div class="line" />
        <div class="side">
            <span>
                Date:
                {{ $luxonDateTime.fromISO(created_at).toFormat("y-LL-d") }}
            </span>
        </div>
        <div class="side">
            <span>
                Time:
                {{ $luxonDateTime.fromISO(created_at).toFormat("HH:mm:ss") }}
            </span>
        </div>
        <div class="side">
            <p>Order: {{ invoice_id }}</p>
        </div>
        <div class="side">
            <p>
                Taken by:
                <span v-if="payment == 1"> Cash </span>
                <span v-else-if="payment == 2"> Credit Card </span>
                <span v-else-if="payment == 3"> E-wallet </span>
            </p>
        </div>
        <div class="line" />
        <table>
            <tbody>
                <tr v-for="item in parseItems" :key="item.id">
                    <td class="description">
                        {{ item[0].product_name }} ({{ item[0].quantity }}x
                        {{ item[0].price }})
                    </td>
                    <td class="price">
                        {{ item[0].price * item[0].quantity }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="line" />
        <table>
            <tbody>
                <tr style="border-top: 1px solid #ccc">
                    <td style="font-weight: 500">Sub Total</td>
                    <td style="font-weight: 500">{{ subtotal }}</td>
                </tr>
                <tr v-if="settings.tax_rate > 0">
                    <td style="font-weight: 500">
                        * VAT ({{ settings.tax_rate }}%)
                    </td>
                    <td style="font-weight: 500">
                        {{ (subtotal * settings.tax_rate) / 100 }}
                    </td>
                </tr>
                <tr v-if="settings.service_rate > 0">
                    <td style="font-weight: 500">* Service</td>
                    <td style="font-weight: 500">
                        {{ (subtotal * settings.service_rate) / 100 }}
                    </td>
                </tr>
                <tr v-if="discount > 0">
                    <td style="font-weight: 500">Discount</td>
                    <td
                        style="font-weight: 500"
                        v-if="discount_type == 'percent'"
                    >
                        {{ (subtotal * discount) / 100 }}
                    </td>
                    <td style="font-weight: 500" v-else>
                        {{ discount }}
                        <span v-if="discount_type == 'percent'">%</span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Balance due</td>
                    <td style="font-weight: bold">
                        <span v-if="discount_type == 'percent'">
                            {{ total - (total * discount) / 100 }}
                        </span>
                        <span v-else>
                            {{ total - discount }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="centered">
            Thank you for visit <br />
            <span v-if="company.website !== null">
                {{ company.website }}
            </span>
            <qrcode-vue
                :value="`Seller name: ${company.store_name}
Invoice number: ${invoice_id}
Date: ${$luxonDateTime
                    .fromISO(created_at)
                    .toFormat('y-LL-d')}, Time: ${$luxonDateTime
                    .fromISO(created_at)
                    .toFormat('HH:mm:ss')}
Invoice total amount: ${total}
Invoice tax amount: ${settings.tax_rate}`"
                size="100"
                style="display: block; margin: 0 auto"
            />
            <span
                v-if="company.plan == 'free'"
                style="
                    font-size: 12px;
                    display: block;
                    line-height: 1.1;
                    font-weight: 100;
                    margin-top: 4%;
                "
            >
                Powered by:<br />WiresPOS System
            </span>
        </p>
    </div>
</template>
<script>
import axios from "axios";
import QrcodeVue from "qrcode.vue";
export default {
    components: {
        QrcodeVue,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            invoice_id: this.$route.params.id,
            items: null,
            subtotal: null,
            payment: null,
            created_at: "",
            discount: null,
            discount_type: "",
            company: [],
            settings: [],
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-settings",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => {
                this.settings = result.data;
            })
            .catch((err) => {
                console.log(err);
            });
        axios
            .post(
                `/api/invoice`,
                {
                    id: this.invoice_id,
                },
                {
                    headers: {
                        token: this.user.token,
                    },
                }
            )
            .then((res) => {
                (this.items = res.data.items),
                    (this.subtotal = res.data.subtotal),
                    (this.payment = res.data.payment),
                    (this.created_at = res.data.created_at),
                    (this.discount = res.data.discount),
                    (this.discount_type = res.data.discount_type),
                    (this.company = res.data.store);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    computed: {
        parseItems() {
            return JSON.parse(this.items);
        },
        total() {
            return (
                parseInt(this.subtotal) +
                parseInt(this.subtotal * this.settings.tax_rate) / 100 +
                parseInt((this.subtotal * this.settings.service_rate) / 100)
            );
        },
    },
};
</script>
