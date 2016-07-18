jQuery(document).ready(function(s) {
    function a(a) {
        if (0 === typeof a.length) s("forecast");
        else
            for (var e = 0; e < a.length; e++) {
                var n = a[e];
                s("#wuforecasts").append("<div id='wuforecast'><span id='weekday'><span style='color:#777;font-size:10px;line-height:20px;'>" + 
				n.date.weekday + "  " + 
				n.date.day + "</span></span><img id='icon' src='../css/icons/" + 
				n.icon + ".png'></img><br ><div class='kmh' style='margin-left:1%;'><span style='font-size:11px;color:#777;'> " + 
				n.conditions + "</span><br><br><span style='color:#f26c4f;margin-left:17%;font-size:12px;line-height:12px;'> " + 
				n.high.celsius + "° | <span style='color:#66a1ba;font-size:12px;'> " + n.low.celsius + "° <div class='rain'> <span style='color:#777;font-size:11px;font-weight:900;margin-left:17%;'> " + 
				n.pop + "% <span style='color:#66a1ba;font-size:11px;font-weight:900;'> precip</span><div class='kmh'><span style='color:#777;font-size:11px;font-weight:900;margin-left:17%;'> " + 
				n.snow_allday.cm + " <span style='color:#66a1ba;font-size:11px;font-weight:900;'> cm <br><span style='color:#777;font-size:10px;margin-left:17%;'>" +
				n.maxwind.dir + " <span style='color:#f26c4f;font-size:11px;font-weight:400;'>" +  n.maxwind.mph + "</span> mph " )
            }
    }

    function e(s) {
        return _.reject(s, function(s) {})
    }

    function n() {
        s.ajax({
            url: "../jsondata/forecast10day.json",
            dataType: "json",
            success: function(s) {
                var n = s.forecast.simpleforecast.forecastday,
                    o = e(n);
                a(o)
            }
        })
    }
    n()
});