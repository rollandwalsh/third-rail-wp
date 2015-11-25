api = 'https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList'
cal = $('#trCalendar')
calContainer = $('#trCalendarContainer');
mainStage = ['or,', 'the realistic joneses', 'mr. kolpert', 'the new electric ballroom', 'annapurna', 'the nether', 'the angry brigade']
ntLive = ['hamlet', 'skylight', 'the beaux stratagem', 'coriolanus', 'jane eyre', 'as you like it', 'the winter\'s tale', 'les liaisons dangereuses']
wildCard = ['the bylines: meant to be', 'pete: all well', 'eowyn emerald & dancers']
	    
getEvents = (url, callback, show = false) ->
	$.ajax
	  url: 'http://query.yahooapis.com/v1/public/yql'
	  dataType: 'jsonp'
	  data:
	    q: 'select * from json where url="' + url + '"'
	    format: 'json'
	  success: (data) ->
	    if show
	      events = data.query.results.json.events
	      callback (event for event in events when new RegExp(show).test event.name), show
      else
	      callback(data.query.results.json.events)

createMonths = (data, show = false) -> # creates a list of months with events in them
  dates = []
  if data instanceof Array
    for event in data
      if event.type == 'Tickets'
        if event.instances.constructor == Array
          dates.push instance.formattedDates.YYYYMMDD for instance in event.instances
        else dates.push event.instances.formattedDates.YYYYMMDD
  else 
    if data.type == 'Tickets'
      if data.instances.constructor == Array
        dates.push instance.formattedDates.YYYYMMDD for instance in data.instances
      else dates.push data.instances.formattedDates.YYYYMMDD
  
  if dates.length > 0
    minE = (Math.min.apply @, dates).toString()
    maxE = (Math.max.apply @, dates).toString()
    
    minY = minE.substr 0,4
    minM = minE.substr 4,2
    maxY = maxE.substr 0,4
    maxM = maxE.substr 4,2
    
    minDate = new Date minY, minM-1
    maxDate = new Date maxY, maxM-1
  
    mDiff = (m1, m2) -> # get number of months between first and last months with events
      ms = (m2.getFullYear() - m1.getFullYear()) * 12
      ms += m2.getMonth() - m1.getMonth() + 1
      ms = 0 if ms <= 0
      ms
    
    months = []
    i = 0
    while i < mDiff minDate, maxDate
      months.push new Date(minDate.getFullYear(), minDate.getMonth() + i)
      i++
    
    $('.tr-calendar-loading').remove()
    
    printMonth month for month in months
    
    if show
      getEvents(api, createLinks, show)
    else
      getEvents(api, createLinks)
      
    cal.slick 
      prevArrow: $('.fa-angle-double-left'),
      nextArrow: $('.fa-angle-double-right'),
      infinite: false,
      adaptiveHeight: true
  else
    console.log('fail')
    calContainer.remove()
		
printMonth = (date) -> # prints calendar months as tables
	mNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] # names of months
	dowNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] # names of days of week
	
	m = date.getMonth() # month number
	mName = mNames[m] # month name
	m++ # change month to correct number
	y = date.getFullYear() # full year
	
	dofW = date.getDay() # first day of week
	dCount = new Date(date.getYear(), date.getMonth() + 1, 0).getDate() # day count in month
	
	dayNames = ('<div class="tr-calendar-day name">' + day + '</div>' for day in dowNames) # names of days row
	
	blankDs  = ('<div class="tr-calendar-day blank"></div>' for blank in [0...dofW]) # blank days based on dofW
	ds = ('<div class="tr-calendar-day" id="' + y + (if m<10 then '0' + m else m) + (if d<10 then '0' + d else d) + '">' + d + '</div>' for d in [1..dCount]) # days based on dCount
	days = blankDs.concat ds # concatanated days divs
	divs = dayNames.concat days
	  
	header = '<header class="tr-calendar-month-header"><i class="fa fa-angle-double-left fa-2x"></i><h1>' + mName + ' ' + y + '</h1><i class="fa fa-angle-double-right fa-2x"></i></header>' # calendar month header
	weeks = '<section class="tr-calendar-weeks">' + divs.join('') + '</section>' # calendar weeks
	
	month = '<article id="' + mName + y + '" class="tr-calendar-month">' + header + weeks + '</article>' # month
	cal.append month # append month
  
createLinks = (data, show = false) -> # create links based off of event instances
  events = {}
  instances = []
  for event in data
    if event.type == 'Tickets'
      events[event.id] = event.name
      if event.instances.constructor == Array
        instances.push instance for instance in event.instances
      else instances.push event.instances

  for instance in instances # loops through instances to get dates to link to | TODO: illimnate duplicate code
    date = $('#' + instance.formattedDates.YYYYMMDD)
    eventName = stripNTLive events[instance.eventId].toLowerCase()
    eventId = instance.id
    button = 'main-stage'
    
    date.addClass 'main-stage' if eventName in mainStage
    if eventName in ntLive
      date.addClass 'nt-live'
      button = 'nt-live'
    if eventName in wildCard
      date.addClass 'wild-card'
      button = 'wild-card'
    
    date.data(
      eventId,
        sold: instance.soldOut
        status: instance.saleStatus
        url: instance.purchaseUrl
        date: instance.formattedDates.LONG_MONTH_DAY_YEAR
        day: dayStamp instance.formattedDates.ISO8601
        name: eventName
        time: timeStamp instance.formattedDates.ISO8601
        button: button
    )
    
    date.addClass 'event' if !date.hasClass 'event'
    
  $('.event').on 'click', ->
    buttonPrint(@)
    $('html, body').animate { scrollTop: cal.offset().top - $('.tr-site-header').height() }, 500
  buttonPrint $('.event').first()

buttonPrint = (input) -> # print buttons for date on calendar
  output = []
  
  for eventId of $(input).data()
    data = $(input).data()[eventId]
    purchase = if !data.sold? then ' disabled' else '' 
    tickets = if data.sold then '<i class="fa fa-ticket"></i> ' else 'SOLD OUT! - '
    date = '<h3>' + data.day + ' - <span class="subheader">' + data.date + '</span></h3>'
    output.push '<a href="' + data.url + '" class="button ' + data.button + purchase + '">' + tickets + data.name + ' - ' + data.time + '</a>'

  $('#trCalendarDisplay').html(date).append output.join(' ')

timeStamp = (input) -> # return a nicely formatted time based on a date
  date = new Date(input)
  time = [
    date.getHours()
    date.getMinutes()
  ]
  suffix = if time[0] < 12 then 'am' else 'pm'
  time[0] = if time[0] < 12 then time[0] else time[0] - 12
  time[0] = time[0] or 12
  i = 1
  while i < 3
    if time[i] < 10
      time[i] = '0' + time[i]
    i++
  time.join(':') + ' ' + suffix

dayStamp = (input) -> # return day of week based on date
  date = new Date(input)
  weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
  day = weekdays[date.getDay()]
  
stripNTLive = (input) -> # remove nt live prefix from Patron Manager event name
  name = input.replace('nt live ', '').replace('nt live: ', '').replace('nt live encore: ', '').replace('branagh: ', '').replace(' wildcard', '').replace('wildcard: ', '').replace(' - january 8', '')
  