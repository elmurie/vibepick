<template>
	<div>
		<!-- <Header/> -->
		<main>
			<div class="animation">
				<div class="bar bar-1 beta epsilon" ></div>
				<div class="bar bar-2 gamma epsilon"></div>
				<div class="bar bar-4 beta zeta kappa"></div>
				<div class="bar bar-6 gamma epsilon"></div>
				<div class="bar bar-8 gamma zeta epsilon"></div>
				<div class="bar bar-1 beta delta kappa"></div>
				<div class="bar bar-1 beta epsilon"></div>
				<div class="bar bar-1 beta zeta"></div>
				<div class="bar bar-2 beta epsilon"></div>
				<div class="bar bar-2 gamma delta epsilon"></div>
				<div class="bar bar-2 gamma zeta kappa"></div>
				<div class="bar bar-2 gamma delta epsilon"></div>
				<div class="bar bar-8 alfa epsilon"></div>
				<div class="bar bar-8 alfa delta kappa"></div>
				<div class="bar bar-8 alfa delta"></div>
				<div class="bar bar-8 alfa delta kappa"></div>
				<div class="bar bar-10 beta epsilon"></div>
				<div class="bar bar-10 beta epsilon"></div>
				<div class="bar bar-2 gamma delta"></div>
				<div class="bar bar-2 beta zeta kappa"></div>
				<div class="bar bar-2 beta epsilon"></div>
				<div class="bar bar-2 beta epsilon"></div>
				<div class="bar bar-4 beta epsilon"></div>
				<div class="bar bar-4 gamma zeta"></div>
				<div class="bar bar-4 gamma delta"></div>
				<div class="bar bar-4 gamma zeta kappa"></div>
				<div class="bar bar-6 alfa epsilon"></div>
				<div class="bar bar-6 alfa zeta kappa"></div>
				<div class="bar bar-8 alfa delta kappa"></div>
				<div class="bar bar-8 alfa zeta kappa"></div>
				<div class="bar bar-8 alfa delta"></div>
				<div class="bar bar-8 alfa epsilon"></div>
				<div class="bar bar-8 alfa delta"></div>
				<div class="bar bar-10 alfa zeta"></div>
				<div class="bar bar-10 alfa epsilon"></div>
				<div class="bar bar-10 alfa delta"></div>
				<div class="bar bar-10 beta zeta"></div>
				<div class="bar bar-8 gamma delta"></div>
				<div class="bar bar-10 gamma kappa"></div>
				<div class="bar bar-4 gamma zeta"></div>
				<div class="bar bar-4 gamma zeta"></div>
				<div class="bar bar-4 gamma delta"></div>
				<div class="bar bar-6 gamma delta"></div>
				<div class="bar bar-6 alfa kappa"></div>
				<div class="bar bar-8 alfa epsilon"></div>
				<div class="bar bar-4 alfa epsilon"></div>
				<div class="bar bar-4 alfa delta"></div>
				<div class="bar bar-4 alfa epsilon"></div>
				<div class="bar bar-4 beta delta"></div>
				<div class="bar bar-2 beta kappa"></div>
				<div class="bar bar-10 beta delta"></div>
				<div class="bar bar-10 beta zeta"></div>
				<div class="bar bar-4 alfa epsilon"></div>
				<div class="bar bar-4 alfa delta"></div>
				<div class="bar bar-4 alfa epsilon"></div>
				<div class="bar bar-4 beta epsilon"></div>
				<div class="bar bar-2 alfa delta"></div>
				<div class="bar bar-2 beta epsilon"></div>
				<div class="bar bar-2 beta delta"></div>
				<div class="bar bar-1 alfa zeta"></div>
			</div>
			<router-view></router-view>
		</main>
		<Footer/>
	</div>
</template>

