<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">My Expenses</div>
            <div class="card-body">
                <canvas id="doughnut"></canvas>
            </div>
        </div>
    </div>
</template>

<script>

  export default {
    data() {
      return {
          categories: null,
          expenses: null
      }     
    },

    mounted(){
        this.fetch();
    },

    methods: {
        fetch(){
            this.$http({
                url: `dashboard`,
                method: 'GET'
            })
            .then((res) => {
                this.categories = res.data.categories
                this.expenses = res.data.expenses
                this.createChart('doughnut');
            }, () => {

            })

        },

        createChart(chartId){
            const ctx = document.getElementById(chartId);
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: this.categories,
                    datasets: [{
                        data: this.expenses,
                        backgroundColor: [
                            '#4e73df', 
                            '#1cc88a', 
                            '#36b9cc',
                            'red',
                            'blue',
                            'yellow'
                        ],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 20,
                        yPadding: 20,
                        displayColors: false,
                        caretPadding: 10,
                    },
        
                },
            });
        }

    },
    components: {

    }
  }
</script>