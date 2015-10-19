var api, buttonPrint, cal, createLinks, createMonths, dayStamp, getEvent, getEvents, printMonth, stripNTLive, timeStamp;

api = 'https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList';

cal = $('#calendar');

getEvent = function(url, callback, show) {
  return $.ajax({
    url: 'http://query.yahooapis.com/v1/public/yql',
    dataType: 'jsonp',
    data: {
      q: 'select * from json where url="' + url + '"',
      format: 'json'
    },
    success: function(data) {
      var event, events, j, len, results;
      events = data.query.results.json.events;
      results = [];
      for (j = 0, len = events.length; j < len; j++) {
        event = events[j];
        if (new RegExp(show).test(event.name)) {
          results.push(callback(event));
        }
      }
      return results;
    }
  });
};

getEvents = function(url, callback) {
  return $.ajax({
    url: 'http://query.yahooapis.com/v1/public/yql',
    dataType: 'jsonp',
    data: {
      q: 'select * from json where url="' + url + '"',
      format: 'json'
    },
    success: function(data) {
      return callback(data.query.results.json.events);
    }
  });
};

createMonths = function(data) {
  var dates, event, i, instance, j, k, l, len, len1, len2, len3, mDiff, maxDate, maxE, maxM, maxY, minDate, minE, minM, minY, month, months, n, ref, ref1;
  dates = [];
  if (data instanceof Array) {
    for (j = 0, len = data.length; j < len; j++) {
      event = data[j];
      if (event.type === 'Tickets') {
        if (event.instances.constructor === Array) {
          ref = event.instances;
          for (k = 0, len1 = ref.length; k < len1; k++) {
            instance = ref[k];
            dates.push(instance.formattedDates.YYYYMMDD);
          }
        } else {
          dates.push(event.instances.formattedDates.YYYYMMDD);
        }
      }
    }
  } else {
    if (data.type === 'Tickets') {
      if (data.instances.constructor === Array) {
        ref1 = data.instances;
        for (l = 0, len2 = ref1.length; l < len2; l++) {
          instance = ref1[l];
          dates.push(instance.formattedDates.YYYYMMDD);
        }
      } else {
        dates.push(data.instances.formattedDates.YYYYMMDD);
      }
    }
  }
  minE = (Math.min.apply(this, dates)).toString();
  maxE = (Math.max.apply(this, dates)).toString();
  minY = minE.substr(0, 4);
  minM = minE.substr(4, 2);
  maxY = maxE.substr(0, 4);
  maxM = maxE.substr(4, 2);
  minDate = new Date(minY, minM - 1);
  maxDate = new Date(maxY, maxM - 1);
  mDiff = function(m1, m2) {
    var ms;
    ms = (m2.getFullYear() - m1.getFullYear()) * 12;
    ms += m2.getMonth() - m1.getMonth();
    if (ms <= 0) {
      ms = 0;
    }
    return ms;
  };
  months = [];
  i = 0;
  while (i <= mDiff(minDate, maxDate)) {
    months.push(new Date(minDate.getFullYear(), minDate.getMonth() + i));
    i++;
  }
  for (n = 0, len3 = months.length; n < len3; n++) {
    month = months[n];
    printMonth(month);
  }
  getEvents(api, createLinks);
  return $('#calendar').slick({
    prevArrow: $('#calendarNavPrev'),
    nextArrow: $('#calendarNavNext'),
    infinite: false,
    adaptiveHeight: true
  });
};

printMonth = function(date) {
  var blank, blankDs, d, dCount, day, dayNames, days, divs, dofW, dowNames, ds, header, m, mName, mNames, month, weeks, y;
  mNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  dowNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  m = date.getMonth();
  mName = mNames[m];
  m++;
  y = date.getFullYear();
  dofW = date.getDay();
  dCount = new Date(date.getYear(), date.getMonth() + 1, 0).getDate();
  dayNames = (function() {
    var j, len, results;
    results = [];
    for (j = 0, len = dowNames.length; j < len; j++) {
      day = dowNames[j];
      results.push('<div class="tr-calendar-day name">' + day + '</div>');
    }
    return results;
  })();
  blankDs = (function() {
    var j, ref, results;
    results = [];
    for (blank = j = 0, ref = dofW; 0 <= ref ? j < ref : j > ref; blank = 0 <= ref ? ++j : --j) {
      results.push('<div class="tr-calendar-day"></div>');
    }
    return results;
  })();
  ds = (function() {
    var j, ref, results;
    results = [];
    for (d = j = 1, ref = dCount; 1 <= ref ? j <= ref : j >= ref; d = 1 <= ref ? ++j : --j) {
      results.push('<div class="tr-calendar-day" id="' + y + (m < 10 ? '0' + m : m) + (d < 10 ? '0' + d : d) + '">' + d + '</div>');
    }
    return results;
  })();
  days = blankDs.concat(ds);
  divs = dayNames.concat(days);
  header = '<header class="tr-calendar-month-header"><h1>' + mName + ' ' + y + '</h1></header>';
  weeks = '<section class="tr-calendar-weeks">' + divs.toString() + '</section>';
  month = '<article id="' + mName + y + '" class="tr-calendar-month">' + header + weeks + '</article>';
  return cal.append(month);
};

