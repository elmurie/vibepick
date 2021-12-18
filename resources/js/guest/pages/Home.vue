<template>
	<div class="box-main-home">
		<Search/>
		<h1>I nostri artisti in primo piano</h1>
		<ArtistsContainer :artists="artists"/>
		<ArtistsContainer :artists="artistsNotSponsored"/>
	</div>
</template>

<script>
import ArtistsContainer from '../components/ArtistsContainer';
import Search from '../components/Search.vue';

	export default {
		name: 'Home',
		components: {
			ArtistsContainer,
			Search,
		},
		data() {
        return {
            artists : [],
			artistsNotSponsored: []
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
			});
			axios.get('api/usersnotsponsored')
			.then((response) => {
				// se passa
				this.artistsNotSponsored = response.data.data;
			})
			.catch( (error) => {
				// se c'è un errore
				console.log(error);
			});
		}
    
	}
</script>
<style lang="scss" scoped>
	.box-main-home {
		margin: 3.125rem auto;
		padding: 1rem 0;
		max-width: 	1200px;
		min-height: calc(100vh - 6.25rem - 7.5rem); //i 6.25rem sono i 3.125rem * 2 per renderlo equidistante da header e footer, i 7.5rem sono la somma di header e footer
        border-radius: .625rem;
		text-align: center;
		background-color: rgba(0, 0, 0, 0.068);
		h1 {
			margin: 20px 0 0 0;
		}
	}
</style>