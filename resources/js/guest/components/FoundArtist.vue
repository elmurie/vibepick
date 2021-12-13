<template>
    <div class="single_artist">
        <h2>{{data.firstname}} {{data.lastname}}</h2>
        <img :src="data.profile_pic != null ? `../storage/${data.profile_pic}` : `../storage/profile-placeholder.png`" :alt="data.profile_pic != null ? `Profilo di ${data.firstname}` : 'Foto Profilo' ">
        <h5>Media Voto: {{data.avgVote}}</h5>
        <h5>Numero recensioni: {{data.reviews_count}}</h5>
    </div>
</template>

<script>
export default {
    name : 'FoundArtist',
    props : {
        data : Object
    },
}
</script>

<style lang="scss" scoped>
.single_artist {
    width: 250px;
    img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }
}
</style>