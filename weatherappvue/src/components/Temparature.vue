<template>
  <div>
    <GChart
      type="LineChart"
      :data="chartData"
      :options="chartOptions"
    />
  </div>
</template>

<script>
import {GChart} from 'vue-google-charts/legacy'
import axios from 'axios'
export default {
  name: 'Temparature',
  components: {
    GChart
  },

  data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartData : [
        ['Hour', 'Celsius']
      ],
      chartOptions: {
        chart: {
          title: 'Temparature'
        }
      }
    }
  },
  async mounted () {
    const response = await axios.get('http://localhost/weatherapp/public/api/get-temperature')
    // console.log(response.data)
    let vb = response.data
    let arr = this.chartData
    vb.forEach(function(item, index){
      arr.push([item.hour, item.temperature])
    })
    // console.log(arr)
  }

}
</script>

<style scoped>

</style>
