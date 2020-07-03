<template>

    <li v-if="notifications.length"><a href="">
        <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M4 8a6 6 0 014.03-5.67 2 2 0 113.95 0A6 6 0 0116 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 11-4 0h4z"/>
        </svg>
    </a>
        <ul class="submenu">
            <li v-for="notification in notifications">
                <a
                    :href="notification.data.link"
                    v-text="notification.data.message"
                    @click="markAsRead(notification)"
                ></a>
            </li>
        </ul>
    </li>

</template>

<script>
    export default {
        data() {
            return {
                notifications:false
            }
        },

        created() {
            axios.get("/profiles/" + window.App.user.name + "/notifications")
            .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }

    }
</script>

<style scoped>

</style>
