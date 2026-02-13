import _ from 'lodash';
window._ = _;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// Minimal collapse behavior for the top navbar.
$(document).on('click', '[data-toggle="collapse"]', function (e) {
  var target = $(this).attr('data-target');
  if (!target) {
    return;
  }

  var $target = $(target);
  if (!$target.length) {
    return;
  }

  e.preventDefault();
  $target.toggleClass('in');
});
