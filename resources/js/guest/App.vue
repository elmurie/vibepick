<template>
	<div>
		<!-- <Header/> -->
		<main>
			<router-view></router-view>
			<BgFrontOffice/>
		</main>
		<Footer/>
	</div>
</template>

<script>
import Header from './components/Header';
import Footer from './components/Footer';
import BgFrontOffice from './components/BgFrontOffice';
export default {
	name: 'App',
	components: {
		Header,
		Footer,
		BgFrontOffice,
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
		overflow: auto;	
	}
</style>