<template>
  <GChart
    type="LineChart"
    :data="chartData"
    :options="chartOptions"
  />
</template>

<script>
import {GChart} from 'vue-google-charts/legacy'
import axios from "axios";

export default {
  name: 'Wind',
  components: {
    GChart
  },
  data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartData: [
        ['Hour', 'Wind']
      ],
      chartOptions: {
        chart: {
          title: 'Wind'
        }
      }
    }
  },
  async mounted () {
    const response = await axios.get('http://localhost/weatherapp/public/api/get-wind')
    // console.log(response.data)
    let vb = response.data.all
    let arr = this.chartData
    vb.forEach( function (item, index) {
      arr.push([item.hour, item.speed])
    })
    // console.log(arr)
  }

}
</script>

<style scoped>

</style>
