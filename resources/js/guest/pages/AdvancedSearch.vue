<template>
    <div>
        <Search @search="passSelected"/>
        <h1 v-if="instrument != null">{{instrument.name}}</h1>
        <ul v-if="instrument != null">
            <li v-for="user in instrument" :key="user.id">{{user.firstname}} {{user.lastname}} {{user.reviews.length}}</li>
        </ul>
        <FilterArtist :selectFilter="selectedAdv"/>
    </div>
</template>

<script>
import Search from '../components/Search';
import ArtistCard from '../components/ArtistCard';
import FilterArtist from '../components/FilterArtist';

export default {
    components: { 
        Search,
        ArtistCard,
        FilterArtist 
    },
    name : 'AdvancedSearch',
    data() {
        return {
            instrument : null,
            selectedAdv : ''
            
        }
    },
    watch: {
        $route : function() {
                axios.get(`/api/instruments/${this.$route.params.slug}/${this.$route.params.rewMin}`)
            .then( (response) => {
                console.log(response.data.data);

                this.instrument = response.data.data;
            });

        }
    },
    mounted(){
        axios.get(`/api/instruments/${this.$route.params.slug}/${this.$route.params.rewMin}`)
            .then( (response) => {
                console.log(response.data.data);
                this.instrument = response.data.data;
            });

        },

        methods: {
            passSelected(pippo){
                this.selectedAdv = pippo;
            }
        }

    
    
}
</script>

<style lang="scss" scoped>

    div {
        text-align: center;
    }
</style>