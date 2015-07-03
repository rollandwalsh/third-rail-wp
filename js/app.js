var api, cal, createLinks, createMonths, getEvents, printMonth;

console.log('load');

api = 'https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList';

cal = $('#calendar');

getEvents = function(url, callback) {
  var req;
  req = $.getJSON(url);
  return req.success(function(data) {
    return callback(data.events);
  });
};

createMonths = function(data) {
  var dates, event, i, instance, j, k, l, len, len1, len2, mDiff, maxDate, maxE, maxM, maxY, minDate, minE, minM, minY, month, months, ref, results;
  dates = [];
  for (j = 0, len = data.length; j < len; j++) {
    event = data[j];
    if (event.type === 'Tickets') {
      ref = event.instances;
      for (k = 0, len1 = ref.length; k < len1; k++) {
        instance = ref[k];
        dates.push(instance.formattedDates.YYYYMMDD);
      }
    }
  }
  minE = (Math.min.apply(this, dates)).toString();
  maxE = (Math.max.apply(this, dates)).toString();
  minY = minE.substr(0, 4);
  minM = minE.substr(4, 2);
  maxY = maxE.substr(0, 4);
  maxM = maxE.substr(4, 2);
  minDate = new Date(minY, minM);
  maxDate = new Date(maxY, maxM);
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
  results = [];
  for (l = 0, len2 = months.length; l < len2; l++) {
    month = months[l];
    results.push(printMonth(month));
  }
  return results;
};

printMonth = function(date) {
  var blank, blankDs, caption, d, dCount, dofW, ds, i, m, mName, mNames, tBody, tHead, table, tds, trs, y;
  mNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  m = date.getMonth();
  mName = mNames[m];
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
  table = '<div id=""><table class="month">' + caption + tHead + tBody + '</table></div>';
  cal.append(table);
  return console.log('success');
};

createLinks = function(data) {
  var event, instance, instances, j, k, l, len, len1, len2, len3, link, links, n, ref, results;
  instances = [];
  links = [];
  for (j = 0, len = data.length; j < len; j++) {
    event = data[j];
    if (event.type === 'Tickets') {
      ref = event.instances;
      for (k = 0, len1 = ref.length; k < len1; k++) {
        instance = ref[k];
        instances.push(instance);
      }
    }
  }
  for (l = 0, len2 = instances.length; l < len2; l++) {
    instance = instances[l];
    links.push({
      sold: instance.soldOut,
      status: instance.saleStatus,
      url: instance.purchaseUrl,
      date: instance.formattedDates.YYYYMMDD,
      id: instance.id
    });
  }
  results = [];
  for (n = 0, len3 = links.length; n < len3; n++) {
    link = links[n];
    results.push($('#' + link.date).wrapInner('<a href="#" data-1-sold="' + link.sold + '" data-1-status="' + link.status + '" data-1-url="' + link.url + '" data-1-date="' + link.date + '" data-1-name="' + link.id + '"></a>'));
  }
  return results;
};

$(function() {
  return getEvents(api, createMonths);
});

$(function() {
  return getEvents(api, createLinks);
});
