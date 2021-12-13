<template>
    <div>
        <h2>{{artist.firstname}} {{artist.lastname}}</h2>
        <h3>Strumenti:</h3>
        <ul>
            <li v-for="instrument in artist.instruments" :key="instrument.id">{{instrument.name}}</li>
        </ul>
        <h3>Voto: <span>{{artist.avgVote}}</span></h3>
        <h3>Numero recensioni: <span>{{artist.reviews_count}}</span> </h3>
        <p>Indirizzo: <span>{{artist.address}}</span></p>
        <p>Telefono: +39 <span>{{artist.phone_number}}</span></p>
        <p>Email: <span>{{artist.email}}</span></p>
        <p>Genere: <span>{{artist.genre}}</span></p>
        <p>servizi offerti: <span>{{artist.services}}</span></p>
        <p>CV: <span>{{artist.curriculum}}</span></p>
    </div>
</template>



<script>
export default {
    name: 'SingleArtist',
    data() {
        return {
            artist : {}
        }
    },


    mounted() {
        axios.get(`api/showartist/${this.$route.params.id}`)
        .then((response) => {
            // se passa
            this.artist = response.data.data;
        })
        .catch( (error) => {
            // se c'è un errore
            console.log(error);
        })
    }

}

</script>