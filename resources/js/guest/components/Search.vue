<template>
    <div>
        <select v-model="selected">
            <option disabled value="">Please select one</option>
            <option 
                v-for="instrument in instruments" 
                :key="instrument.id" 
                :data="instrument">
                {{instrument.name}}
            </option>
        </select>
        <span>Selected: {{ selected }}</span>
    </div>
</template>

<script>
export default {
    name: 'Search',
    data() {
        return {
            instruments : [],
            selected: ''
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