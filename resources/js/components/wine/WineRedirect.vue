<template>
    <div>
        <div class="alert alert-success" role="alert">
            {{ status }}
            <br/>
                and
            <br/>
            You will be redirected to the List Page.
        </div>
        <div id="timer">
        <div class="base-timer">
                <svg
                    class="base-timer__svg"
                    viewBox="0 0 100 100"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g class="base-timer__circle">
                        <circle
                            class="base-timer__path-elapsed"
                            cx="50"
                            cy="50"
                            r="45"
                        />
                        <path
                            :stroke-dasharray="circleDasharray"
                            class="base-timer__path-remaining"
                            d="
                        M 50, 50
                        m -45, 0
                        a 45,45 0 1,0 90,0
                        a 45,45 0 1,0 -90,0
                      "></path>
                    </g>
                </svg>
                <span class="base-timer__label">
                      <!-- Remaining time label -->
                    {{ formattedTimeLeft }}
                </span>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                status: '',
                timeLimit: 20,
                timePassed: 0,
                timerInterval: null,
            }
        },
        props:
            ['statusInfo', 'goLink', 'waitingTime'],
        computed:{
            timeLeft() {
                return this.timeLimit - this.timePassed
            },
            formattedTimeLeft() {

                const timeLeft = this.timeLeft

                // The Largest round integer less than or equal to the result of time divided being by 60
                const minutes = Math.floor(timeLeft/60)

                // Seconds are the remainder of the time divided by 60  (modulus operator)
                let seconds = timeLeft % 60

                // If the value of seconds is less than 10, then display seconds with a leading zero
                if (seconds < 10) {
                  seconds = `0${seconds}`
                }

                return `${minutes}:${seconds}`
            },
            // update the dasharray value as time passes, starting with 283
            circleDasharray() {
                const FULL_DASH_ARRAY = 283;
                return `${(this.timeFraction * FULL_DASH_ARRAY).toFixed(0)} 283`;
            },
            timeFraction() {
                const rawTimeFraction = this.timeLeft / this.timeLimit;
                // Divided timeLeft by the defined time limit.
                return rawTimeFraction - ( 1 / this.timeLimit )  * ( 1 - rawTimeFraction);
            }
        },
        mounted() {
            this.startCounting();
            this.timeLimit = this.waitingTime;
            this.status = this.statusInfo;
            this.redirectPage();
        },
        methods: {
            startCounting() {
                this.timerInterval = setInterval(()=>(this.timePassed+=1),1000);
            },
            redirect: function () {
                window.location.replace(this.goLink);
            },
            redirectPage: function () {
                setTimeout(this.redirect, this.timeLimit * 1000);
            },
        }
    }
</script>


