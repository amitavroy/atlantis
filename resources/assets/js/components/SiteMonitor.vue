<template>
  <div class="site-monitor__wrapper">
    <div class="tile">
      <div class="overlay" v-if="loading">
        <div class="m-loader mr-4">
          <svg class="m-circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
          </svg>
        </div>
        <h3 class="l-text">Loading</h3>
      </div>
      <div class="tile-title-w-btn">
        <h3 class="title">Sites</h3>
      </div>
      <div class="tile-body">
        <table class="table table-bordered" v-if="!loading">
          <thead>
            <tr>
              <th>Name</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="site in sites" v-bind:key='site.id'>
              <td>{{site.name}}</td>
              <td>{{site.avg_time}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import _ from 'lodash';
export default {
  created() {
    window.axios.get('/api/site/monitor').then(response => this.handleSiteData(response.data));
    window.eventBus.$on('siteMonitorDataUpdate', data => this.getSiteData(data.site));
    window.eventBus.$on('siteIsSlow', data => this.getSiteData(data.site));
  },
  data() {
    return {
      loading: true,
      sites: []
    }
  },
  methods: {
    handleSiteData(data) {
      this.sites = data;
      this.loading = false;
    },
    getSiteData(currentSite) {
      _.forEach(this.sites, (value, key) => {
        (value.id === currentSite.id) ? this.sites[key].avg_time = currentSite.avg_time : null;
      });
    }
  }
}
</script>
