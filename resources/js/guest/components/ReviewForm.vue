<template>
        <form action="/reviews" name="review" method="POST">
            <!-- equivalente del @csrf -->
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="user_id" :value="user_id">
            <div class="field">
                <label for="author">Autore</label>
                <input
                    type="text"
                    name="author"
                    id="author"
                    v-on:keyup="contCharAuthor(50)"
                    placeholder="Inserisci il tuo nome e cognome"
                    required
                    oninvalid="setCustomValidity('Autore obbligatorio. Max: 50 caratteri')"
                    oninput="setCustomValidity('')"
                >
                <small id="charAuthor"></small>

            </div>
            <div class="field">
                <label for="title">Titolo</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    v-on:keyup="contCharTitle(50)"
                    placeholder="Inserisci il titolo della recensione"
                    required
                    oninvalid="setCustomValidity('Titolo obbligatorio. Max: 50 caratteri')"
                    oninput="setCustomValidity('')"
                >
                <small id="charTitle"></small>
            </div>
            <div class="field">
                <label for="content">Testo</label>
                <textarea 
                    name="content" 
                    id="content"
                    v-on:keyup="contCharText(1500)"
                    rows="10" 
                    placeholder="Inserisci il contenuto della recensione" 
                    required 
                    oninvalid="setCustomValidity('Testo obbligatorio. Max: 1500 caratteri')" 
                    oninput="setCustomValidity('')"
                >
                </textarea>
                <small id="charContent"></small>
            </div>
            <div class="field">
                <label for="vote">Voto</label>
                <input type="number" min="0" max="5" pattern="/[0-5]/m" name="vote" id="vote" placeholder="Da 0 a 5" required>
            </div>
            
            <button type="submit" name="" @click="controllLength(50, 50, 1500)" >Invia</button>
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
        controllLength: function(countAuthor, countTitle, countText) {
            if(document.review.author.value.length > countAuthor) {
                document.review.author.value = null;
            }
            if(document.review.title.value.length > countTitle) {
                document.review.title.value = null;
            }
            if(document.review.content.value.length > countText) {
                document.review.content.value = null;
            }
        },

        contCharAuthor: function(char) {
            let numChars = document.getElementById('author').value;
            document.getElementById('charAuthor').innerHTML = 'Caratteri rimanenti: '+ (char - numChars.length);
        },

        contCharTitle: function(char) {
            let numChars = document.getElementById('title').value;
            document.getElementById('charTitle').innerHTML ='Caratteri rimanenti: '+ (char - numChars.length);
        },

        contCharText: function(char) {
            let numChars = document.getElementById('content').value;
            document.getElementById('charContent').innerHTML = 'Caratteri rimanenti: '+ (char - numChars.length);
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


