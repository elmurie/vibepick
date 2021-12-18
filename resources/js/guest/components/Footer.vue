<template>
    <footer>
        <div class="box-footer-fo">
            <div class="box-logo-footer-fo">
                <img src="storage/img/logo_pick_white.png" alt="">
            </div>
            <div>| Copyright &copy; VibePick 2021</div>
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
    background-color: #353942;
    .box-footer-fo{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-right: 40px;
        height: 45px;
        .box-logo-footer-fo {
            height: 18px;
            img {
                height: 100%;
            }
        }
    }
}
</style>