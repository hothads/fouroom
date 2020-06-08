<template>
    <div :id="'reply-'+ id " class="forum-card">

        <div class="forum-header">
            <h2>
                <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name"></a>
                said <span v-text="ago"></span>
            </h2>
            <div v-if="signedIn">
                <favorite :reply="data"></favorite>
            </div>
        </div>


        <div class="forum-body">
            <div class="w-full" v-if="editing">
                <textarea class="w-full rounded border border-gray-300 p-3" v-model="body"></textarea>
                <div class="mt-2">
                    <button class="text-xs rounded bg-blue-700 text-white px-2 py-1 mr-2" @click="update">Обновить
                    </button>
                    <button class="text-xs  text-gray-700 px-2 py-1 mr-2" @click="editing=false">Отменить</button>
                </div>
            </div>

            <article v-else v-text="body"></article>
        </div>

        <div class="bg-gray-300 p-3 flex" v-if="canUpdate">

            <button class="text-xs rounded bg-gray-700 text-white px-2 py-1 mr-2" @click="editing = true">Редактировать
                комментарий
            </button>
            <button class="text-xs rounded bg-red-700 text-white px-2 py-1 mr-2" @click="destroy">Удалить комментарий
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

        props: ['data'],

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        computed: {
            ago() {
                return moment(this.data.created_at).fromNow();
            },

            signedIn() {
                return window.App.signedIn
            },

            canUpdate() {
               return  this.authorize(user => this.data.user_id == user.id);
                // return this.data.user_id == window.App.user.id
            }
        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.data.id, {
                        body: this.body
                    })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })

                this.editing = false;

                flash('Комментарий обновлен');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);

                // $(this.$el).fadeOut(300, () => {
                //     flash('Комментарий Удален');
                // });

            }
        }
    }
</script>
