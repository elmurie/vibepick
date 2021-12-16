<template>
    <div class="box-search">
        <h1>Cerca il tuo Musicista!</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi quam quos et error cum voluptate nostrum am. Debitis ipsa sapiente hic.</p>
        <div class="d-flex justify-center">
            <div class="d-flex column">
                <label for="search">Ricerca per strumento</label>
                <select name="search" v-model="selected" v-on:change="searchPage(), $emit('search', selected)">
                    <option disabled value="">&nbsp; &nbsp; Filtra per strumento!</option>
                    <option 
                        v-for="(instrument, index) in instruments" 
                        :key="index"
                        :data="instrument"
                        :value="instrument.slug">
                        &nbsp; &nbsp; {{instrument.name}}
                    </option>

                </select>
            </div>
        </div>
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
            avgVote: 0,
        }
    },
    methods : {
        searchPage() {
            router.push({ name : 'search', params: { slug: this.selected , rewMin: this.rewMin , avgVote: this.avgVote}})
        },
    },

    mounted() {
        if(this.$route.params.slug != undefined){

            this.selected = this.$route.params.slug;
        }
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
    .box-search {
        margin-top: 3.125rem;
        h1 {
            font-size: 55px;
        }
        p {
            max-width: 600px;
            margin: auto;
            color: rgb(233, 233, 233);
            margin-bottom: 30px;
        }
    }
    
        select{
            position: relative;
            width: 300px;
            height: 30px;
            border: none;
            text-indent: 15px;
            appearance: none;
            background-image: url('/storage/arrow.jpg');
            background-size: 15px;
            background-repeat: no-repeat;
            background-position: 97% 50%;
            &:focus-visible{
                outline: none;
            }
        }

        .column{
            flex-direction: column;
        }
    
</style>