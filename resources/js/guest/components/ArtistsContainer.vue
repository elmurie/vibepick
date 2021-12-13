<template>
	<section>
		<div class="container">
			<div class="user">
                <a :href="`http://127.0.0.1:8000/showartist/${artist.id}`" v-for="artist in artists" :key="artist.id"><ArtistCard :data="artist"/></a>
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
    section {
        .container {
            margin: 0 auto;
            .user {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    }
</style>