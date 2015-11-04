navButton = $('#trSiteNavButton')
nav = $('.tr-site-nav-menu')

navButton.on 'click', (e) ->
  navButton.toggleClass 'is-active'
  nav.slideToggle()
  e.preventDefault()
