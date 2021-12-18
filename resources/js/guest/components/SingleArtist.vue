<template>
    <div >
        <div class="box">
            <div class="l-col">
                <h2>{{artist.firstname}} {{artist.lastname}}</h2>
                <h3>Artista specializzato in:</h3>
                <ul class="instrument-list d-flex flex-wrap">
                    <li v-for="instrument in artist.instruments" :key="instrument.id">{{instrument.name}}</li>
                </ul>
                <p>Media Voti: <span>{{artist.avgVote}}</span></p>
                <p>Indirizzo: <span>{{artist.address ? artist.address : ` L'indirizzo non é presente`}}</span></p>
                <p>Telefono: <span>{{artist.phone_number? `${artist.phone_number}`: 'Il cellulare non é presente'}}</span></p>
                <p>E-mail: <span>{{artist.email}}</span></p>
                <p>Genere: <span>{{artist.genre ? artist.genre : "Il genere non é presente"}}</span></p>
                <p>Servizi offerti: <span>{{artist.services? artist.services : 'I servizi non sono presenti'}}</span></p>
                <p>CV: <span>{{artist.curriculum ? artist.curriculum : 'Il curriculum non é presente'}}</span></p>
                <p>Recensioni: {{artist.reviews_count}}</p>
                <div class="reviews">
                    <ul >
                        <li v-for="review, index in artist.reviews.slice().reverse()" :key="index">
                            <h3>{{review.title}}</h3>
                            <h4>Recensito da: {{review.author}}</h4>
                            <h4>Voto: {{review.vote}}</h4>
                            <span>Recensito il : {{formattedDate(review.created_at)}}</span>
                            <br>
                            <p>{{review.content}}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="r-col">
                <div class="img-box">
                    <img :src="artist.profile_pic != null ? `../storage/${artist.profile_pic}` : `../storage/profile-placeholder.png`" :alt="artist.profile_pic != null ? `Profilo di ${artist.firstname}` : 'Foto Profilo' ">
                </div>
                <!-- <div class="box-btn">
                    <button>Contatta</button>
                </div> -->

                <!--  bottone modale messaggi  -->
                <div class="box-btn">
                    <!-- <div class="delete_parent col-md-12"> -->
                        <button id="modalBtn" type="submit" class="btn btn-danger " :data-id="artist.id" data-toggle="modal" data-target="#messageModal" @click="showMessageModal">Contatta</button>
                    <!-- </div> -->
                </div>
                <!--  bottone modale recensione  -->
                <div class="box-btn">
                    <!-- <div class="delete_parent col-md-12"> -->
                        <button id="modalBtn" type="submit" class="btn btn-danger " :data-id="artist.id" data-toggle="modal" data-target="#reviewModal" @click="showReviewModal">Lascia una Recensione</button>
                    <!-- </div> -->
                </div>


            </div>    
        </div>
        

        <!--  Modale Messaggio -->
        <div class="modal fade" id="messageModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel">Contatta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeMessageModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <MessageForm/>
                </div>
            </div>
        </div>
    
        <!--  Modale Recensione -->
        <div class="modal fade" id="reviewModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel">Scrivi una recensione</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeReviewModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <ReviewForm/>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
