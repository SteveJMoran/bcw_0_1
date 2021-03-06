
var app = {};

app.init = function(cityId, timeline) {
    path = 'data/'+ cityId + '/' + timeline+'.json';   
    app.loadJSON(function(response) {
        // Parse JSON string into object
        var actual_JSON = JSON.parse(response);
        return actual_JSON;
    }, path);
   
}

app.loadJSON = function(callback, path) {   

    var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
    xobj.open('GET', path, true); // Replace 'my_data' with the path to your file
    xobj.onreadystatechange = function () {
          if (xobj.readyState == 4 && xobj.status == "200") {
            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
            callback(xobj.responseText);
          }
    };
    xobj.send(null);  
}

app.print = function(cityId, timeline) {
    var data = app.init(cityId,timeline);
    var container = document.getElementById('forecasts');
    console.log(data);
}


console.log(app.init('6160739','daily'))


