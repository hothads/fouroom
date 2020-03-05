<template>
<div>
	<li v-for="item in channels">
	{{item.slug}}
	</li>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        
        props:['channels'],
    }
</script>
