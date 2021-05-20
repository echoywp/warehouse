<style scoped>
    .countdown {
        display: inline-block;
        width: 100%;
        color: #e3e3e3;
        text-align: center;
        font-size: 18px;
    }
    .countdown p {
        display: inline-block;
        margin-right: 5px;
        font-style: italic;
    }

</style>

<template>
    <span class="countdown"><p> {{time}} </p>秒后自动跳转到首页</span>
</template>

<script>
    export default {
        name: 'countdown',
        props: {},
        data() {
            return {
                timer: true,
                time: 5
            }
        },
        created() {
            this.timerReduce()
        },
        methods: {
            timerReduce() {
                console.log(this.time)
                this.timer = setInterval(()=>{
                    if(this.time > 0 ){
                        this.time--
                    }else{
                        clearInterval(this.timer);
                        window.location.href = '/'
                    }
                },1000)
            }
        }
    }
</script>

<style scoped>

</style>
