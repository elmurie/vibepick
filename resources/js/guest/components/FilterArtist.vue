<template>
    <div class="d-flex justify-center"> 
        <div class="d-flex column">
            <label for="rew">Numero recensioni</label>
            <select name="rev" v-model="rewMin" v-on:change="$emit('revSearch', rewMin)">
                <option disabled value=""> &nbsp; Numero Recensioni</option>
                    <option
                        v-for="(num, index) in numReview" 
                        :key="`rev-${index}`"
                        :value="num">
                        &nbsp; &nbsp; {{num}} o piú recensioni
                    </option> 
            </select>
        </div>

        <div class="d-flex column">
            <label for="avg">Media voti</label>
            <select name="avg" v-model="avgVote" v-on:change="$emit('avgSearch', avgVote)">
                <option disabled value=""> &nbsp; Media voto</option>
                <option style="text-indent: 15px;"
                    v-for="(num, index) in average" 
                    :key="`avg-${index}`"
                    :value="num">
                    &nbsp; &nbsp; {{num}} o piú plettri
                </option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FilterArtist',
    data() {
        return{
            rewMin: '',
            avgVote: '',
            numReview : [
                0,2,4,5
            ],
            average:[
                0,1,2,3,4,5
            ]
        }
    },
}


</script>

<style lang="scss" scoped>
        select{
            position: relative;
            width: 200px;
            height: 30px;
            border: none;
            text-indent: 5px;
            appearance: none;
            background-image: url('/storage/arrow.jpg');
            background-size: 15px;
            background-repeat: no-repeat;
            background-position: 96% 50%;
            margin: 3px;
            &:focus-visible{
                outline: none;
            }
        }
        .column {
            flex-direction: column;
        }
        // optgroup{
        //     position: relative;
        //     top: -50px;
        //     text-indent: 15px;
        // }


        @media only screen and (max-width: 425px) {
            select{
                width: 150px;
            }
        }
</style>