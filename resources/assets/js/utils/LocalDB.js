var localDB = {
  getData (key) {
    if (!localStorage.getItem(key)) {
      return false;
    }
    return JSON.parse(localStorage.getItem(key));
  },
  setData (key, data) {
    localStorage.setItem(key, JSON.stringify(data));
  }
}

export default localDB;
