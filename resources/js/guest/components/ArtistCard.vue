<template>
    <router-link :to="{name : 'ShowArtist', params: {id: data.id}}">
    <div class="box-card">
        <div class="img">
            <img :src="data.profile_pic != null ? require(`../../../../public/storage/${data.profile_pic}`) : require(`../../../../public//storage/profile-placeholder.png`)" :alt="data.profile_pic != null ? `Profilo di ${data.firstname}` : 'Foto Profilo' "> 
        </div>
        <div class="text">
            <h3>{{data.firstname}}</h3>
            <h3>{{data.lastname}}</h3>
            <span v-if="data.sponsored ==  true">Sponsorizzato <font-awesome-icon :icon="sponsorStar" /></span>

            <span>Numero recensioni: {{data.reviews.length}}</span>
            <div class="stars">
                <span>Media voti</span>
                <div class="vote">
                    <div class="picks silver_picks">
                        <img class="image" :src="require(`../../../../public/storage/img/5_plettri_grigio.png`)" alt="">
                    </div>
                    <div :style="{width : goldenWidth + '%'}" class="picks gold_picks">
                        <img class="image" :src="require(`../../../../public/storage/img/5_plettri_oro.png`)" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
    </router-link>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faStar } from '@fortawesome/free-solid-svg-icons'
export default {
    name : 'ArtistCard',
    components:{
        FontAwesomeIcon
    },
    props: {
        data : Object,
    },
    data(){
        return{
            goldenWidth : (this.data.avgVote * 100) / 5,
            sponsorStar: faStar,
        }
    },
}
</script>
<style lang="scss" scoped>
.box-card{
    height: 375px;
    width: 200px;
    background-color: #ffffff29;
    border: 1px solid #ffffff;
    border-radius:20px;
    margin: 30px;
    transition: .5s;
    &:hover {
        transform: translateY(-5px);
    }
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
            height: 100%;
        }
    }
    .text{
        display: flex;
        flex-direction: column;
        width: 100%;
        h3, span{
        margin-bottom: 10px;
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
            color: #fff;
            line-height: 30px;
            transition: .5s;
            &:hover {
                background-color: #213e74;
            }
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
    .text{
        display: flex;
        flex-direction: column;
        text-align: center;
        width: 100%;
        h3, span{
        margin-bottom: 15px;
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
                width: 140px;
                height: 24px;
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
                        width: 140px;
                        height:100%;
                    }
                }
            }
        }
    }
    
  }
}

@media only screen and (max-width: 425px) {
  .box-card {
    width: 160px;
    margin: 10px;
  }
}

@media only screen and (max-width: 320px) {
  .box-card {
    width: 200px;
  }
}


</style>