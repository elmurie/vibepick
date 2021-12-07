<template>
	<div>
		<Search/>
		<ArtistsContainer/>
	</div>
</template>

<script>
import ArtistsContainer from '../components/ArtistsContainer';
import Search from '../components/Search';

	export default {
		name: 'Home',
		components: {
			ArtistsContainer,
			Search
		}
	}
</script>