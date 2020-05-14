<template>

    <button type="submit" :class="classes">
        <span v-text="count" @click="toggle"></span>
    </button>

</template>

<script>
    export default {

        props: ['reply'],

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return [this.active ? 'text-blue-700' : ''];
            }
        },

        methods: {
            toggle () {
                this.active ? this.destroy() : this.create();
            },

            create(){
                axios.post('/replies/' + this.reply.id + '/favorites');
                this.active = true;
                this.count++;
            },

            destroy(){
                axios.delete('/replies/' + this.reply.id + '/favorites');
                this.active = false;
                this.count--;
            }
        }

    }
</script>
