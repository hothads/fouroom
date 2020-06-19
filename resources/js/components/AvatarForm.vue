<template>
<div>

    <h1 v-text="user.name"></h1>
    <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
        <image-upload name="avatar" @loaded="onLoad"></image-upload>
    </form>

    <img :src="avatar" :alt="user.name" width="50">
</div>
</template>

<script>
    import ImageUpload from "./ImageUpload";
    export default {

        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: '/storage/'+this.user.avatar_path
            }
        },

        computed: {
            canUpdate(){
                return this.authorize(user => user.id === this.user.id)
            }
        },

        methods: {
            onLoad(avatar){
                this.avatar = avatar.src;
                this.persist(avatar.file);

            },

            persist(avatar){
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post('/api/users/${this.user.name}/avatar', data)
                    .then(()=>flash('Изображение загружено'));
            }
        }
    }
</script>

<style scoped>

</style>
