<template>
    <div>


        <form class="flex" v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <label class="relative" for="photoupload">
                <div class="absolute top-0 left-0 z-20 text-white ml-12 mt-12">
                    <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <img class="rounded-full z-10 w-32" :src="avatar" :alt="user.name">
            </label>
            <image-upload id="photoupload" name="avatar" @loaded="onLoad"></image-upload>
        </form>




    </div>
</template>

<script>
import ImageUpload from "./ImageUpload";

export default {

    props: ['user'],

    components: {ImageUpload},

    data() {
        return {
            avatar: '/storage/' + this.user.avatar_path
        }
    },

    computed: {
        canUpdate() {
            return this.authorize(user => user.id === this.user.id)
        }
    },

    methods: {
        onLoad(avatar) {
            this.avatar = avatar.src;
            this.persist(avatar.file);

        },

        persist(avatar) {
            let data = new FormData();

            data.append('avatar', avatar);

            axios.post('/api/users/${this.user.name}/avatar', data)
                .then(() => flash('Изображение загружено'));
        }
    }
}
</script>

<style scoped>

</style>
