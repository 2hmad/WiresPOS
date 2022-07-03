<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div
                class="modal"
                role="dialog"
                aria-labelledby="modalTitle"
                aria-describedby="modalDescription"
            >
                <header class="modal-header" id="modalTitle">
                    <slot name="header"> </slot>
                    <button
                        type="button"
                        class="btn-close"
                        @click="close"
                        aria-label="Close modal"
                    >
                        x
                    </button>
                </header>

                <section class="modal-body" id="modalDescription">
                    <slot name="body"> This is the default body! </slot>
                </section>

                <footer class="modal-footer">
                    <button
                        type="button"
                        class="btn-green"
                        @click="close"
                        aria-label="Close modal"
                    >
                        {{ $t("save-changes") }}
                    </button>
                </footer>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    data() {
        return {
            // showModal: false,
            discount: null,
        };
    },
    methods: {
        close() {
            this.$emit("close");
        },
    },
};
</script>
<style>
.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99;
}

.modal {
    background: #ffffff;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    width: 350px;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: #336699;
    justify-content: space-between;
    direction: ltr;
}

.modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: column;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
    display: flex;
    gap: 5px;
}
.modal-body select {
    border: 1px solid #ccc;
    padding: 5px;
    outline: none;
    border-radius: 3px;
    text-transform: uppercase;
}
.modal-body .amount {
    width: 100%;
    padding: 6px;
    border-radius: 3px;
    border: 1px solid #ccc;
    outline: none;
}
.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: #336699;
    background: transparent;
}

.btn-green {
    color: white;
    background: #336699;
    border: 1px solid #336699;
    border-radius: 2px;
    padding: 5px;
}

.modal-fade-enter,
.modal-fade-leave-to {
    opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.5s ease;
}
</style>
