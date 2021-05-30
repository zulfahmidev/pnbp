let showSidebar = false;
let els = {};
function toggleSidebar() {
    if (showSidebar) {
        document.querySelector('#navbar .sidebar .nav').style.right = "-300px";
        setTimeout(function(){
            document.querySelector('#navbar .sidebar').style.display = 'none';
        }, 300)
        showSidebar = false;
    }else {
        document.querySelector('#navbar .sidebar').style.display = 'block';
        setTimeout(function(){
            document.querySelector('#navbar .sidebar .nav').style.right = 0;
        }, 20)
        showSidebar = true;
    }
}

function toggle(selector, bool = false, ev, textHide = '', textShow = '', display = 'block') {
    let el = document.querySelector(selector);
    if (els[selector]) {
        el.style.display = 'none';
        ev.innerHTML = textHide;
        els[selector] = false;
    }else {
        el.style.display = display;
        ev.innerHTML = textShow;
        els[selector] = true;
    }
}

function numberFormat(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function rand() {
    return Math.floor(Math.random() * 80);
}

function getData() {
    let data = null;
    $.getJSON("data.json", function(json) {
        data = json;
    });
    return data;
}

let vue = new Vue({
    el: '#app',
    data: {
        webData: null,
    },
    methods: {
        showChart1() {
            let data = {
                labels: [],
                datasets: [
                    {
                        label: "Target",
                        backgroundColor: "orange",
                        data: []
                    },
                    {
                        label: "Realisasi",
                        backgroundColor: "green",
                        data: []
                    }
                ]
            }
            for (const y in this.webData.c1_data) {
                if (Object.hasOwnProperty.call(this.webData.c1_data, y)) {
                    const element = this.webData.c1_data[y];
                    data.labels.push(element.label);
                    data.datasets[0].data.push(element.target);
                    data.datasets[1].data.push(element.realisasi);
                }
            }
            var myChart = new Chart(document.querySelector('#chart1').getContext('2d'), {
                type: 'bar',
                data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        },
        showChart2() {
            let data = {
                labels: [],
                datasets: [
                    {
                        label: "Target",
                        backgroundColor: "orange",
                        data: []
                    },
                    {
                        label: "Realisasi",
                        backgroundColor: "green",
                        data: []
                    }
                ]
            }
            for (const y in this.webData.c2_data) {
                if (Object.hasOwnProperty.call(this.webData.c2_data, y)) {
                    const element = this.webData.c2_data[y];
                    data.labels.push(element.label);
                    data.datasets[0].data.push(element.target);
                    data.datasets[1].data.push(element.realisasi);
                }
            }
            var myChart = new Chart(document.querySelector('#chart2').getContext('2d'), {
                type: 'bar',
                data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        },
        total(arr, index) {
            let total = 0;
            arr.forEach(el => {
                total += el[index];
            });
            return total;
        }
    },
    async created() {
        this.webData = await $.getJSON("data.json", json => {
            data = json;
            setTimeout(() => {
                this.showChart1();
                this.showChart2();
            }, 20)
        });
    },
    mounted() {

    }
});