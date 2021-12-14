<template>
        <form action="http://127.0.0.1:8000/messages" method="POST">
            <!-- equivalente del @csrf -->
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="user_id" :value="user_id">
            <div class="field">
                <label for="firstname">Nome</label>
                <input type="text" name="firstname" id="firstname" placeholder="Inserisci il tuo nome" required>
            </div>
            <div class="field">
                <label for="lastname">Cognome</label>
                <input type="text" name="lastname" id="lastname" placeholder="Inserisci il tuo cognome" required>
            </div>
            <div class="field">
                <label for="email">Indirizzo e-mail</label>
                <input 
                    pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" 
                    type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Inserisci il tuo indirizzo e-mail" 
                    oninvalid="setCustomValidity('Inserire un formato corretto')"
                    oninput="setCustomValidity('')"  
                    required>
            </div>
            <div class="field">
                <label for="text">Messaggio</label>
                <textarea name="text" id="text" rows="10" placeholder="Inserisci il contenuto del tuo messaggio" required></textarea>
            </div>

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


