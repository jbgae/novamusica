$(function() {

    
    var data = [ ["Enero", 10], ["Febrero", 8], ["Marzo", 4], ["Abril", 13], ["Mayo", 17], ["Junio", 9], ["Julio", 9], ["Agosto", 12], ["Septiembre",20], ["Octubre", 15], ["Noviembre", 13], ["Diciembre", 18] ];
    var data2 = [ ["Enero", 6], ["Febrero", 10], ["Marzo", 2], ["Abril", 1], ["Mayo", 10], ["Junio", 19], ["Julio", 3], ["Agosto", 8], ["Septiembre",0], ["Octubre", 1], ["Noviembre", 3], ["Diciembre", 5] ];

    $.plot("#placeholder", [ data ], {
        series: {
            bars: {
                show: true,
                barWidth: 0.9,
                align: "center"
            }
        },
        xaxis: {
            mode: "categories",
            tickLength: 0
        }
    });
    
     $.plot("#placeholder2", [ data2 ], {
        series: {
            bars: {
                show: true,
                barWidth: 0.9,
                align: "center"
            }
        },
        xaxis: {
            mode: "categories",
            tickLength: 0
        }
    });
});
