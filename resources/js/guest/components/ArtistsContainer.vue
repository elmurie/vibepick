<template>
	<section>
		<div class="container">
			<div class="user">
                <ArtistCard v-for="artist in artists" :key="artist.id" :data="artist"/>
			</div>
		</div>
	</section>
</template>

<script>
import ArtistCard from './ArtistCard.vue';
export default {
    name: 'ArtistsContainer',
    components : {
        ArtistCard
    },
    props:{
        artists: Array
    },
}
</script>

<style lang="scss" scoped>
    section {
        .container {
            margin: 0 auto;
            .user {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    }

    
@media only screen and (max-width: 1024px) {
    section {
        .container {
            .user {
                justify-content: space-evenly;
            }
        }
    }
}

// @media only screen and (max-width: 425px) {
//     section {
//         .container {
//             .user {
//                 justify-content: space-evenly;
//             }
//         }
//     }
// }
</style>