<template>
    <div>
        <h3>Profilo di {{data.firstname}} {{data.lastname}}</h3>
        <img :src="data.profile_pic != null ? `storage/${data.profile_pic}` : `storage/profile-placeholder.png`" :alt="data.profile_pic != null ? `Profilo di ${data.firstname}` : 'Foto Profilo' ">

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
img {
    width: 12.5rem;
}

</style>