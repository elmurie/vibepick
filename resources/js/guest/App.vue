<template>
	<div>
		<Header/>
		<Search/>
		<main>
			<router-view></router-view>
		</main>
		<Footer/>
	</div>
</template>

<script>
import Header from './components/Header';
import Search from './components/Search';
import Footer from './components/Footer';
export default {
	name: 'App',
	components: {
		Header,
		Footer,
		Search
	}	
}
</script>