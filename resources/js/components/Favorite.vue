<template>

    <button type="submit" :class="classes"  class="flex items-center text-white">

        <svg @click="toggle" class="w-4 fill-current mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M11 0h1v3l3 7v8a2 2 0 01-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 012-2h7V2a2 2 0 012-2zm6 10h3v10h-3V10z"/>
        </svg>

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
                return [this.active ? 'text-blue-200' : ''];
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
