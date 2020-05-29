<template>
<div class="fixed right-0 bottom-0 mr-3 mb-3" v-show="show">
    <div class="p-3 rounded" :class="'alert-' + level" v-text="body"></div>

</div>
</template>

<script>
    export default {

        props: ['message'],

        data() {
            return {
                body: '',
                level:'success',
                show:false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', data => {
                this.flash(data);
            });

        },

        methods: {
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            },

            flash(data) {
                this.body = data.message;
                this.level = data.level;
                this.show = true;

                this.hide();
            }
        }

    }
</script>

<style>
    .alert-success{
        background: #2f855a;
    }
    .alert-danger{
        background: red;
    }
</style>
