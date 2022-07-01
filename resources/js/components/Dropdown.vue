<template>
    <div class="dropdown">
        <button class="dropbtn" @click="toggle">
            <slot name="text">Dropdown</slot>
        </button>
        <div
            id="myDropdown"
            class="dropdown-content"
            style="display: block"
            v-if="show"
        >
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            show: false,
        };
    },
    methods: {
        toggle() {
            this.show = !this.show;
        },
    },
};
</script>
<style lang="scss">
.dropdown {
    .dropbtn {
        color: black;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }
}
</style>
