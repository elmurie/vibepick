<template>
    <div>


        <select v-model="selected" v-on:change="searchPage()">
            <option disabled value="">Please select one</option>
            <option 
                v-for="(instrument, index) in instruments" 
                :key="index"
                :data="instrument"
                :value="instrument.slug">
                {{instrument.name}}
            </option>

        </select>
    </div>
</template>

<script>
import router from '../router';
export default {
    name: 'Search',
    data() {
        return {
            instruments: [],
            selected: '',
            rewMin: 0,
        }
    },
    methods : {
        searchPage() {
            router.push({ name : 'search', params: { slug: this.selected , rewMin: this.rewMin }})
        },
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
<style lang="scss" scoped>
    div {
        padding: .625rem;
    }
</style>