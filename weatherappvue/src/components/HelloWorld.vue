<template>
  <div class="hello">
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full">
      <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
          <div class="navbar-header" data-logobg="skin6">
            <a class="navbar-brand" href="index.html">
              <b class="logo-icon">
                <img src="@/assets/logo.png"/>
              </b>

            </a>
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
              <i class="mdi mdi-menu"></i>
            </a>
          </div>
          <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-start me-auto"></ul>
            <ul class="navbar-nav float-end">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                   href="#"
                   id="navbarDropdown"
                   role="button"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">
                  <img src="@/assets/profile.png" alt="user" class="rounded-circle" width="31"/>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar">
          <nav class="sidebar-nav">
            <ul id="sidebarnav">
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)"
                   aria-expanded="false">
                  <i class="mdi mdi-view-dashboard"></i>
                  <span class="hide-menu"></span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
      <div class="page-wrapper border-top">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-lg-5 border-right">
              <div class="card border-0">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Weather Reports</h4>

                      <div class="row">
                        <div v-for="data in weatherReports" class="col-lg-4 rounded">
                          <div class="forecast text-white">
                            <div>
                              <div class="city_name">
                                {{ data.city }}
                              </div>
                              <div class="country_name"> {{ data.country }}</div>
                            </div>
                            <div class="text-center">
                              <img src="@/assets/thunder.png" class="img-fluid text-center">
                              <div class="temperature">
                                <span>{{ data.temperature }}</span>
                              </div>
                            </div>
                            <p><span id="fHumidity0"></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="amp-pxlx mt-4" style="height: 350px"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="card border-0">
                <div class="card-body">
                  <h4 class="card-title">Statistics</h4>
                  <h6>Temperature (Last 24 Hours)</h6>
                  <Temparature></Temparature>
                  <h6>Wind (Last 24 Hours)</h6>
                  <Wind></Wind>
                  <h6>Humidity (Last 24 Hours)</h6>
                  <Humidity></Humidity>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Temparature from './Temparature'
import Wind from './Wind'
import Humidity from './Humidity'
import axios from 'axios'

export default {
  name: 'HelloWorld',
  components: {Wind, Temparature, Humidity},
  data() {
    return {
      weatherReports: false
    }
  },
  methods: {
    async getWeatherReports() {
      const response = await axios.get('http://localhost/weatherapp/public/api/get-weather-reports')
      this.weatherReports = response.data
    }
  },
  async mounted() {
   await this.getWeatherReports()
  }

}
</script>

<style scoped src="../assets/css/style.min.css"></style>
