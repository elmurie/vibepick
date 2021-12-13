<template>
    <div>
        <form action="http://127.0.0.1:8000/admin/reviews" method="POST">
            <!-- equivalente del @csrf -->
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="user_id" :value="user_id">
            <label for="author">Inserisci il tuo nome e il tuo cognome</label>
            <input type="text" name="author" id="author">

            <label for="title">Inserisci il titolo della tua recensione</label>
            <input type="text" name="title" id="title">

            <label for="content">Inserisci il contenuto della tua recensione</label>
            <input type="text" name="content" id="content">

            <label for="vote">Inserisci un voto da 0 a 5</label>
            <input type="num" name="vote" id="vote">
            
            <button type="submit" name="">Invia</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'ReviewForm',
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            user_id : ''
        }
    },

    mounted() {
            this.user_id = this.$route.params.id;
        }

}
</script>

<style lang="scss" scoped>
    form {
        width: 40%;
        display: flex;
        flex-direction:column;
    }

    button {
        width: 2.5rem;
    }

</style>


