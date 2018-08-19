import _ from 'lodash';
import domready from 'domready';

domready(function() {
  const className = '.equal-height';
  const insideColClass = '.tile-body';

  _.forEach(document.querySelectorAll(className), element => {
    let height = 0;
    let innerDivs = element.querySelectorAll(insideColClass);
    _.forEach(innerDivs, node => {
      if (node.clientHeight > height) {
        height = node.clientHeight;
      }
    });
    _.forEach(innerDivs, node => {
      node.style.height = height + 'px';
    });
  });
});
