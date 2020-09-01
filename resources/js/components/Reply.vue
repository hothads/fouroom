<template>
    <div :id="'reply-'+ id " class="is-best-reply"
         :class="isBest ? 'bg-blue-400' : 'bg-point'">

        <div class="forum-header">

            <div class="flex items-center w-full">

                <div class="flex items-center w-full">
                    <a class="mr-4 flex-shrink-0" :href="'/profiles/' + reply.owner.name">
                        <img class="rounded-full shadow" :src="'/storage/' + avatar" alt="" width="50">
                    </a>

                    <div class="text-sm">
                        <div class="font-bold text-white">
                            <a :href="'/profiles/' + reply.owner.name" v-text="reply.owner.name"></a></div>
                        <div class="text-white" v-text="ago"></div>
                    </div>

                    <div class="flex items-center mx-6"
                         v-if="authorize('updateReply', reply)">
<!--                        v-if="authorize('updateReply', reply) || authorize('updateThread', reply.thread)">-->

                        <!--edit button-->
                        <button class="flex items-center text-white mr-3" @click="editing = true" v-if="!editing">
                            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>

                        <!--best reply button-->
                        <button
                            class="flex text-white items-center"
                            v-if="authorize('updateThread', reply.thread)"
                            v-show="!isBest"
                            @click="markBestReply">
                            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </button>


                    </div>


                    <div v-if="isBest"
                         class="flex ml-auto mr-6 border-point border-2 flex-grow-0 px-6 py-1 text-sm text-point bg-white text-red font-bold rounded-full">
                        Лучший ответ
                    </div>


                </div>


            </div>

            <div class="flex" v-if="signedIn">

                <favorite :reply="reply"></favorite>

            </div>
        </div>


        <div class="forum-body">
            <div class="w-full" v-if="editing">
                <form @submit="update">

                    <textarea
                        class="w-full rounded border border-gray-300 p-3"
                        v-model="body" required>
                    </textarea>

                    <div class="mt-2">
                        <button type="submit" class="text-xs rounded bg-blue-700 text-white px-2 py-1 mr-2">Обновить
                        </button>
                        <button class="text-xs  text-gray-700 px-2 py-1 mr-2" @click="editing=false" type="button">
                            Отменить
                        </button>
                        <button class="button-red-sm" @click="destroy">Удалить комментарий
                        </button>
                    </div>
                </form>
            </div>
            <article v-else v-html="body"></article>
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
            avatar: this.reply.owner.avatar_path,
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
            axios.post('/replies/' + this.id + '/best');
            window.events.$emit('best-reply-selected', this.id);
        }
    }
}
</script>
