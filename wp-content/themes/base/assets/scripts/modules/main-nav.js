const MainNav = {
  init() {
    this.ToggleNav();
  },
  ToggleNav() {
    // toggle mobile main navigation menu
    const body = $('body');
    const navToggle = $('.main-nav-toggle');
    const mainNav = $('.main-nav');

    navToggle.on('click', () => {
      navToggle.attr('aria-expanded', (i, attr) =>
        attr === 'true' ? 'false' : 'true'
      );

      if (body.hasClass('menu-open')) {
        mainNav.css({ opacity: 0, visibility: 'hidden' });

        setTimeout(() => {
          body.removeClass('menu-open');

          mainNav.css({ opacity: '', visibility: '' });
        }, 200);
      } else {
        body.addClass('menu-open');
      }
    });
  },
};

export default MainNav;
