<template>
    <footer>
        <div>
            | Copyright &copy; VibePick 2021
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer'
}
</script>

<style lang="scss" scoped>
    footer {
        height: 50px;
        background-color: #353942;
        div{
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-right: 40px;
            height: 50px;
        }
    }
</style>