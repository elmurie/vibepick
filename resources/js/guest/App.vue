<template>
	<div>
		<!-- <Header/> -->
		<main>
			<router-view></router-view>
		</main>
		<Footer/>
	</div>
</template>

<script>
import Header from './components/Header';
import Footer from './components/Footer';
export default {
	name: 'App',
	components: {
		Header,
		Footer,
	},
	data() {
		return {
			instruments : []
		}
	},
}
</script>
<style lang="scss">
	main {
		height: calc(100vh - 120px);
		background: rgb(31,89,103);
		background: linear-gradient(0deg, rgba(31,89,103,1) 0%, rgba(93,184,169,1) 100%);
		overflow: auto;
	}
</style>