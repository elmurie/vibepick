<template>
    <div class="box-main-home box-search">
        <Search class="instrument_filter " @search="instrumentSelected"/>
        <FilterArtist class="review_vote_filter" @revSearch="revSelected" @avgSearch="avgSelected"/>
        <h1 v-if="instrument != null">{{selectedAdv}}</h1>
        <div class="artists" v-if="instrument != null">
            <!-- <a class="found_artist" :href="`http://127.0.0.1:8000/showartist/${user.id}`" v-for="user in instrument" :key="user.id"><FoundArtist :data="user"/></a>  -->
            <FoundArtist v-for="user in instrument" :key="user.id" :data="user"/>
        </div>
    </div>
</template>

<script>
import Search from '../components/Search';
// import ArtistCard from '../components/ArtistCard';
import FilterArtist from '../components/FilterArtist';
import FoundArtist from '../components/FoundArtist';


export default {
    components: { 
        Search,
        // ArtistCard,
        FilterArtist,
        FoundArtist 
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
    .box-main-home {
		max-width: 	1200px;
		margin: 0 auto;
		text-align: center;
		background-color: rgba(0, 0, 0, 0.068);
	}
    .box-search{
        margin-top: 3.125rem;
    }
    .instrument_filter,
    .review_vote_filter {
            margin: 20px 0;
        }
    .artists {
        margin-top: 20px;
        justify-content: center;
        display: flex;
        flex-wrap: wrap;
        

        .found_artist {
            margin: 10px;
        }
    }
    div {
        text-align: center;
    }

    @media only screen and (max-width: 1024px) {
    section {
        .container {
            .user {
                justify-content: space-evenly;
            }
        }
    }
}
</style>