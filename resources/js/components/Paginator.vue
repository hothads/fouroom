<template>
<ul class="flex my-6" v-if="shouldPaginate">
    <li v-show="prevUrl"
        class="cursor-pointer  mr-1 border border-gray-400 rounded-l pb-1 px-3 items-center bg-blue-500 hover:bg-blue-200"
        @click.prevent="page--">
        <a class=" text-white hover:text-white" rel="previous" >&laquo;</a>
    </li>
    <li v-show="nextUrl"
        class="cursor-pointer border border-gray-400 rounded-r pb-1 px-3 items-center bg-blue-500 hover:bg-blue-200"
        @click.prevent="page++">
        <a class=" text-white hover:text-white" rel="next" >&raquo;</a>
    </li>
</ul>
</template>

<script>
    export default {

        props: ['dataSet'],

        data() {
            return {
                page: 1,
                prevUrl:false,
                nextUrl:false,
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);

            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>
