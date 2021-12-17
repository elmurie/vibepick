<template>
    <div class="animation">
				<div class="bar bar-1" ></div>
				<div class="bar bar-1"></div>
				<div class="bar bar-1"></div>
				<div class="bar bar-1"></div>
				<div class="bar bar-1"></div>
				<div class="bar bar-1"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-6"></div>
				<div class="bar bar-8"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-10"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-4"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-2"></div>
				<div class="bar bar-1"></div>
			</div>
</template>

<script>
import anime from 'animejs/lib/anime.min.js';
export default {
    name: 'Animation',
    mounted(){
			let tl = anime.timeline({
				duration: 500,
				loop: true,
				easing: 'linear',
				direction : 'normal'
			})
			tl.add({
                targets : '.bar',
                rotateX : 180, 
				opacity : 1,
				delay : anime.stagger(50)
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				},
                delay: 500,
                loop: true
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				}
			})
			.add({
				targets : '.bar', 
                opacity: 0,
				height : function() {
					return Math.floor(Math.random() * (250 - 20) + 20);
				},
                delay: anime.stagger(20, {from: 'last'})
			});
		}
}
</script>
<style lang="scss" scoped>
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
			opacity: 0;
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

	@media screen and (max-width: 767px) {
		.animation {
			top: 85px;
		}
	}
</style>