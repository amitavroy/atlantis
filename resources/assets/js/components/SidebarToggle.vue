<template>
  <a class="app-sidebar__toggle"
     href="#"
     data-toggle="sidebar"
     aria-label="Hide Sidebar"
     @click="handleSidebarToggle"
  ></a>
</template>

<script>
  export default {
    data() {
      return {
        toggled: false,
        className: 'sidenav-toggled'
      }
    },
    methods: {
      handleSidebarToggle() {
        let classes = document.querySelector('body').classList;
        if (classes.contains(this.className) === true) {
          this.removeSidebarClass(classes);
        } else {
          this.addSidebarClass(classes);
        }
      },
      removeSidebarClass(classes) {
        classes.remove(this.className);
      },
      addSidebarClass(classes) {
        classes.add(this.className);
      }
    }
  }
</script>
