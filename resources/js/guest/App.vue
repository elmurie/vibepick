<template>
	<div>
		<!-- <Header/> -->
		<main>
			<Animation/>
			<router-view></router-view>
		</main>
		<Footer/>
	</div>
</template>

<script>
import Header from './components/Header';
import Animation from './components/Animation.vue';
import Footer from './components/Footer';
export default {
	name: 'App',
	components: {
		Animation,
		Header,
		Footer
	},
	data() {
		return {
			instruments : []
		}
	}
}
</script>
<style lang="scss">
	main {
		z-index: 2;
		position: relative;
		height: calc(100vh - 120px);
		background: #0a5a90;
		overflow: auto;
		overflow-x: hidden;
	}
</style>