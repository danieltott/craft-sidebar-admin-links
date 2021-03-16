var sidebarEnhancer = {
  init: function () {
    this.cacheVars();
    this.insertSidebar();
    this.getActive();
  },

  cacheVars: function () {
    this.sidebarString =
      String() +
      '<div id="extranav" class="system-menu">' +
      '    <span class="site-name">' +
      '        <h2>System</h2>' +
      '    </span>' +
      '    <ul>' +
      '        <li><a href="/admin/settings/general"><span class="icon icon-mask"><span data-icon="general"></span></span><span class="label">General</span></a></li>' +
      '        <li><a href="/admin/settings/sites"><span class="icon icon-mask"><span data-icon="general"></span></span><span class="label">Sites</span></a></li>' +
      '        <li><a href="/admin/settings/routes"><span class="icon icon-mask"><span data-icon="routes"></span></span><span class="label">Routes</span></a></li>' +
      '        <li><a href="/admin/settings/users"><span class="icon icon-mask"><span data-icon="users"></span></span><span class="label">Users</span></a></li>' +
      '        <li><a href="/admin/settings/email"><span class="icon icon-mask"><span data-icon="mail"></span></span><span class="label">Email</span></a></li>' +
      '        <li><a href="/admin/settings/plugins"><span class="icon icon-mask"><span data-icon="plugin"></span></span><span class="label">Plugins</span></a></li>' +
      '    </ul>' +
      '    <span class="site-name">' +
      '        <h2>Content</h2>' +
      '    </span>' +
      '    <ul>' +
      '        <li><a href="/admin/settings/fields"><span class="icon icon-mask"><span data-icon="field"></span></span><span class="label">Fields</span></a></li>' +
      '        <li><a href="/admin/settings/sections"><span class="icon icon-mask"><span data-icon="section"></span></span><span class="label">Sections</span></a></li>' +
      '        <li><a href="/admin/settings/assets"><span class="icon icon-mask"><span data-icon="assets"></span></span><span class="label">Assets</span></a></li>' +
      '        <li><a href="/admin/settings/globals"><span class="icon icon-mask"><span data-icon="globe"></span></span><span class="label">Globals</span></a></li>' +
      '        <li><a href="/admin/settings/categories"><span class="icon icon-mask"><span data-icon="categories"></span></span><span class="label">Categories</span></a></li>' +
      '        <li><a href="/admin/settings/tags"><span class="icon icon-mask"><span data-icon="tags"></span></span><span class="label">Tags</span></a></li>' +
      '    </ul>' +
      '</div>';

    this.activeClass = 'sel';

    this.$globalSidebarNav = document.querySelector('#global-sidebar nav');

    this.$sidebarNavItems = '';

    this.$settingsNavItem = document.querySelector('#nav-settings a');
  },

  insertSidebar: function () {
    this.$globalSidebarNav.insertAdjacentHTML('beforeend', this.sidebarString);

    // re-cache element now that it's in the DOM
    this.$sidebarNavItems = document.querySelectorAll('.system-menu a');
  },

  getActive: function () {
    var segments = window.location.pathname.split('/');
    var length = this.$sidebarNavItems.length;

    for (var i = 0; i < length; i++) {
      var $el = this.$sidebarNavItems[i];
      var name = $el.textContent.toLowerCase();

      if (
        segments.indexOf(name) !== -1 &&
        segments.indexOf('settings') !== -1
      ) {
        $el.classList.add(this.activeClass);
        this.$settingsNavItem.classList.remove(this.activeClass);
        break;
      }
    }
  },
};

// Call the initialize function
sidebarEnhancer.init();
