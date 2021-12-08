<template>
    <div>
        <Search/>
        <h1 v-if="instrument != null">{{instrument.name}}</h1>
        <ul v-if="instrument != null">
            <li v-for="user in instrument.users" :key="user.id">{{user.firstname}} {{user.lastname}}</li>
        </ul>
    </div>
</template>

<script>
import Search from '../components/Search.vue';

export default {
    components: { Search },
    name : 'AdvancedSearch',
    data() {
        return {
            instrument : null,
        }
    },
    watch: {
        $route : function() {
                axios.get(`/api/instruments/${this.$route.params.slug}`)
            .then( (response) => {
                this.instrument = response.data.data;
            });

        }
    },
    mounted(){
        axios.get(`/api/instruments/${this.$route.params.slug}`)
            .then( (response) => {
                this.instrument = response.data.data;
            });

        }
    
}
</script>