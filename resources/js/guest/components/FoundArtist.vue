<template>
    <div class="box-card">
        <div class="img">
            <img :src="data.profile_pic != null ? `../storage/${data.profile_pic}` : `../storage/profile-placeholder.png`" :alt="data.profile_pic != null ? `Profilo di ${data.firstname}` : 'Foto Profilo' "> 
        </div>
        <div class="text">
            <h3>{{data.firstname}}</h3>
            <h3>{{data.lastname}}</h3>
            <span>Numero recensioni: {{data.reviews_count}}</span>
            <button class="button-view"><a :href="`http://127.0.0.1:8000/showartist/${data.id}`">Visualizza</a></button>
            <div class="stars">
                <span>Media voti :</span>
                <span class="vote">
                    <span>
                        <img v-for="index in avgVotes" :key="index" :src="`../storage/plettro voto-2.png`" alt="">
                    </span>
                    <span>
                        <img v-for="index in 5 - avgVotes" :key="index"  :src="`../storage/plettro voto-1.png`" alt="">
                    </span>
                </span>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name : 'FoundArtist',
    props: {
        data : Object,
    },
    data(){
        return{
            avgVotes: Math.ceil(this.data.avgVote) 
        }
    },
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
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 20px auto 20px auto;
        background-color: #dadada;
        overflow: hidden;
        img{
            object-fit: cover;
            width: 105%;
        }
    }
    .text{
        display: flex;
        flex-direction: column;
        text-align: center;
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
                img{
                    width: 25px;
                    margin: 0 3px;
                }
            }
        }
    }
}


</style>