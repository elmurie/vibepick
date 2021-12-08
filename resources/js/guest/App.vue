<template>
	<div>
		<Header/>
		<Search :instruments="instruments"/>
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
	},
	data() {
		return {
			instruments : []
		}
	},
	mounted() {
        axios.get('api/instruments')
        .then((resp) => {
            // se passa
            console.log(resp.data);
            this.instruments = resp.data.data;
        })
        .catch( (error) => {
            // se c'è un errore
            console.log(error);
    
        })
        },
}
</script>