<script>
import anime from 'animejs/lib/anime.min.js';
import Header from './components/Header';
import Footer from './components/Footer';
export default {
	name: 'App',
	components: {
		Header,
		Footer,
	},
	data() {
		return {
			instruments : []
		}
	},
	mounted(){
			let tl = anime.timeline({
				duration: 200,
				loop: true,
				easing: 'linear',
				direction : 'alternate'
			})
			tl.add({
				targets : '.alfa', 
				height : 140
			})
			.add({
				targets : '.beta', 
				height : 160
			})
			.add({
				targets : '.gamma', 
				height : 100

			})
			.add({
				targets : '.delta', 
				height : 160
			})
			.add({
				targets : '.epsilon', 
				height : 80
			})
			.add({
				targets : '.zeta', 
				height : 140
			})
			.add({
				targets : '.bar', 
				height : 180
			})
			.add({
				targets : '.delta', 
				height : 110
			})
			.add({
				targets: '.alfa',
				height: 180
			})
			.add({
				targets: '.beta',
				height : 160
			})
			.add({
				targets: '.epsilon',
				height : 200

			})
			.add({
				targets: '.zeta',
				height: 100
			})
			.add({
				targets: '.gamma',
				height: 160
			})
			.add({
				targets: '.bar',
				height: 150
			})
			.add({
				targets: '.kappa',
				height: 180
			})
			.add({
				targets: '.bar',
				height: 200,
			})
			.add({
				targets : '.beta', 
				height : 160
			})
			.add({
				targets : '.gamma', 
				height : 100

			})
			.add({
				targets : '.delta', 
				height : 160
			})
			.add({
				targets : '.epsilon', 
				height : 80
			})
			.add({
				targets : '.zeta', 
				height : 140
			})
			.add({
				targets : '.bar', 
				height : 180
			})
			.add({
				targets : '.delta', 
				height : 110
			})
			.add({
				targets: '.alfa',
				height: 180
			})
			.add({
				targets: '.beta',
				height : 160
			})
			.add({
				targets: '.epsilon',
				height : 200

			})
			.add({
				targets: '.zeta',
				height: 100
			})
			.add({
				targets: '.gamma',
				height: 160
			})
			.add({
				targets: '.bar',
				height: 150
			})
			.add({
				targets: '.kappa',
				height: 180
			})
			.add({
				targets: '.bar',
				height: 200,
			})
			.add({
				targets: '.beta',
				height : 160
			})
			.add({
				targets : '.gamma', 
				height : 100

			})
			.add({
				targets : '.delta', 
				height : 160
			})
			.add({
				targets : '.epsilon', 
				height : 80
			})
			.add({
				targets : '.zeta', 
				height : 140
			})
			.add({
				targets : '.bar', 
				height : 180
			})
			.add({
				targets : '.delta', 
				height : 110
			})
			.add({
				targets: '.alfa',
				height: 180
			})
			.add({
				targets: '.beta',
				height : 160
			})
			.add({
				targets: '.epsilon',
				height : 200

			})
			.add({
				targets: '.zeta',
				height: 100
			})
			.add({
				targets: '.gamma',
				height: 160
			})
			.add({
				targets: '.bar',
				height: 150
			})
			.add({
				targets: '.kappa',
				height: 180
			})
			.add({
				targets: '.bar',
				height: 200,
			})
			.add({
				targets: '.beta',
				height : 160
			})
			.add({
				targets: '.epsilon',
				height : 200

			})
			.add({
				targets: '.zeta',
				height: 100
			})
			.add({
				targets: '.gamma',
				height: 160
			})
			.add({
				targets: '.bar',
				height: 150
			})
			.add({
				targets: '.kappa',
				height: 180
			})
			.add({
				targets: '.bar',
				height: 200,
			});
		}

}
</script>
<style lang="scss">
	main {
		z-index: 2;
		position: relative;
		height: calc(100vh - 120px);
		background: #0a5a90;
		overflow: auto;
		overflow-x: hidden;
	}
	.animation {
		z-index: -1;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		display: flex;
		justify-content: center;
		align-items: center;
		.bar {
			margin: 0 10px;
			width: 20px;
			background-color: #213e74;
			border-radius: 25px;
			flex-shrink: 0;
		}
		.bar-1 {
			height: 20px;
		}
		.bar-2 {
			height: 40px;
		}
		.bar-4 {
			height: 80px;
		}
		.bar-6 {
			height: 120px;
		}
		.bar-8 {
			height: 160px;
		}
		.bar-10 {
			height: 200px;
		}
	}
</style>