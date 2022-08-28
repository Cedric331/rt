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
                <div v-else class="flex justify-center w-full my-5">
                    Aucune information
                </div>
                <div v-if="this.$page.props.auth.isAdmin">
                    <button @click="resetData()" aria-label="dashboard" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto rounded text-xs sm:text-sm relative flex items-center rounded-full space-x-3 bg-cyan-600 mt-2 text-white hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                            <path fill-rule="evenodd" d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.133 2.845a.75.75 0 011.06 0l1.72 1.72 1.72-1.72a.75.75 0 111.06 1.06l-1.72 1.72 1.72 1.72a.75.75 0 11-1.06 1.06L12 15.685l-1.72 1.72a.75.75 0 11-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                        <span class="-mr-1 font-bold">Reset les données</span>
                    </button>
                </div>
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
                    data: [],
                    backgroundColor: [
                        'rgb(255, 80, 132)',
                        'rgb(99, 10, 132)',
                        'rgb(60, 74, 215)',
                        'rgb(1, 201, 150)',
                        'rgb(255, 205, 86)',
                        'rgb(224, 78, 78)',
                        'rgb(60, 223, 221)',
                        'rgb(30, 201, 21)',
                        'rgb(203, 64, 201)'
                    ],
                    hoverOffset: 9
                }]
            },
            chartOptions: {
                responsive: true
            }
        }
    },
    methods: {
        resetData () {
            let uses = []
            this.loaded = false
            axios.get('chart/reset')
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
        },
        getData () {
            let uses = []
            this.loaded = false
            axios.get('chart/refresh')
                .then(response => {
                    response.data.forEach(item => {
                        this.chartData.labels.push(item.name)
                        uses.push(item.use_rt)
                        if (item.use_rt > 0) {
                            this.loaded = true
                        }
                    })
                    this.chartData.datasets[0].data = uses
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    mounted () {
        this.getData()
    }
}
</script>
