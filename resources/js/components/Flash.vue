<template>
<div class="fixed right-0 bottom-0 mr-3 mb-3" v-show="show">
    <div class="p-3 rounded"
         :class="'alert-' + level"
         v-text="body">
    </div>

</div>
</template>

<script>
export default {
    props: ['message'],

    data() {
        return {
            body: this.message,
            level: 'success',
            show: false
        }
    },

    created() {
        if (this.message) {
            this.flash();
        }

        window.events.$on(
            'flash', data => this.flash(data)
        );
    },

    methods: {
        flash(data) {
            if (data) {
                this.body = data.message;
                this.level = data.level;
            }

            this.show = true;

            this.hide();
        },

        hide() {
            setTimeout(() => {
                this.show = false;
            }, 3000);
        }
    }
};
</script>



<style>
    .alert-success{
        background: #acffd5;
        color:#2f855a;
        font-weight: bold;
    }
    .alert-danger{
        background: red;
        color:white;
        font-weight: bold;
    }
</style>
