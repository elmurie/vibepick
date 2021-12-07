<template>
    <div>
        <h1>{{$route.params.name}}</h1>
        <ul v-if="instrument != null">
            <li v-for="user in instrument.users" :key="user.id">{{user.firstname}} {{user.lastname}}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name : 'AdvancedSearch',
    data() {
        return {
            instrument : null
        }
    },
    mounted() {
        axios.get(`/api/instruments/${this.$route.params.name}`)
        .then( (response) => {
            this.instrument = response.data.data;
        })
    }
}
</script>