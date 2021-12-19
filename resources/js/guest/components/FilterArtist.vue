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
                <!-- <option style="text-indent: 15px;"
                    v-for="(num, index) in average" 
                    :key="`avg-${index}`"
                    :value="num">
                    &nbsp; &nbsp; Da {{num}} in su
                </option> -->
                <option value="0" style="text-indent: 15px;">&nbsp; &nbsp; Da 0 in su</option>
                <option value="1" style="text-indent: 15px;">&nbsp; &nbsp; Da 1 in su</option>
                <option value="2" style="text-indent: 15px;">&nbsp; &nbsp; Da 2 in su</option>
                <option value="3" style="text-indent: 15px;">&nbsp; &nbsp; Da 3 in su</option>
                <option value="4" style="text-indent: 15px;">&nbsp; &nbsp; Da 4 in su</option>
                <option value="5" style="text-indent: 15px;">&nbsp; &nbsp; Uguale a 5</option>
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
                0,4,8,12
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
            background-image: url('/storage/arrow.png');
            background-size: 15px;
            background-repeat: no-repeat;
            background-position: 96% 50%;
            margin: 0px 7px;
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
        label {
            margin-bottom: 5px;
        }

        @media only screen and (max-width: 425px) {
            select{
                width: 148px;
                margin: 3px;
            }
        }
</style>