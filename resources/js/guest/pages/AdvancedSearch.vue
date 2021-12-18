<template>
    <div class="box-main-home box-search">
        <Search class="instrument_filter " @search="instrumentSelected"/>
        <FilterArtist class="review_vote_filter" @revSearch="revSelected" @avgSearch="avgSelected"/>
        <h2 v-if="instrument != null">{{selectedParams}}</h2>
        <template v-if="instrument.sponsored.length > 0 || instrument.notSponsored.length > 0">
            <ArtistsContainer :artists="instrument.sponsored"/>
            <ArtistsContainer :artists="instrument.notSponsored"/>
        </template>
        <template v-else>
            <h3 class="no_result">Nessun risultato per la tua ricerca</h3>
        </template>
        
    </div>
</template>

<script>
import Search from '../components/Search';
import FilterArtist from '../components/FilterArtist';
import FoundArtist from '../components/FoundArtist';
import ArtistsContainer from '../components/ArtistsContainer.vue';


export default {
    components: { 
        Search,
        FilterArtist,
        FoundArtist,
        ArtistsContainer 
    },
    name : 'AdvancedSearch',
    data() {
        return {
            instrument: '',
            selectedAdv : this.$route.params.slug,
            selectedParams : '',
            reviewNum: 0, 
            avgVote:0
            
        }
    },
    watch: {
        selectedAdv : function(){
            axios.get(`/api/instruments/${this.selectedAdv}/${this.reviewNum}/${this.avgVote}`)
            .then( (response) => {
                console.log(response.data.data,);
                this.instrument = response.data.data;
                axios.get(`api/instruments`)
                .then((response) => {
                    let nomi = response.data.data;
                    nomi.forEach(elm => {
                        if (elm.slug == this.selectedAdv){
                            this.selectedParams = elm.name
                        }
                    } )
                });
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
        },

        selectedParams: function(){
            axios.get(`api/instruments`)
            .then((response) => {
                let nomi = response.data.data;
                nomi.forEach(elm => {
                    if (elm.slug == this.selectedAdv){
                        this.selectedParams = elm.name
                    }
                } )
            });
        }

    },
    mounted(){
        axios.get(`/api/instruments/${this.$route.params.slug}/${this.$route.params.rewMin}/${this.$route.params.avgVote}`)
            .then( (response) => {
                console.log(response.data.data);
                this.instrument = response.data.data;
            });

            axios.get(`api/instruments`)
            .then((response) => {
                let nomi = response.data.data;
                nomi.forEach(elm => {
                    if (elm.slug == this.selectedAdv){
                        this.selectedParams = elm.name
                    }
                } )
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
		margin: 0 auto;
		max-width: 	1200px;
        padding: 1rem 0;
        min-height: calc(100vh - 100px - 120px); //i 100px sono i 3.125rem * 2 per renderlo equidistante da header e footer, i 120px sono la somma di header e footer
        border-radius: .625rem;
		text-align: center;
		background-color: rgba(0, 0, 0, 0.068);
	}
    .box-search{
        margin-top: 3.125rem;
        margin-bottom: 3.125rem;
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
    h3{
        padding: 15px 0;
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