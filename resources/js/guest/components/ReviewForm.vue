<template>
        <form action="/reviews" name="review" method="POST">
            <!-- equivalente del @csrf -->
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="user_id" :value="user_id">
            <div class="field">
                <label for="author">Autore</label>
                <input type="text" name="author" id="author" placeholder="Inserisci il tuo nome e cognome" required oninvalid="setCustomValidity('Autore obbligatorio. Max: 50 caratteri')" oninput="setCustomValidity('')">
            </div>
            <div class="field">
                <label for="title">Titolo</label>
                <input type="text" name="title" id="title" placeholder="Inserisci il titolo della recensione" required>
            </div>
            <div class="field">
                <label for="content">Testo</label>
                <textarea name="content" id="content" rows="10" placeholder="Inserisci il contenuto della recensione" required></textarea>
            </div>
            <div class="field">
                <label for="vote">Voto</label>
                <input type="number" min="0" max="5" pattern="/[0-5]/m" name="vote" id="vote" placeholder="Da 0 a 5" required>
            </div>
            
            <button type="submit" name="" @click="controllLength()" >Invia</button>
        </form>
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

    methods : {
        controllLength: function() {
            if(document.review.author.value.length > 50) {
                document.review.author.value = null;
            } else {
                return document.review.author.value;
            }
            
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
        .field {
            display: flex;
            flex-direction: column;
            margin: .625rem 0;
            label {
                margin-bottom: .3125rem;
            }
            input,
            textarea {
                padding: .3125rem;
                font-family: 'Ubuntu', sans-serif;
            }
            [type="number"] {
                width: 30%;
            }
        }
        button {
            color: #ffffff;
            background-color: #f39200;
            border: none;
            border-radius: 1.5625rem;
            padding: .625rem 1.25rem;
            margin: 1.25rem 0;
            align-self: flex-end;
            transition-duration: .5s;
            opacity: .7;
            &:hover {
                opacity: 1;
                cursor: pointer;
            }
        } 
            
    }

</style>


