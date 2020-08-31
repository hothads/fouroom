<template>
    <div :id="'reply-'+ id " class="forum-card" :class="isBest ? 'bg-blue-100' : 'bg-white'">

        <div class="forum-header">
            <h2>
                <a :href="'/profiles/' + reply.owner.name" v-text="reply.owner.name"></a>
                said <span v-text="ago"></span>
            </h2>
            <div v-if="signedIn">
                <favorite :reply="reply"></favorite>
            </div>
        </div>


        <div class="forum-body">
            <div class="w-full" v-if="editing">
                <form @submit="update">
                    <textarea class="w-full rounded border border-gray-300 p-3" v-model="body" required></textarea>
                    <div class="mt-2">
                        <button type="submit" class="text-xs rounded bg-blue-700 text-white px-2 py-1 mr-2">Обновить
                        </button>
                        <button class="text-xs  text-gray-700 px-2 py-1 mr-2" @click="editing=false" type="button">Отменить</button>
                    </div>
                </form>
            </div>
            <article v-else v-html="body"></article>
        </div>


        <div class="flex px-3 pb-3 flex items-center justify-between"
             v-if="authorize('updateReply', reply) || authorize('updateThread', reply.thread)" >

           <div v-if="authorize('updateReply', reply)">
               <button class="button-black-sm mr-3" @click="editing = true">Редактировать
                   комментарий
               </button>
               <button class="button-red-sm" @click="destroy">Удалить комментарий
               </button>
           </div>

            <button
                class="button-blue-sm"
                v-if="authorize('updateThread', reply.thread)"
                v-show="!isBest"
                @click="markBestReply">Лучший ответ?
            </button>

        </div>

    </div>

</template>

<script>
    import Favorite from "./Favorite";
    import moment from 'moment';
    import 'moment/locale/ru';

    export default {

        components: {Favorite},

        props: ['reply'],

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            };
        },

        created() {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id)
            })
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow();
            },

        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.reply.id, {
                        body: this.body
                    })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })

                this.editing = false;

                flash('Комментарий обновлен');
            },

            destroy() {
                axios.delete('/replies/' + this.id);

                this.$emit('deleted', this.id);

                // $(this.$el).fadeOut(300, () => {
                //     flash('Комментарий Удален');
                // });

            },

            markBestReply() {
                axios.post('/replies/'+this.id+'/best');
                window.events.$emit('best-reply-selected', this.id);
            }
        }
    }
</script>
