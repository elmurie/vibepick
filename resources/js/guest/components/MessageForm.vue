<template>
        <form action="http://127.0.0.1:8000/messages" method="POST">
            <!-- equivalente del @csrf -->
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="user_id" :value="user_id">
            <label for="firstname">Inserisci il tuo nome</label>
            <input type="text" name="firstname" id="firstname">

            <label for="lastname">Inserisci il tuo cognome</label>
            <input type="text" name="lastname" id="lastname">

            <label for="email">Inserisci la tua email</label>
            <input type="text" name="email" id="email">

            <label for="text">Inserisci il contenuto del tuo messaggio</label>
            <textarea name="text" id="text" rows="10"> </textarea>

            <button type="submit" name="">Invia</button>
        </form>
</template>

<script>
export default {
    name: 'MessageForm',
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
        width: 90%;
        margin: 0 auto;
        display: flex;
        flex-direction:column;
    }

    button {
        width: 2.5rem;
    }

</style>


