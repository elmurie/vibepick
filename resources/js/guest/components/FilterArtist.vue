<template>
    <div>
        <select v-model="rewMin" v-on:change="filterReview()">
            <option disabled value="">numero recensioni</option>
            <option 
                v-for="(num, index) in numReview" 
                :key="index"
                :value="num">
                {{num}}
            </option>
        </select>
    </div>
</template>

<script>
import router from '../router';

export default {
    name: 'FilterArtist',
    props: {
        selectFilter: String,
    },
    data() {
        return{
            selected: this.selectFilter,
            rewMin: '',
            numReview : [
                0,1,2,3,4,5
            ]
        }
    },
    watch:{
        selectFilter : function() {
            this.selected = this.selectFilter
        }

    },
    methods : {
            filterReview() {
                router.push({ name : 'search', params: { slug: this.selected , rewMin: this.rewMin }})
            },
        },
}


</script>