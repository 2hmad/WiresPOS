<template>
    <div class="ticket">
        <img src="https://digitwires.com/logo-full.svg" alt="Logo" />
        <p class="centered">
            Digitwires Restaurant<br />
            Welcome<br />
            To<br />
            Digitwires Cafe and Restaurant
        </p>
        <div class="sides">
            <div class="side"><span>Table: </span><input type="text" /></div>
            <div class="side"><span>Guests: </span><input type="text" /></div>
        </div>
        <div class="sides">
            <div class="side"><span>Date: </span><input type="text" /></div>
            <div class="side"><span>Shift: </span><input type="text" /></div>
        </div>
        <p>Order no.:</p>
        <span class="count"></span>
        <p>Shift:</p>
        <table>
            <thead>
                <tr>
                    <th class="quantity">Q.</th>
                    <th class="description">Description</th>
                    <th class="price">$$</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="quantity">1.00</td>
                    <td class="description">ARDUINO UNO R3</td>
                    <td class="price">$25.00</td>
                </tr>
                <tr>
                    <td class="quantity">2.00</td>
                    <td class="description">JAVASCRIPT BOOK</td>
                    <td class="price">$10.00</td>
                </tr>
                <tr>
                    <td class="quantity">1.00</td>
                    <td class="description">STICKER PACK</td>
                    <td class="price">$10.00</td>
                </tr>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">TOTAL</td>
                    <td class="price">$55.00</td>
                </tr>
            </tbody>
        </table>
        <p class="centered">
            Thanks for your purchase! <br />parzibyte.me/blog
        </p>
    </div>
    <ul>
        <li v-for="(item, index) in parseItems" :key="index">
            {{ item[index].id }}
        </li>
    </ul>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            invoice_id: this.$route.params.id,
            items: null,
            subtotal: null,
            payment: null,
            created_at: "",
        };
    },
    async mounted() {
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
                    (this.created_at = res.data.created_at);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    computed: {
        parseItems() {
            return JSON.parse(this.items);
        },
    },
};
</script>
