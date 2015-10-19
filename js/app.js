var api,buttonPrint,cal,createLinks,createMonths,dayStamp,getEvent,getEvents,printMonth,stripNTLive,timeStamp;api="https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList",cal=$("#calendar"),getEvent=function(url,callback,show){return $.ajax({url:"http://query.yahooapis.com/v1/public/yql",dataType:"jsonp",data:{q:'select * from json where url="'+url+'"',format:"json"},success:function(data){var event,events,j,len,results;for(events=data.query.results.json.events,results=[],j=0,len=events.length;len>j;j++)event=events[j],new RegExp(show).test(event.name)&&results.push(callback(event));return results}})},getEvents=function(url,callback){return $.ajax({url:"http://query.yahooapis.com/v1/public/yql",dataType:"jsonp",data:{q:'select * from json where url="'+url+'"',format:"json"},success:function(data){return callback(data.query.results.json.events)}})},createMonths=function(data){var dates,event,i,instance,j,k,l,len,len1,len2,len3,mDiff,maxDate,maxE,maxM,maxY,minDate,minE,minM,minY,month,months,n,ref,ref1;if(dates=[],data instanceof Array){for(j=0,len=data.length;len>j;j++)if(event=data[j],"Tickets"===event.type)if(event.instances.constructor===Array)for(ref=event.instances,k=0,len1=ref.length;len1>k;k++)instance=ref[k],dates.push(instance.formattedDates.YYYYMMDD);else dates.push(event.instances.formattedDates.YYYYMMDD)}else if("Tickets"===data.type)if(data.instances.constructor===Array)for(ref1=data.instances,l=0,len2=ref1.length;len2>l;l++)instance=ref1[l],dates.push(instance.formattedDates.YYYYMMDD);else dates.push(data.instances.formattedDates.YYYYMMDD);for(minE=Math.min.apply(this,dates).toString(),maxE=Math.max.apply(this,dates).toString(),minY=minE.substr(0,4),minM=minE.substr(4,2),maxY=maxE.substr(0,4),maxM=maxE.substr(4,2),minDate=new Date(minY,minM-1),maxDate=new Date(maxY,maxM-1),mDiff=function(m1,m2){var ms;return ms=12*(m2.getFullYear()-m1.getFullYear()),ms+=m2.getMonth()-m1.getMonth(),0>=ms&&(ms=0),ms},months=[],i=0;i<=mDiff(minDate,maxDate);)months.push(new Date(minDate.getFullYear(),minDate.getMonth()+i)),i++;for(n=0,len3=months.length;len3>n;n++)month=months[n],printMonth(month);return getEvents(api,createLinks),$("#calendar").slick({prevArrow:$("#calendarNavPrev"),nextArrow:$("#calendarNavNext"),infinite:!1,adaptiveHeight:!0})},printMonth=function(date){var blank,blankDs,d,dCount,day,dayNames,days,divs,dofW,dowNames,ds,header,m,mName,mNames,month,weeks,y;return mNames=["January","February","March","April","May","June","July","August","September","October","November","December"],dowNames=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],m=date.getMonth(),mName=mNames[m],m++,y=date.getFullYear(),dofW=date.getDay(),dCount=new Date(date.getYear(),date.getMonth()+1,0).getDate(),dayNames=function(){var j,len,results;for(results=[],j=0,len=dowNames.length;len>j;j++)day=dowNames[j],results.push('<div class="tr-calendar-day name">'+day+"</div>");return results}(),blankDs=function(){var j,ref,results;for(results=[],blank=j=0,ref=dofW;ref>=0?ref>j:j>ref;blank=ref>=0?++j:--j)results.push('<div class="tr-calendar-day"></div>');return results}(),ds=function(){var j,ref,results;for(results=[],d=j=1,ref=dCount;ref>=1?ref>=j:j>=ref;d=ref>=1?++j:--j)results.push('<div class="tr-calendar-day" id="'+y+(10>m?"0"+m:m)+(10>d?"0"+d:d)+'">'+d+"</div>");return results}(),days=blankDs.concat(ds),divs=dayNames.concat(days),header='<header class="tr-calendar-month-header"><h1>'+mName+" "+y+"</h1></header>",weeks='<section class="tr-calendar-weeks">'+divs.toString()+"</section>",month='<article id="'+mName+y+'" class="tr-calendar-month">'+header+weeks+"</article>",cal.append(month)},createLinks=function(data){var date,event,events,instance,instances,j,k,l,len,len1,len2,ref;for(events={},instances=[],j=0,len=data.length;len>j;j++)if(event=data[j],"Tickets"===event.type)if(events[event.id]=event.name,event.instances.constructor===Array)for(ref=event.instances,k=0,len1=ref.length;len1>k;k++)instance=ref[k],instances.push(instance);else instances.push(event.instances);for(l=0,len2=instances.length;len2>l;l++)instance=instances[l],date=$("#"+instance.formattedDates.YYYYMMDD),date.data("2")?date.data("3",{sold:instance.soldOut,status:instance.saleStatus,url:instance.purchaseUrl,date:instance.formattedDates.YYYYMMDD,day:dayStamp(instance.formattedDates.ISO8601),name:stripNTLive(events[instance.eventId]),time:timeStamp(instance.formattedDates.ISO8601)}):date.data("1")?date.data("2",{sold:instance.soldOut,status:instance.saleStatus,url:instance.purchaseUrl,date:instance.formattedDates.YYYYMMDD,day:dayStamp(instance.formattedDates.ISO8601),name:stripNTLive(events[instance.eventId]),time:timeStamp(instance.formattedDates.ISO8601)}):date.addClass("has-event").data("1",{sold:instance.soldOut,status:instance.saleStatus,url:instance.purchaseUrl,date:instance.formattedDates.LONG_MONTH_DAY_YEAR,day:dayStamp(instance.formattedDates.ISO8601),name:stripNTLive(events[instance.eventId]),time:timeStamp(instance.formattedDates.ISO8601)});return $(".has-event").on("click",function(){return buttonPrint(this)}),$(".has-event").first().trigger("click")},buttonPrint=function(date){var data,purchase,tickets;return data=$(date).data("1"),purchase=data.sold?"buy":"buy disabled",tickets=data.sold?'<i class="fa fa-ticket"></i> ':"SOLD OUT! - ",$("#calendarDisplay").html("<h4>"+data.day+' - <span class="subheader">'+data.date+'</span></h4><a href="'+data.url+'" class="button '+purchase+' expand">'+tickets+data.name+" - "+data.time+"</a>"),$(date).data("2")&&(data=$(date).data("2"),purchase=data.sold?"buy":"buy disabled",tickets=data.sold?'<i class="fa fa-ticket"></i> ':"SOLD OUT! - ",$("#calendarDisplay").append('<br><a href="'+data.url+'" class="button '+purchase+' expand">'+tickets+data.name+" - "+data.time+"</a>")),$(date).data("3")?(data=$(date).data("3"),purchase=data.sold?"buy":"buy disabled",tickets=data.sold?'<i class="fa fa-ticket"></i> ':"SOLD OUT! - ",$("#calendarDisplay").append('<br><a href="'+data.url+'" class="button '+purchase+' expand">'+tickets+data.name+" - "+data.time+"</a>")):void 0},timeStamp=function(input){var date,i,suffix,time;for(date=new Date(input),time=[date.getHours(),date.getMinutes()],suffix=time[0]<12?"am":"pm",time[0]=time[0]<12?time[0]:time[0]-12,time[0]=time[0]||12,i=1;3>i;)time[i]<10&&(time[i]="0"+time[i]),i++;return time.join(":")+" "+suffix},dayStamp=function(input){var date,day,weekdays;return date=new Date(input),weekdays=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],day=weekdays[date.getDay()]},stripNTLive=function(input){var name;return name=input.replace("NT LIVE: ","").replace("NT LIVE Encore: ","")},jQuery(document).foundation();