<template>
    <div>
        <h3>{{data.firstname}} {{data.lastname}}</h3>
        <img :src="data.profile_pic != null ? `storage/${data.profile_pic}` : `./storage/profile-placeholder.png`" :alt="data.profile_pic != null ? `Profilo di ${data.firstname}` : 'Foto Profilo' ">
    </div>
</template>

<script>
export default {
    name : 'ArtistCard',
    props: {
        data : Object
    }
}
</script>
<style lang="scss" scoped>
div {
    padding: 10px;
    text-align: center;
    img {
        object-fit: cover;
        width: 12.5rem;
        height: 12.5rem;
        border-radius: 50%;
    }
}

</style>