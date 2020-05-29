<template>
    <div>
        <div v-if="signedIn">

            <div class="flex flex-col">
                <textarea v-model="body"
                          class="mb-3 px-5 py-2"
                          placeholder="Have something to say?">
                </textarea>

                <div class="text-left  mb-3">
                    <button class="bg-green-500 px-3 py-1 text-white rounded" @click="addReply">Сохранить
                    </button>
                </div>
            </div>
        </div>


        <div v-else class="container mx-auto">
            <p class="text-center">Пожалуйста <a href="/login">авторизуйтесь</a> чтобы принять участие в
                беседе.</p>
        </div>


    </div>
</template>

<script>
    export default {

        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .catch(error =>{
                        // console.log('ERROR');
                        // console.log(error.response);
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {

                        this.body = '';

                        flash('Ваш комментарий опубликован');

                        this.$emit('created', data);

                    });
            }
        }
    }
</script>

<style scoped>

</style>
