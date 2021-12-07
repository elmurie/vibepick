<template>
	<section>
		<div class="container">
			<h2>Artists Container</h2>
			<div class="user">
                <ArtistCard v-for="artist in artists" :key="artist.id" :data="artist"/>
			</div>
		</div>
	</section>
</template>

<script>
import ArtistCard from './ArtistCard.vue';
export default {
    name: 'ArtistsContainer',
    components : {
        ArtistCard
    },
    data() {
        return {
            artists : []
        }
    },
    mounted() {
        axios.get('api/users')
        .then((response) => {
            // se passa
            this.artists = response.data.data;
        })
        .catch( (error) => {
            // se c'è un errore
            console.log(error);
        })
    }
}
</script>

<style lang="scss" scoped>

</style>