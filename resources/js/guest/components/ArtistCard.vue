<template>
    <div class="box-card">
        <div class="img">
            <img :src="data.profile_pic != null ? `storage/${data.profile_pic}` : `./storage/profile-placeholder.png`" :alt="data.profile_pic != null ? `Profilo di ${data.firstname}` : 'Foto Profilo' "> 
        </div>
        <div class="text">
            <h3>{{data.firstname}}</h3>
            <h3>{{data.lastname}}</h3>
            <span>Numero recensioni: {{data.reviews.length}}</span>
            <button class="button-view"><a :href="`http://127.0.0.1:8000/showartist/${data.id}`">Visualizza</a></button>
            <div class="stars">
                <span>Media voti :</span>
                <div class="vote">
                    <div class="picks silver_picks">
                        <img class="image" :src="`./storage/img/5_plettri_grigio.png`" alt="">
                    </div>
                    <div :style="{width : goldenWidth + '%'}" class="picks gold_picks">
                        <img class="image" :src="`./storage/img/5_plettri_oro.png`" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name : 'ArtistCard',
    props: {
        data : Object,
    },
    data(){
        return{
            reviews : this.data.reviews,
            avg: 0,
            goldenWidth : 0
        }
    },
    created() {
        this.avgs()
    },
    methods: {
        avgs() {
            var voto = 0;
            this.reviews.forEach((elm)=>{
                voto += elm.vote;
            })
            voto = voto / this.reviews.length;
            if(!voto){
                voto = 0
            }
            this.avg = voto;
            // modifica width del div con i plettri color oro a seconda del voto
            this.goldenWidth = (this.avg * 100) / 5;
        }
        
    }
}
</script>
<style lang="scss" scoped>
.box-card{
    height: 375px;
    width: 200px;
    background-color: #7883a5;
    border-radius:20px;
    margin: 30px;
    .img{
        overflow: hidden;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 20px auto 20px auto;
        background-color: #dadada;
        img{
            object-fit: cover;
            width: 100%;
        }
    }
    .text{
        display: flex;
        flex-direction: column;
        text-align: center;
        width: 100%;
        h3, span{
        margin-bottom: 5px;
        }
        .button-view{
            background-color: #3ba7ff;
            display: inline-block;
            width: 100px;
            height: 30px;
            border-radius: 20px;
            border: none;
            margin: auto;
            margin-bottom: 5px;
        }
        .stars{
            display: flex;
            flex-direction: column;
            .vote{
                width: 180px;
                height: 30px;
                overflow: hidden;
                position: relative;
                margin: 0 auto;
                .picks {
                    overflow: hidden;
                    position: absolute;
                    top:0;
                    left:0;
                    width: 100%;
                    height: 100%;
                    .image {
                        margin:0;
                        padding:0;
                        width: 180px;
                        height:100%;
                    }
                }
            }
        }
    }
}

@media only screen and (max-width: 768px) {
  .box-card {
    width: 180px;
    margin: 20px;
  }
}

@media only screen and (max-width: 425px) {
  .box-card {
    width: 160px;
    margin: 10px;
  }
}


</style>