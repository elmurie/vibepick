<template>
    <div>
        <select v-model="rewMin" v-on:change="$emit('revSearch', rewMin)">
            <option disabled value="">numero recensioni</option>
            <option 
                v-for="(num, index) in numReview" 
                :key="`rev-${index}`"
                :value="num">
                {{num}}
            </option>
        </select>

        <select v-model="avgVote" v-on:change="$emit('avgSearch', avgVote)">
            <option disabled value="">media Voto</option>
            <option 
                v-for="(num, index) in average" 
                :key="`avg-${index}`"
                :value="num">
                {{num}}
            </option>
        </select>
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
            border-radius: 15px;
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
            &:focus{
                border-radius: 15px 15px 0 0;
            }
        }
</style>