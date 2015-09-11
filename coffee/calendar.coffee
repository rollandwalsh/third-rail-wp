api = 'https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList'
cal = $('#calendar')
	    
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
      ms += m2.getMonth() - m1.getMonth()
      ms = 0 if ms <= 0
      ms
      
    months = []
    i = 0
    while i <= mDiff minDate, maxDate
      months.push new Date(minDate.getFullYear(), minDate.getMonth() + i)
      i++
    
    printMonth month for month in months
    
    if show
      getEvents(api, createLinks, show)
    else
      getEvents(api, createLinks)
      
    $('#calendar').slick 
      prevArrow: $('#calendarNavPrev'),
      nextArrow: $('#calendarNavNext'),
      infinite: false,
      adaptiveHeight: true
  else
    $('#calendarContainer').remove
		
printMonth = (date) -> # prints calendar months as tables
	mNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] # names of months
	
	m = date.getMonth() # month number
	mName = mNames[m] # month name
	m++ # change month to correct number
	y = date.getFullYear() # full year
	
	dofW = date.getDay() # first day of week
	dCount = new Date(date.getYear(), date.getMonth() + 1, 0).getDate() # day count in month
	
	blankDs  = ('<td class="day blank"></td>' for blank in [0...dofW]) # td blank days based on dofW
	ds = ('<td class="day" id="' + y + (if m<10 then '0' + m else m) + (if d<10 then '0' + d else d) + '">' + d + '</td>' for d in [1..dCount]) # td days based on dCount
	tds = blankDs.concat ds # concatanated tds
	
	trs = ''
	i = 0
	while i < tds.length # itereate over tds
	  if i%7 == 0 # if beginning of a week except the first day
	    trs += '</tr>*<tr class="week">' + tds[i] # close week / open new week
    else
      trs += tds[i] # add data
    i++
  trs = trs.split('*') # create array of weeks
  trs.shift() # remove the first </tr> item in array
  lastTr = trs.pop() # remove last week from array
  lastTr += Array(8 - (lastTr.match(/<\/td>/g) || []).length).join('<td></td>')
  lastTr += '</tr>' # close final week tag
  trs.push lastTr
  trs = trs.join ''
	  
	caption = '<caption>' + mName + ' ' + y + '</caption>' # table caption
	tHead = '<thead><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></thead>' # table head
	tBody = '<tbody>' + trs + '</tbody>' # table body
	
	table = '<div id="' + mName + y + '"><table class="month">' + caption + tHead + tBody + '</table></div>' # table
	cal.append table # append table
  
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
    if date.data('2')
      date.data(
        '3'
          sold: instance.soldOut
          status: instance.saleStatus
          url: instance.purchaseUrl
          date: instance.formattedDates.YYYYMMDD
          day: dayStamp instance.formattedDates.ISO8601
          name: stripNTLive events[instance.eventId]
          time: timeStamp instance.formattedDates.ISO8601
      )
    else if date.data('1')
      date.data(
        '2'
          sold: instance.soldOut
          status: instance.saleStatus
          url: instance.purchaseUrl
          date: instance.formattedDates.YYYYMMDD
          day: dayStamp instance.formattedDates.ISO8601
          name: stripNTLive events[instance.eventId]
          time: timeStamp instance.formattedDates.ISO8601
      )
    else
      date.addClass('has-event').data(
        '1'
          sold: instance.soldOut
          status: instance.saleStatus
          url: instance.purchaseUrl
          date: instance.formattedDates.LONG_MONTH_DAY_YEAR
          day: dayStamp instance.formattedDates.ISO8601
          name: stripNTLive events[instance.eventId]
          time: timeStamp instance.formattedDates.ISO8601
      )
  
  $('.has-event').on 'click', ->
    buttonPrint(@)
  $('.has-event').first().trigger 'click'  

buttonPrint = (date) -> # print buttons for date on calendar
  data = $(date).data('1')
  purchase = if data.sold then 'buy' else 'buy disabled'
  tickets = if data.sold then '<i class="fa fa-ticket"></i> ' else 'SOLD OUT! - '
  $('#calendarDisplay').html '<h4>' + data.day + ' - <span class="subheader">' + data.date + '</span></h4><a href="' + data.url + '" class="button ' + purchase + ' expand">' + tickets + data.name + ' - ' + data.time + '</a>'
  if $(date).data('2')
    data = $(date).data('2')
    purchase = if data.sold then 'buy disabled' else 'buy'
    message = if data.sold then ' SOLD OUT!'
    $('#calendarDisplay').append '<br><a href="' + data.url + '" class="button ' + purchase + ' expand">' + tickets + data.name + ' - ' + data.time + '</a>'
  if $(date).data('3')
    data = $(date).data('3')
    purchase = if data.sold then 'buy disabled' else 'buy'
    message = if data.sold then ' SOLD OUT!'
    $('#calendarDisplay').append '<br><a href="' + data.url + '" class="button ' + purchase + ' expand">' + tickets + data.name + ' - ' + data.time + '</a>'
    
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
  name = input.replace('NT LIVE: ', '').replace('NT LIVE Encore: ', '')
  