createLinks = function(data) {
  var date, event, events, instance, instances, j, k, l, len, len1, len2, ref;
  events = {};
  instances = [];
  for (j = 0, len = data.length; j < len; j++) {
    event = data[j];
    if (event.type === 'Tickets') {
      events[event.id] = event.name;
      if (event.instances.constructor === Array) {
        ref = event.instances;
        for (k = 0, len1 = ref.length; k < len1; k++) {
          instance = ref[k];
          instances.push(instance);
        }
      } else {
        instances.push(event.instances);
      }
    }
  }
  for (l = 0, len2 = instances.length; l < len2; l++) {
    instance = instances[l];
    date = $('#' + instance.formattedDates.YYYYMMDD);
    if (date.data('2')) {
      date.data('3', {
        sold: instance.soldOut,
        status: instance.saleStatus,
        url: instance.purchaseUrl,
        date: instance.formattedDates.YYYYMMDD,
        day: dayStamp(instance.formattedDates.ISO8601),
        name: stripNTLive(events[instance.eventId]),
        time: timeStamp(instance.formattedDates.ISO8601)
      });
    } else if (date.data('1')) {
      date.data('2', {
        sold: instance.soldOut,
        status: instance.saleStatus,
        url: instance.purchaseUrl,
        date: instance.formattedDates.YYYYMMDD,
        day: dayStamp(instance.formattedDates.ISO8601),
        name: stripNTLive(events[instance.eventId]),
        time: timeStamp(instance.formattedDates.ISO8601)
      });
    } else {
      date.addClass('has-event').data('1', {
        sold: instance.soldOut,
        status: instance.saleStatus,
        url: instance.purchaseUrl,
        date: instance.formattedDates.LONG_MONTH_DAY_YEAR,
        day: dayStamp(instance.formattedDates.ISO8601),
        name: stripNTLive(events[instance.eventId]),
        time: timeStamp(instance.formattedDates.ISO8601)
      });
    }
  }
  $('.has-event').on('click', function() {
    return buttonPrint(this);
  });
  return $('.has-event').first().trigger('click');
};

buttonPrint = function(date) {
  var data, purchase, tickets;
  data = $(date).data('1');
  purchase = data.sold ? 'buy' : 'buy disabled';
  tickets = data.sold ? '<i class="fa fa-ticket"></i> ' : 'SOLD OUT! - ';
  $('#calendarDisplay').html('<h4>' + data.day + ' - <span class="subheader">' + data.date + '</span></h4><a href="' + data.url + '" class="button ' + purchase + ' expand">' + tickets + data.name + ' - ' + data.time + '</a>');
  if ($(date).data('2')) {
    data = $(date).data('2');
    purchase = data.sold ? 'buy' : 'buy disabled';
    tickets = data.sold ? '<i class="fa fa-ticket"></i> ' : 'SOLD OUT! - ';
    $('#calendarDisplay').append('<br><a href="' + data.url + '" class="button ' + purchase + ' expand">' + tickets + data.name + ' - ' + data.time + '</a>');
  }
  if ($(date).data('3')) {
    data = $(date).data('3');
    purchase = data.sold ? 'buy' : 'buy disabled';
    tickets = data.sold ? '<i class="fa fa-ticket"></i> ' : 'SOLD OUT! - ';
    return $('#calendarDisplay').append('<br><a href="' + data.url + '" class="button ' + purchase + ' expand">' + tickets + data.name + ' - ' + data.time + '</a>');
  }
};

timeStamp = function(input) {
  var date, i, suffix, time;
  date = new Date(input);
  time = [date.getHours(), date.getMinutes()];
  suffix = time[0] < 12 ? 'am' : 'pm';
  time[0] = time[0] < 12 ? time[0] : time[0] - 12;
  time[0] = time[0] || 12;
  i = 1;
  while (i < 3) {
    if (time[i] < 10) {
      time[i] = '0' + time[i];
    }
    i++;
  }
  return time.join(':') + ' ' + suffix;
};

dayStamp = function(input) {
  var date, day, weekdays;
  date = new Date(input);
  weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  return day = weekdays[date.getDay()];
};

stripNTLive = function(input) {
  var name;
  return name = input.replace('NT LIVE: ', '').replace('NT LIVE Encore: ', '');
};



jQuery(document).foundation();
