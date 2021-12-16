<template>
    <div class="waveWrapper waveAnimation">
		<div class="waveWrapperInner bgBottom">
			<div class="wave waveBottom" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-bot.png')"></div>
		</div>
	</div>
</template>

<script>
export default {
    name: 'BgFrontOffice'
}
</script>

<style lang="scss" scoped>
@keyframes move_wave {
	0% {
		transform: translateX(0) translateZ(0) scaleY(1)
	}
	50% {
		transform: translateX(-25%) translateZ(0) scaleY(0.55)
	}
	100% {
		transform: translateX(-50%) translateZ(0) scaleY(1)
	}
}
.waveWrapper {
	overflow: hidden;
	position: absolute;
	z-index: -20;
	left: 0;
	right: 0;
	bottom: 0;
	top: 0;
	margin: auto;
}
.waveWrapperInner {
	position: absolute;
	width: 100%;
	overflow: hidden;
	height: 100%;
	bottom: -1px;
	background-image: linear-gradient(to top, #2c81cf 20%, #27273c 80%);
}
.bgBottom {
	z-index: 5;
}
.wave {
	position: absolute;
	left: 0;
	width: 200%;
	height: 100%;
	background-repeat: repeat no-repeat;
	background-position: 0 bottom;
	transform-origin: center bottom;
}
.waveAnimation {
	animation: move-wave 3s;
	-webkit-animation: move-wave 3s;
	-webkit-animation-delay: 1s;
	animation-delay: 1s;
}
.waveBottom {
	background-size: 50% 200px;
}
.waveAnimation .waveBottom {
	animation: move_wave 20s linear infinite;
}
    
</style>