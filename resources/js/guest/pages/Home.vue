<template>
	<div class="box-main-home">
		<Search/>
		<ArtistsContainer :artists="artists"/>
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
	.box-main-home {
		max-width: 	1200px;
		margin: 0 auto;
		text-align: center;
		background-color: rgba(0, 0, 0, 0.068);
	}
</style>