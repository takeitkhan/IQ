<template>
  <GChart
    type="ColumnChart"
    :data="chartData"
    :options="chartOptions"
  />
</template>

<script>
import {GChart} from 'vue-google-charts/legacy'
import axios from "axios";

export default {
  name: 'Humidity',
  components: {
    GChart
  },
  data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartData: [
        ['Hour', 'Humidity']
      ],
      chartOptions: {
        chart: {
          title: 'Humadity'
        }
      }
    }
  },
  async mounted () {
    const response = await axios.get('http://localhost/weatherapp/public/api/get-humidity')
    // console.log(response.data)
    let vb = response.data
    let arr = this.chartData
    vb.forEach(function (item, index) {
      arr.push([item.hour, item.humidity])
    })
    // console.log(arr)
  }
}
</script>

<style scoped>

</style>
