<template>
  <div class="git-stats__wrapper">
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
        <h3 class="title"><i class="fa fa-github"></i> Github stats</h3>
        <span class="pull-right">
          <a href="/personal/git-projects"><i class="fa fa-chevron-right"></i></a>
        </span>
      </div>
      <div class="tile-body">
        <table class="table table-bordered" v-if="!loading">
          <thead>
          <tr>
            <th>Name</th>
            <th>Stars</th>
            <th>Issues</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="repo in repos" :key="repo.id">
            <td>{{projectName(repo.project_url)}}</td>
            <td>{{repo.stars}}</td>
            <td>{{repo.issues}}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import _ from 'lodash';
  import axios from 'axios';
  import Vue from 'vue';
  export default {
    data() {
      return {
        loading: true,
        repos: []
      }
    },
    created() {
      axios.get('/api/git-projects/list').then(response => this.handleGitProjectList(response));

      window.eventBus.$on('gitProjectUpdate', data => {
        let project = data.gitProject;
        _.forEach(this.repos, (repo, key) => {
          if (repo.id == project.id) {
            Vue.set(this.repos, key, project);
          }
        });
      });
    },
    methods: {
      handleGitProjectList(response) {
        console.log('response', response);
        this.repos = response.data;
        this.loading = false;
      },
      projectName (url) {
        return _.upperFirst(_.replace(url, 'amitavroy/', ''));
      }
    }
  }
</script>
