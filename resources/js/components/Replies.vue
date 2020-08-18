<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply = "reply" @deleted="remove(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <p v-if="$parent.locked">Данный пост закрыт, вы больше не можете добавлять комментарии</p>

        <new-reply @created="add" v-else></new-reply>
    </div>
</template>

<script>

    import Reply from "./Reply";
    import NewReply from "./NewReply";
    import collection from "../mixins/collection";

    export default {

        components:{NewReply, Reply },

        mixins: [collection],

        data() {
            return {
                dataSet:false,
            }
        },

        created() {
            this.fetch();
        },

        methods: {

            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            url(page) {
                if (! page) {
                   let query = location.search.match(/page=(\d+)/);
                   page = query ? query[1] : 1;
                }
                return location.pathname + '/replies?page=' + page;
                // return '${location.pathname}/replies';
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0,0);
            }
        }
    }
</script>

<style scoped>

</style>
