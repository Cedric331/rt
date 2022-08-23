<template>
    <div class="relative z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div>
                    <Pie
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
            chartData: {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100, 150, 90],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(150, 100, 255)',
                        'rgb(200, 200, 200)'
                    ],
                    hoverOffset: 4
                }]
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>
