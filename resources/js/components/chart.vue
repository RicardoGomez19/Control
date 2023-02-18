<template>
    <div>
    <LineChartGenerator
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
  </template>

  <script>
  import { Line as LineChartGenerator } from 'vue-chartjs/legacy'
  import AtvApi from '../api/AtvApi'
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    CategoryScale,
    PointElement
  } from 'chart.js'

  ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    CategoryScale,
    PointElement
  )

  export default {
    name: 'LineChart',
    components: {
      LineChartGenerator
    },
    props: {
      chartId: {
        type: String,
        default: 'line-chart'
      },
      datasetIdKey: {
        type: String,
        default: 'label'
      },
      width: {
        type: Number,
        default: 400
      },
      height: {
        type: Number,
        default: 300
      },
      cssClasses: {
        default: '',
        type: String
      },
      styles: {
        type: Object,
        default: () => {}
      },
      plugins: {
        type: Array,
        default: () => []
      }
    },
    data() {
      return {
        chartData: {
          labels: [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Septiembre',
            'Agosto',
            'Octubre',
            'Noviembre',
            'Diciembre'
          ],
          datasets: [
            {
              label: 'Egreso',
              backgroundColor: '#f87979',
              data: []
            },
            {
              label: 'Ingreso',
              backgroundColor: 'black',
              data: [10, 72, 20, 30, 59, 30, 12]
            }
          ]
        },
        chartOptions: {
          responsive: true,
          maintainAspectRatio: false
        },

        mesesIngreso:{
            Enero:[],
            Febrero:[],
            Marzo:[],
            Abril:[],
            Mayo:[],
            Junio:[],
            Julio:[],
            Septiembre:[],
            Agosto:[],
            Octubre:[],
            Noviembre:[],
            Diciembre:[],
        },

        mesesEgreso:{
            Enero:[],
            Febrero:[],
            Marzo:[],
            Abril:[],
            Mayo:[],
            Junio:[],
            Julio:[],
            Septiembre:[],
            Agosto:[],
            Octubre:[],
            Noviembre:[],
            Diciembre:[],
        }
      }
    },
    mounted(){
        this.obtenerEgresos()
    },
    methods:{
        async obtenerEgresos(){
            const { data } = await AtvApi.get('/egresosyear')
            // this.EgresosYearActual = data

            this.insertarDatosPorMes( this.mesesEgreso, data[0])
            this.insertarDatosPorMes( this.mesesIngreso, data[1])

            this.chartData.datasets[0].data = [
                this.sacarGastoMes(this.mesesEgreso.Enero),
                this.sacarGastoMes(this.mesesEgreso.Febrero),
                this.sacarGastoMes(this.mesesEgreso.Marzo),
                this.sacarGastoMes(this.mesesEgreso.Abril),
                this.sacarGastoMes(this.mesesEgreso.Mayo),
                this.sacarGastoMes(this.mesesEgreso.Junio),
                this.sacarGastoMes(this.mesesEgreso.Julio),
                this.sacarGastoMes(this.mesesEgreso.Agosto),
                this.sacarGastoMes(this.mesesEgreso.Septiembre),
                this.sacarGastoMes(this.mesesEgreso.Octubre),
                this.sacarGastoMes(this.mesesEgreso.Noviembre),
                this.sacarGastoMes(this.mesesEgreso.Diciembre)
            ]

            this.chartData.datasets[1].data = [
                this.sacarGastoMes(this.mesesIngreso.Enero),
                this.sacarGastoMes(this.mesesIngreso.Febrero),
                this.sacarGastoMes(this.mesesIngreso.Marzo),
                this.sacarGastoMes(this.mesesIngreso.Abril),
                this.sacarGastoMes(this.mesesIngreso.Mayo),
                this.sacarGastoMes(this.mesesIngreso.Junio),
                this.sacarGastoMes(this.mesesIngreso.Julio),
                this.sacarGastoMes(this.mesesIngreso.Agosto),
                this.sacarGastoMes(this.mesesIngreso.Septiembre),
                this.sacarGastoMes(this.mesesIngreso.Octubre),
                this.sacarGastoMes(this.mesesIngreso.Noviembre),
                this.sacarGastoMes(this.mesesIngreso.Diciembre)
            ]

        },//fin funcion obtener datos


        sacarGastoMes( mes = [] ){
            let totalfinal = 0

            mes.forEach(Element => {

                totalfinal += Element.total ? Element.total : Element.cantidad
            })
            return totalfinal
        },
        insertarDatosPorMes( ruta, datos){
            datos.forEach(egreso => {

                const datafind = egreso.fecha ? egreso.fecha  : egreso.fecha_hora

                const date = new Date(datafind)
                const mesEgreso = date.getMonth() + 1
                switch (mesEgreso) {
                    case 1:
                        ruta.Enero.push(egreso)
                    break;
                    case 2:
                        ruta.Febrero.push(egreso)
                    break;
                    case 3:
                        ruta.Marzo.push(egreso)
                    break;
                    case 4:
                        ruta.Abril.push(egreso)
                    break;
                    case 5:
                        ruta.Mayo.push(egreso)
                    break;
                    case 6:
                        ruta.Junio.push(egreso)
                    break;
                    case 7:
                        ruta.Julio.push(egreso)
                    break;
                    case 8:
                        ruta.Agosto.push(egreso)
                    break;
                    case 9:
                        ruta.Septiembre.push(egreso)
                    break;
                    case 10:
                        ruta.Octubre.push(egreso)
                    break;
                    case 11:
                        ruta.Noviembre.push(egreso)
                    break;
                    case 12:
                        ruta.Diciembre.push(egreso)
                    break;
                    default:
                        console.log('no hay')
                    break;
                }
            });
        }
    }

  }
  </script>
