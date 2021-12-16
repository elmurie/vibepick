<template>
    <div class="box-main-home">
        <h1>Pagina non trovata</h1>
        <a  href="javascript:history.back()">Torna alla pagina di prima</a>
        <br>
        <a href="/">Torna alla Home</a>
    </div>
</template>

<script>
export default {
    name : 'NotFound'
}
</script>

<style lang="scss" scoped>
    .box-main-home {
		max-width: 	1200px;
		margin: 0 auto;
		text-align: center;
		background-color: rgba(0, 0, 0, 0.068);
        margin-top: 3.125rem;
        padding: 30px 0
	}
    div{
        text-align: center;
        a{
            display: inline-block;
            margin-top: 10px;
                padding: 5px;
                border-radius: 7px;
            &:hover{
                background-color: white;
                color:black;
                transition: .4s;
            }
        }
    }
    
</style>