<template>
    <div id="app">
        <notification v-for="notification in notifications">
        </notification>
    </div>
</template>
<script>
    import NotificationComponent from './NotificationComponent.vue'

    export default {
        methods: {
            read() {
                window.axios.get('/').then(({ data }) => {
                    console.log(data)
                })
            }
        },
        components: {
            NotificationComponent
        }
    }
</script>