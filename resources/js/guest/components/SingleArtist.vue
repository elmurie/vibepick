<template>
    <div class="box">
        <div class="l-col">
            <h2>{{artist.firstname}} {{artist.lastname}}</h2>
            <h3>Artista specializzato in:</h3>
            <ul>
                <li v-for="instrument in artist.instruments" :key="instrument.id">{{instrument.name}}</li>
            </ul>
            <p>Voto: <span>{{artist.avgVote}}</span></p>
            <p>Numero di recensioni: <span>{{artist.numReviews}}</span> </p>
            <p>Indirizzo: <span>{{artist.adress}}</span></p>
            <p>Telefono: <span>+39 {{artist.phone_number}}</span></p>
            <p>Email: <span>{{artist.email}}</span></p>
            <p>Genere: <span>{{artist.genre}}</span></p>
            <p>Servizi offerti: <span>{{artist.services}}</span></p>
            <p>CV: <span>{{artist.curriculum}}</span></p>
        </div>
        <div class="r-col">
            <div class="img-box">
                <img src="" alt="">
            </div>
            <div class="box-btn">
                <button>Contatta</button>
            </div>
        </div>
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

<style lang="scss" scoped>
    .box {
        width: 50%;
        margin: 0 auto;
        display: flex;
        gap: 3.125rem;
        height:  calc(100vh - 120px);

        .l-col {
            width: 60%;
            // background-color: rgba(0, 0, 0, 0.11);
            padding: 4.375rem 0;

            h2 {
                font-size: 2.875rem;
                margin-bottom: 20px;
            }
            ul {
                list-style-type: circle;
                margin-left: 20px;
                margin-top: 5px;
            }
            p {
                margin: 15px 0;
                font-size: 20px;
                font-weight: 500;
            }
            span, li {
                color: rgb(221, 221, 221);
            }
        }

        .r-col {
            background-color: rgba(65, 65, 65, 0.61);
            width: 40%;
            padding: 70px 0;

            .img-box {
                width: 240px;
                height: 240px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgb(255, 255, 255);
                color: black;
                margin-left: auto;
                margin-right: auto;
            }
            .box-btn {
                margin-top: 40px;
                text-align: center;

                button {
                    background-color: #3ba7ff; /* Green */
                    border: none;
                    color: white;
                    padding: 10px 25px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 20px;
                    cursor: pointer;
                }
            }
        }
    }
</style>