var dayjs = require('dayjs')
//import dayjs from 'dayjs' // ES 2015
dayjs().format()
import ReviewForm from './ReviewForm.vue';
import MessageForm from './MessageForm.vue';
export default {

    name: 'SingleArtist',
    components: {
        ReviewForm,
        MessageForm

    },
    data() {
        return {
            artist : {},
            
        }
    },
    methods:{
        // getReviews () {
        //     let number = this.artist.reviews.length;
        //     console.log(number);
        // },
        getScore (val) {
            return parseFloat(val).toFixed(2);
        },
        showReviewModal (){
            let mod = document.getElementById('reviewModal');
            mod.classList.add('showMod');
        },
        closeReviewModal (){
            let mod = document.getElementById('reviewModal');
            mod.classList.remove('showMod');
        },
        showMessageModal (){
            let mod = document.getElementById('messageModal');
            mod.classList.add('showMod');
        },
        closeMessageModal (){
            let mod = document.getElementById('messageModal');
            mod.classList.remove('showMod');
        },
        formattedDate(reviewDate) {
            var giorno =  dayjs(reviewDate).locale('it').format('DD-MM-YYYY HH:mm:ss');
            var giorno_alle = giorno.slice(0, 11) + 'alle ' + giorno.slice(11)
            return giorno_alle;
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
@import '~/resources/sass/common.scss';

.showMod{
    display: block;
}

.modal-header{
    justify-content: space-between;
        align-items: center;
}
    .box {
            // height: calc(100vh - 120px);
            height: 100%;
        max-width: 1200px;
        margin: auto;
        display: flex;
        justify-content: space-around;
        gap: 3.125rem;
        // height:  calc(100vh - 120px);

        .l-col {
            width: 60%;
            height: 100%;
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
            background-color: #a3a1a14d;
            width: 40%;
            // height: 100%;
            padding: 70px 15px;
            flex-direction:column;
            .img-box {
                width: 240px;
                height: 240px;
                border-radius: 50%;
                justify-content: center;
                align-items: center;
                background-color: rgb(255, 255, 255);
                color: black;
                margin-left: auto;
                margin-right: auto;
                overflow: hidden;
                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            .box-btn {
                margin-top: 40px;
                text-align: center;
                button {
                    font-family: 'Ubuntu', sans-serif;
                    max-width:230px;
                    background-color: #3ba7ff; /* Green */
                    border: none;
                    color: white;
                    padding: 10px 25px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 20px;
                    cursor: pointer;
                    transition: .5s;
                    &:hover {
                        background-color: #213e74;
                    }
                }
            }
        }

        .reviews{
            overflow-y: auto;
            height: 200px;
            p{
                margin-bottom: 2px;
            }
            ul{
                list-style: none;
                margin: 0;
                li{
                    background-color: rgba(173, 216, 230, 0.11);
                    padding: 5px;
                    border-radius: 5px;  
                    margin-bottom:10px;
                    p{
                        margin:0;
                    }
                }
                
            }

         
        }

    }
   ::-webkit-scrollbar {
            width: .375rem;
            }

            ::-webkit-scrollbar-track {
                background: transparent; 
            }

            ::-webkit-scrollbar-thumb {
                background: #f5980b; 
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #9b610a; 
                ; 
            }
  



    @media only screen and (max-width: 1200px) {
            .box{
                margin: 0 30px;
            }

            .modal{
                .modal-dialog{
                    .modal-content{
                        width: 50%;
                    }
                }
            }
    }

    @media only screen and (max-width: 768px ) and (min-width: 465px ) {
        .box{
           .r-col{
                .img-box{
                    width: 138px;
                    height: 138px;
                }
            } 
        }
            
    }

    @media only screen and (max-width: 465px) {
            .box{
                flex-direction: column;
                
                .r-col{
                    width: 100%;
                    background-color: rgba(255, 255, 255, 0);
                    display: flex;
                    justify-content:space-around;
                    flex-wrap: wrap;
                    padding-top: 0;
                    .img-box{
                    width:240px;
                    height:240px;
                }
                }
                .l-col{
                    width: 100%;
                    padding-top: 10px;
                    padding-bottom: 0;
                }
            }

            .modal{
                .modal-dialog{
                    .modal-content{
                        width: 90%;
                    }
                }
            }

            .reviews{
                width: 100%;
            }
    }

    @media only screen and (max-height: 860px) {
            .box{
                height: 100%
            }
    }

.box .l-col ul{
    margin-left: 0;

}

.instrument-list{
    li{
        list-style: none;
        font-size: 0.875rem;
        background-color: #f39200;
        color: white;
        font-weight: 700;
        padding: 10px;
        margin-right: 0.625rem;
        border-radius: 5px;
    }
}
</style>