jQuery(document).ready(function($) {
   getForecast();

  function buildForecast(forecasts) {
    if (typeof forecasts.length === 0) {
      $("forecast");
    }
    else {
      
       for (var i = 2; i < forecasts.length; i++) {
        var currentDay = forecasts[i];
        $("#wuforecasts").append("<div id='wuforecast'><h2 id='weekday'>" +
          currentDay.date.weekday_short + "  " + currentDay.date.day 
		  +"</h2><img id='icon' src='../css/icons/" + 
          currentDay.icon + ".png'></img>" + "<br >" + "<div class='kmh' style='margin-left:1%;'><span style='font-size:11px;'> " + 
		  currentDay.conditions  + "</span><br>" + "<span style='color:#444;margin-left:17%;'> " + 
		  currentDay.high.celsius +"°</span> | " + "<span style='color:#66a1ba;'> " + 
          currentDay.low.celsius +"° " + "</span><br>" +"<span style='margin-left:17%;'> " + 
		  currentDay.pop + "% <div class='wi wi-raindrop wi-rotate-45'></div> <div class='wi wi-raindrop wi-rotate-45'></div>" + "<br>" + "<span style='margin-left:17%;'> " + 
		  currentDay.snow_allday.cm + "cm <div class='wi wi-snowflake-cold'></div><div class='wi wi-snowflake-cold'></div><br><span style ='font-size:10px;'> "
		  );
      }
    }
  }
  function scopedForecast(forecast) {
    return _.reject(forecast, function(weather) {
     
      
    });
  }

  function getForecast() {
    $.ajax({
      url : "../forecast10day.json",
      dataType : "json",
      success : function(json) {
        var forecastData = json.forecast.simpleforecast.forecastday;
        var forecasts = scopedForecast(forecastData);
        buildForecast(forecasts);
        }
    });
  }

  function getParameter(theParameter) {
    var params = window.location.search.substr(1).split('&');

    for (var i = 0; i < params.length; i++) {
      var p = params[i].split('=');

  	  if (p[0] == theParameter) {
        return decodeURIComponent(p[1]);
  	  }
    }
    return false;
  }
});
