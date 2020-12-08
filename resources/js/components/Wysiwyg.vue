<template>
    <div class="mt-2 bg-white rounded p-5">
        <input id="trix" type="hidden" :name="name" :value="value">
        <trix-editor class="bg-white border-gray-300" input="trix"></trix-editor>
    </div>
</template>

<script>

import Trix from 'trix';

    export default {
        props: ['name', 'value']

    }
</script>