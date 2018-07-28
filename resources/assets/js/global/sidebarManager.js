class SideBarManager {
  constructor() {
    this.className = 'is-expanded';
    this.menuList = document.querySelectorAll('.treeview');
    [].forEach.call(this.menuList, (menuList) => {
      menuList.addEventListener('click', () => this.handleMenuClick(menuList));
    });
  }

  handleMenuClick(element) {
    if (element.classList.contains(this.className)) {
      element.classList.remove(this.className);
    } else {
      this.resetAllMenu();
      element.classList.add(this.className);
    }
  }

  resetAllMenu() {
    [].forEach.call(this.menuList, menuList => {
      menuList.classList.remove(this.className);
    });
  }
}

export default SideBarManager;
