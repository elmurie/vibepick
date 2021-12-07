<template>
	<div>
		<Header/>
		<main>
            Test Frontoffice HomePage
			<router-view></router-view>
		</main>
		<Footer/>
	</div>
</template>

<script>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
export default {
	name: 'App',
	components: {
		Header,
		Footer
	}	
}
</script>