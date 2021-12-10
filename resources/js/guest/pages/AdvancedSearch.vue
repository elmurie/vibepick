<template>
    <div>
        <Search/>
        <h1 v-if="instrument != null">{{instrument.name}}</h1>
        <ul v-if="instrument != null">
            <li v-for="user in instrument" :key="user.id">{{user.firstname}} {{user.lastname}} {{user.reviews.length}}</li>
        </ul>
    </div>
</template>

<script>
import Search from '../components/Search.vue';
import ArtistCard from '../components/ArtistCard.vue';

export default {
    components: { 
        Search,
        ArtistCard 
    },
    name : 'AdvancedSearch',
    data() {
        return {
            instrument : null,
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

        }
    
}
</script>

<style lang="scss" scoped>

    div {
        text-align: center;
    }
</style>