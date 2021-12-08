<template>
    <div>
        <select v-model="selected" v-on:change="searchPage()">
            <option disabled value="">Please select one</option>
            <option 
                v-for="instrument in instruments" 
                :key="instrument.id" 
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
            instruments : [],
            selected: ''
        }
    },
    methods : {
        searchPage() {
            router.push({ name : 'search', params: { slug: this.selected }})
        }
    },
    mounted() {
        axios.get('api/instruments')
        .then((response) => {
            // se passa
            this.instruments = response.data.data;
        })
        .catch( (error) => {
            // se c'è un errore
            console.log(error);
        })
    }
}
</script>