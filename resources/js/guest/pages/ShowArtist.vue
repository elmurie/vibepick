<template>
    <div>
        <SingleArtist/>
        <ReviewForm/>
    </div>
</template>



<script>
import SingleArtist from '../components/SingleArtist.vue';
import ReviewForm from '../components/ReviewForm.vue';

export default {
    name: 'ShowArtist',
    components: {
        SingleArtist,
        ReviewForm
    },

    /* data() {
        
    } */
}
</script>