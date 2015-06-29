api = 'https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList'
cal = $('#calendar')

getEvents = (url, callback) ->
	req = $.getJSON url
	req.success (data) ->
		callback(data.events)

createMonths = (data) ->
  dates = []
  for event in data
    if event.type == 'Tickets'
      dates.push instance.formattedDates.YYYYMMDD for instance in event.instances
  
  minE = (Math.min.apply @, dates).toString()
  maxE = (Math.max.apply @, dates).toString()
  
  minY = minE.substr 0,4
  minM = minE.substr 4,2
  maxY = maxE.substr 0,4
  maxM = maxE.substr 4,2
  
  minDate = new Date minY, minM
  maxDate = new Date maxY, maxM

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
		
printMonth = (date) ->
	mNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] # names of months
	
	m = date.getMonth() # month number
	mName = mNames[m] # month name
	y = date.getFullYear() # full year
	
	dofW = date.getDay() # first day of week
	dCount = new Date(date.getYear(), date.getMonth() + 1, 0).getDate() # day count in month
	
	blankDs  = ('<td class="day blank"></td>' for blank in [0...dofW]) # td blank days based on dofW
	ds = ('<td class="day" id="' + y + (if m<10 then '0' + m else m) + (if d<10 then '0' + d else d) + '">' + d + '</td>' for d in [1..dCount]) # td days based on dCount
	tds = blankDs.concat ds # concatanated tds
	
	trs = '<tr class="week">' # start first week table row
	i = 0
	while i < tds.length # itereate over tds
	  if i%7 == 0 or !i == 0 # if beginning of a week except the first day
	    trs += '</tr><tr class="week">' + tds[i] # close week / open new week
    else
      trs += tds[i] # add data
    i++
  trs += '</tr>' # end final week
	  
	caption = '<caption>' + mName + ' ' + y + '</caption>' # table caption
	tHead = '<thead><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></thead>' # table head
	tBody = '<tbody>' + trs + '</tbody>' # table body
	
	table = '<div id=""><table class="month">' + caption + tHead + tBody + '</table></div>' # table
	cal.append(table) # append table
  
createLinks = (data) ->
  instances = []
  links = []
  for event in data
    if event.type == 'Tickets'
      instances.push instance for instance in event.instances
  
  for instance in instances
    links.push
      sold: instance.soldOut
      status: instance.saleStatus
      url: instance.purchaseUrl
      date: instance.formattedDates.YYYYMMDD
      id: instance.id
  
  for link in links
    $('#' + link.date).wrapInner('<a href="#" data-1-sold="' + link.sold + '" data-1-status="' + link.status + '" data-1-url="' + link.url + '" data-1-date="' + link.date + '" data-1-name="' + link.id + '"></a>')
#   
#   console.log links

$ ->
  getEvents(api, createMonths)
$ ->
  getEvents(api, createLinks)