<template>
    <div>
        <Search @search="instrumentSelected"/>
        <h1 v-if="instrument != null">{{instrument.name}}</h1>
        <ul v-if="instrument != null">
            <li v-for="user in instrument" :key="user.id">{{user.firstname}} {{user.lastname}} n.rev: {{user.reviews_count}} media:{{user.avgVote}}</li> 
        </ul>
        <FilterArtist @revSearch="revSelected" @avgSearch="avgSelected"/>
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
            reviewNum: 0, 
            avgVote:0
            
        }
    },
    watch: {

        selectedAdv : function(){
            axios.get(`/api/instruments/${this.selectedAdv}/${this.reviewNum}/${this.avgVote}`)
            .then( (response) => {
                console.log(response.data.data);
                this.instrument = response.data.data;
            });
        },
        reviewNum : function(){
            axios.get(`/api/instruments/${this.selectedAdv}/${this.reviewNum}/${this.avgVote}`)
            .then( (response) => {
                console.log(response.data.data);
                this.instrument = response.data.data;
            });
        },
        avgVote : function(){
            axios.get(`/api/instruments/${this.selectedAdv}/${this.reviewNum}/${this.avgVote}`)
            .then( (response) => {
                console.log(response.data.data);
                this.instrument = response.data.data;
            });
        }
    },
    mounted(){
        axios.get(`/api/instruments/${this.$route.params.slug}/${this.$route.params.rewMin}/${this.$route.params.avgVote}`)
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
            },
            avgSelected(avgNum){
                this.avgVote = avgNum;
            }
        }

    
    
}
</script>

<style lang="scss" scoped>

    div {
        text-align: center;
    }
</style>