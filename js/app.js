var api,buttonPrint,cal,createLinks,createMonths,dayStamp,getEvents,mainStage,ntLive,printMonth,stripNTLive,timeStamp,wildCard,indexOf=[].indexOf||function(item){for(var i=0,l=this.length;l>i;i++)if(i in this&&this[i]===item)return i;return-1};api="https://thirdrailrep.secure.force.com/ticket/PatronTicket__PublicApiEventList",cal=$("#trCalendar"),mainStage=["or,","the realistic joneses","mr. kolpert","the new electric ballroom"],ntLive=["hamlet","skylight","the beaux stratagem","coriolanus","jane eyre","as you like it"],wildCard=["the bylines: meant to be","pete: all well"],getEvents=function(url,callback,show){return null==show&&(show=!1),$.ajax({url:"http://query.yahooapis.com/v1/public/yql",dataType:"jsonp",data:{q:'select * from json where url="'+url+'"',format:"json"},success:function(data){var event,events;return show?(events=data.query.results.json.events,callback(function(){var j,len,results;for(results=[],j=0,len=events.length;len>j;j++)event=events[j],new RegExp(show).test(event.name)&&results.push(event);return results}(),show)):callback(data.query.results.json.events)}})},createMonths=function(data,show){var dates,event,i,instance,j,k,l,len,len1,len2,len3,mDiff,maxDate,maxE,maxM,maxY,minDate,minE,minM,minY,month,months,n,ref,ref1;if(null==show&&(show=!1),dates=[],data instanceof Array){for(j=0,len=data.length;len>j;j++)if(event=data[j],"Tickets"===event.type)if(event.instances.constructor===Array)for(ref=event.instances,k=0,len1=ref.length;len1>k;k++)instance=ref[k],dates.push(instance.formattedDates.YYYYMMDD);else dates.push(event.instances.formattedDates.YYYYMMDD)}else if("Tickets"===data.type)if(data.instances.constructor===Array)for(ref1=data.instances,l=0,len2=ref1.length;len2>l;l++)instance=ref1[l],dates.push(instance.formattedDates.YYYYMMDD);else dates.push(data.instances.formattedDates.YYYYMMDD);if(dates.length>0){for(minE=Math.min.apply(this,dates).toString(),maxE=Math.max.apply(this,dates).toString(),minY=minE.substr(0,4),minM=minE.substr(4,2),maxY=maxE.substr(0,4),maxM=maxE.substr(4,2),minDate=new Date(minY,minM-1),maxDate=new Date(maxY,maxM-1),mDiff=function(m1,m2){var ms;return ms=12*(m2.getFullYear()-m1.getFullYear()),ms+=m2.getMonth()-m1.getMonth(),0>=ms&&(ms=0),ms},months=[],i=0;i<mDiff(minDate,maxDate);)months.push(new Date(minDate.getFullYear(),minDate.getMonth()+i)),i++;for($(".tr-calendar-loading").remove(),n=0,len3=months.length;len3>n;n++)month=months[n],printMonth(month);return show?getEvents(api,createLinks,show):getEvents(api,createLinks),$("#trCalendar").slick({prevArrow:$(".fa-angle-double-left"),nextArrow:$(".fa-angle-double-right"),infinite:!1,adaptiveHeight:!0})}return $("#trCalendar").remove()},printMonth=function(date){var blank,blankDs,d,dCount,day,dayNames,days,divs,dofW,dowNames,ds,header,m,mName,mNames,month,weeks,y;return mNames=["January","February","March","April","May","June","July","August","September","October","November","December"],dowNames=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],m=date.getMonth(),mName=mNames[m],m++,y=date.getFullYear(),dofW=date.getDay(),dCount=new Date(date.getYear(),date.getMonth()+1,0).getDate(),dayNames=function(){var j,len,results;for(results=[],j=0,len=dowNames.length;len>j;j++)day=dowNames[j],results.push('<div class="tr-calendar-day name">'+day+"</div>");return results}(),blankDs=function(){var j,ref,results;for(results=[],blank=j=0,ref=dofW;ref>=0?ref>j:j>ref;blank=ref>=0?++j:--j)results.push('<div class="tr-calendar-day blank"></div>');return results}(),ds=function(){var j,ref,results;for(results=[],d=j=1,ref=dCount;ref>=1?ref>=j:j>=ref;d=ref>=1?++j:--j)results.push('<div class="tr-calendar-day" id="'+y+(10>m?"0"+m:m)+(10>d?"0"+d:d)+'">'+d+"</div>");return results}(),days=blankDs.concat(ds),divs=dayNames.concat(days),header='<header class="tr-calendar-month-header"><i class="fa fa-angle-double-left fa-2x"></i><h1>'+mName+" "+y+'</h1><i class="fa fa-angle-double-right fa-2x"></i></header>',weeks='<section class="tr-calendar-weeks">'+divs.join("")+"</section>",month='<article id="'+mName+y+'" class="tr-calendar-month">'+header+weeks+"</article>",cal.append(month)},createLinks=function(data,show){var button,date,event,eventId,eventName,events,instance,instances,j,k,l,len,len1,len2,ref;for(null==show&&(show=!1),events={},instances=[],j=0,len=data.length;len>j;j++)if(event=data[j],"Tickets"===event.type)if(events[event.id]=event.name,event.instances.constructor===Array)for(ref=event.instances,k=0,len1=ref.length;len1>k;k++)instance=ref[k],instances.push(instance);else instances.push(event.instances);for(l=0,len2=instances.length;len2>l;l++)instance=instances[l],date=$("#"+instance.formattedDates.YYYYMMDD),eventName=stripNTLive(events[instance.eventId].toLowerCase()),eventId=instance.id,button="main-stage",indexOf.call(mainStage,eventName)>=0&&date.addClass("main-stage"),indexOf.call(ntLive,eventName)>=0&&(date.addClass("nt-live"),button="nt-live"),indexOf.call(wildCard,eventName)>=0&&(date.addClass("wild-card"),button="wild-card"),date.data(eventId,{sold:instance.soldOut,status:instance.saleStatus,url:instance.purchaseUrl,date:instance.formattedDates.LONG_MONTH_DAY_YEAR,day:dayStamp(instance.formattedDates.ISO8601),name:eventName,time:timeStamp(instance.formattedDates.ISO8601),button:button}),date.hasClass("event")||date.addClass("event");return $(".event").on("click",function(){return buttonPrint(this),$("html, body").animate({scrollTop:$("#trCalendarDisplay").offset().top-160},500)}),buttonPrint($(".event").first())},buttonPrint=function(input){var data,date,eventId,output,purchase,tickets;output=[];for(eventId in $(input).data())data=$(input).data()[eventId],purchase=null==data.sold?" disabled":"",tickets=data.sold?'<i class="fa fa-ticket"></i> ':"SOLD OUT! - ",date="<h3>"+data.day+' - <span class="subheader">'+data.date+"</span></h3>",output.push('<a href="'+data.url+'" class="button '+data.button+purchase+'">'+tickets+data.name+" - "+data.time+"</a>");return $("#trCalendarDisplay").html(date).append(output.join(" "))},timeStamp=function(input){var date,i,suffix,time;for(date=new Date(input),time=[date.getHours(),date.getMinutes()],suffix=time[0]<12?"am":"pm",time[0]=time[0]<12?time[0]:time[0]-12,time[0]=time[0]||12,i=1;3>i;)time[i]<10&&(time[i]="0"+time[i]),i++;return time.join(":")+" "+suffix},dayStamp=function(input){var date,day,weekdays;return date=new Date(input),weekdays=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],day=weekdays[date.getDay()]},stripNTLive=function(input){var name;return name=input.replace("nt live ","").replace("nt live: ","").replace("nt live encore: ","").replace(" wildcard","")};