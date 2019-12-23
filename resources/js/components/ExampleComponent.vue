<template>
    <div class="container">
    </div>
</template>

<script>
    export default {
        mounted() {
            Echo.private(`order.1`)
                .listen('.server.created', (e) => {
                    console.log(e);
                });
        }
    }
</script>
