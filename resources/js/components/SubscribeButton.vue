<template>

    <button @click="subscribe" class="border rounded-sm px-3 py-2 my-4 hover:bg-gray-300" v-text="isActive ? 'Отписаться' : 'Подписаться'"></button>

</template>

<script>
    export default {

        props:['active'],

        data() {
            return{
                isActive: this.active
            }
        },

        methods:{
            subscribe(){
                axios[this.isActive ? 'delete' : 'post'](location.pathname + '/subscriptions');
                this.isActive = ! this.isActive; // inverse active true to false

            }
        }
    }
</script>

<style scoped>

</style>
