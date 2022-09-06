<template>
    <video autoplay muted loop>
        <source :src="urlVideo" type="video/mp4">
    </video>
</template>

<script>
export default {
    name: "VideoComponent",
    props: {
        urlVideo: String
    }
}
</script>

<style scoped>

</style>
