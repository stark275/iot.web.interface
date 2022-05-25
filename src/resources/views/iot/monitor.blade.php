<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>IOT</title>

    <link href="{{asset('img/dist/samples/assets/styles.css')}}" rel="stylesheet" />

    <style>

        #chart {
      max-width: 850px;
      margin: 35px auto;
    }

    </style>

    <script>
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>

    var values = {!! json_encode($data->values()) !!}
    var data = [];

    values.forEach(function(item) {
        let x = new Date(item.created_at);
        let y = item.val / 100;

        data.push({
            x,
            y
        })
    })

    console.log(data);
    // debugger;
      // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
      // Based on https://gist.github.com/blixt/f17b47c62508be59987b
      var _seed = 42;
      Math.random = function() {
        _seed = _seed * 16807 % 2147483647;
        return (_seed - 1) / 2147483646;
      };
    </script>

    <script>
  var lastDate = 0;
//   var data = []
  var TICKINTERVAL = 86400000
  let XAXISRANGE = 777600000
  function getDayWiseTimeSeries(baseval, count, yrange) {
    var i = 0;
    // while (i < count) {
    //   var x = baseval;
    //   var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

    //   data.push({
    //     x, y
    //   });
    //   lastDate = baseval
    //   baseval += TICKINTERVAL;
    //   i++;
    // }

    values.forEach(function(item)  {
        let x = baseval;
        let y = parseInt((item.val / 100),10 );

        data.push({
            x,
            y
        });

        lastDate = baseval;
        baseval += TICKINTERVAL;
    })
  }

  getDayWiseTimeSeries(new Date((values[0].created_at)).getTime(), 10, {
    min: 10,
    max: 90
  })

  function getNewSeries(baseval, yrange) {
    var newDate = baseval + TICKINTERVAL;
    lastDate = newDate

    for(var i = 0; i< data.length - 10; i++) {
      // IMPORTANT
      // we reset the x and y of the data which is out of drawing area
      // to prevent memory leaks
      data[i].x = newDate - XAXISRANGE - TICKINTERVAL
      data[i].y = 0
    }

    data.push({
      x: newDate,
      y: Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
    })
  }

  function resetData(){
    // Alternatively, you can also reset the data at certain intervals to prevent creating a huge series
    data = data.slice(data.length - 10, data.length);
  }
  </script>
  </head>

  <body>
     <div id="chart"></div>

    <script>

        var options = {
          series: [{
          data: data.slice()
        }],
          chart: {
          id: 'realtime',
          height: 350,
          type: 'line',
          animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
              speed: 100
            }
          },
          toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Examen d\'IOT: Niveaux de fumée',
          align: 'center'
        },
        markers: {
          size: 0
        },
        xaxis: {
          type: 'datetime',
          range: XAXISRANGE,
        },
        yaxis: {
          max: 100
        },
        legend: {
          show: false
        },
        annotations: {
        yaxis: [
            {
            y: 70,
            borderColor: 'red',
            label: {
                style: {
                color: 'red',
                },
                text: 'Nivieau Dangereux'
            }
            }
        ]
    }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        window.setInterval(function () {
        getNewSeries(lastDate, {
          min: 10,
          max: 90
        })

        chart.updateSeries([{
          data: data
        }])
      }, 1000)

    </script>


  </body>
</html>