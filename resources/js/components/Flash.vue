<template>
<div class="fixed right-0 bottom-0 mr-3 mb-3" v-show="show">
    <div class="p-3 bg-green-300 rounded ">
        {{ body }}
    </div>

</div>
</template>

<script>
    export default {

        props: ['message'],

        data() {
            return {
                body: '',
                show:false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', message => {
                this.flash(message);
            });

        },

        methods: {
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            },

            flash(message) {
                this.body = message;
                this.show = true;

                this.hide();
            }
        }

    }
</script>
