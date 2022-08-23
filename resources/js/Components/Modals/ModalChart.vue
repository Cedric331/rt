<template>
    <div class="relative z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="inline-block align-bottom p-4 bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <Pie
                        v-if="loaded"
                        :chart-options="chartOptions"
                        :chart-data="chartData"
                        :chart-id="chartId"
                        :dataset-id-key="datasetIdKey"
                        :plugins="plugins"
                        :css-classes="cssClasses"
                        :styles="styles"
                        :width="width"
                        :height="height"
                    />
                </div>
        </div>
    </div>
</template>

<script>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, CategoryScale, LinearScale } from 'chart.js'
import axios from "axios";

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale, LinearScale)

export default {
    name: 'ModalChart',
    components: { Pie },
    props: {
        chartId: {
            type: String,
            default: 'pie-chart'
        },
        datasetIdKey: {
            type: String,
            default: 'label'
        },
        // width: {
        //     type: Number,
        //     default: 100
        // },
        // height: {
        //     type: Number,
        //     default: 100
        // },
        cssClasses: {
            default: 'z-30',
            type: String
        },
        // styles: {
        //     type: Object,
        //     default: () => {}
        // },
        plugins: {
            type: Object,
            default: () => {}
        }
    },
    data() {
        return {
            loaded: false,
            chartData: {
                labels: [],
                datasets: [{
                    label: 'Utilisation des RT',
                    data: [1,54,5,496],
                    backgroundColor: [
                        'rgb(255, 80, 132)',
                        'rgb(60, 74, 215)',
                        'rgb(255, 205, 86)',
                        'rgb(224, 78, 78)',
                        'rgb(60, 223, 221)',
                        'rgb(30, 201, 21)',
                        'rgb(203, 64, 201)'
                    ],
                    hoverOffset: 7
                }]
            },
            chartOptions: {
                responsive: true
            }
        }
    },
    methods: {
        // refreshChart () {
        //     this.chartData.labels = []
        //     axios.get('chart/refresh')
        //     .then(response => {
        //         response.data.forEach(item => {
        //             this.chartData.labels += item.name
        //         })
        //     })
        //     .catch(err => {
        //         console.log(err)
        //     })
        // }
    },
    beforeMount () {
        let uses = []
        this.loaded = false
        axios.get('chart/refresh')
            .then(response => {
                response.data.forEach(item => {
                    this.chartData.labels.push(item.name)
                    uses.push(item.use_rt)
                })
                this.chartData.datasets[0].data = uses
                this.loaded = true
            })
            .catch(err => {
                console.log(err)
            })
    }
}
</script>
