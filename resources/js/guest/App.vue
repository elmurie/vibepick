<template>
	<div>
		<Header/>
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