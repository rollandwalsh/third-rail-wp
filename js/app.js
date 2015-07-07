var api, buttonPrint, cal, createLinks, createMonths, getEvents, printMonth, timeStamp;

api = 'https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList';

cal = $('#calendar');

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
  var dates, event, i, instance, j, k, l, len, len1, len2, mDiff, maxDate, maxE, maxM, maxY, minDate, minE, minM, minY, month, months, ref;
  dates = [];
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
  for (l = 0, len2 = months.length; l < len2; l++) {
    month = months[l];
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
  var blank, blankDs, caption, d, dCount, dofW, ds, i, m, mName, mNames, tBody, tHead, table, tds, trs, y;
  mNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  m = date.getMonth();
  mName = mNames[m];
  m++;
  y = date.getFullYear();
  dofW = date.getDay();
  dCount = new Date(date.getYear(), date.getMonth() + 1, 0).getDate();
  blankDs = (function() {
    var j, ref, results;
    results = [];
    for (blank = j = 0, ref = dofW; 0 <= ref ? j < ref : j > ref; blank = 0 <= ref ? ++j : --j) {
      results.push('<td class="day blank"></td>');
    }
    return results;
  })();
  ds = (function() {
    var j, ref, results;
    results = [];
    for (d = j = 1, ref = dCount; 1 <= ref ? j <= ref : j >= ref; d = 1 <= ref ? ++j : --j) {
      results.push('<td class="day" id="' + y + (m < 10 ? '0' + m : m) + (d < 10 ? '0' + d : d) + '">' + d + '</td>');
    }
    return results;
  })();
  tds = blankDs.concat(ds);
  trs = '<tr class="week">';
  i = 0;
  while (i < tds.length) {
    if (i % 7 === 0 || !i === 0) {
      trs += '</tr><tr class="week">' + tds[i];
    } else {
      trs += tds[i];
    }
    i++;
  }
  trs += '</tr>';
  caption = '<caption>' + mName + ' ' + y + '</caption>';
  tHead = '<thead><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></thead>';
  tBody = '<tbody>' + trs + '</tbody>';
  table = '<div id="' + mName + y + '"><table class="month">' + caption + tHead + tBody + '</table></div>';
  return cal.append(table);
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
    if (date.data('1')) {
      date.addClass('has-event').data('2', {
        sold: instance.soldOut,
        status: instance.saleStatus,
        url: instance.purchaseUrl,
        date: instance.formattedDates.YYYYMMDD,
        name: events[instance.eventId],
        time: timeStamp(instance.formattedDates.ISO8601)
      });
    } else {
      date.addClass('has-event').data('1', {
        sold: instance.soldOut,
        status: instance.saleStatus,
        url: instance.purchaseUrl,
        date: instance.formattedDates.LONG_MONTH_DAY_YEAR,
        name: events[instance.eventId],
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
  var data;
  data = $(date).data('1');
  $('#calendarDisplay').html('<h3>' + data.date + '</h3><a href="' + data.url + '" class="button buy">' + data.name + ' - ' + data.time + '</a>');
  if ($(date).data('2')) {
    return $('#calendarDisplay').append('<br><a href="' + data.url + '" class="button buy">' + data.name + ' - ' + data.time + '</a>');
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

$(function() {
  return getEvents(api, createMonths);
});
