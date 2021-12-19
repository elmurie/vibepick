<template>
	<div>
		<!-- <Header/> -->
		<main>
			<div class="animation-wrapper">
				<Animation/>
				<router-view></router-view>
			</div>
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
		// overflow-x: hidden;
		.animation-wrapper {
			z-index: 1;
			width: 100%;
			height:100%;
			overflow: auto;
		}
	}
</style>