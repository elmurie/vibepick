<template>
    <div>
        <Search @search="instrumentSelected"/>
        <h1 v-if="instrument != null">{{instrument.name}}</h1>
        <ul v-if="instrument != null">
            <li v-for="user in instrument" :key="user.id">{{user.firstname}} {{user.lastname}} {{user.reviews.length}}</li>
        </ul>
        <FilterArtist @revSearch="revSelected"/>
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
            selectedAdv : this.$route.params.slug,
            reviewNum: 0
            
        }
    },
    watch: {

        reviewNum : function(){
            axios.get(`/api/instruments/${this.selectedAdv}/${this.reviewNum}`)
            .then( (response) => {
                console.log(response.data.data);
                this.instrument = response.data.data;
            });
        },
        selectedAdv : function(){
            axios.get(`/api/instruments/${this.selectedAdv}/${this.reviewNum}`)
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
            instrumentSelected(instrument){
                this.selectedAdv = instrument;
            },
            revSelected(revNum){
                this.reviewNum = revNum;
            }
        }

    
    
}
</script>

<style lang="scss" scoped>

    div {
        text-align: center;
    }
</style>