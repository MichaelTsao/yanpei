/**
 * Created by caoxiang on 16/8/22.
 */

function chart_init(){
    var options = {
        'height': '150px',
        showLine: false,
        axisY: {
            offset: 100,
            onlyInteger: true,
            labelInterpolationFnc: function (value) {
                return date_section[value];
            }
        },
        axisX: {
            labelInterpolationFnc: function (value) {
                if (value == 0) {
                    return '时间段';
                } else {
                    return value;
                }
            }
        }
    };

    chart = new Chartist.Line('.ct-chart', null, options);
}

function chart_change(office_id) {
    var year = $('#year').val();
    var month = $('#month').val();
    $.get('/admin/office/get-time-sections/?office_id=' + office_id + '&year=' + year + '&month=' + month, function (result) {
        var obj = JSON.parse(result);
        var days = obj.days;
        var sections = obj.sections;
        var data = {
            // A labels array that can contain any sort of values
            labels: days,
            // Our series array that contains series objects or in this case series data arrays
            series: sections
        };
        chart.update(data);
    });
}
