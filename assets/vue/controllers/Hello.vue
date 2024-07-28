<template>
    <div>
        <h1 class="text-red-600">Hello {{ name }}!</h1>
    </div>
</template>

<script setup>
    defineProps({
        name: String
    });
</script>
