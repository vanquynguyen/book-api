/*
	Author: Trung Quân
	Website: https://trungquandev.com/
*/
// Tech Skills
if ($('#chart-skills').length) {

    FusionCharts.ready(function () {
        var revenueChart = new FusionCharts({
            type: 'doughnut2d',
            renderAt: 'chart-skills',
            width: '100%',
            height: '100%',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "numberPrefix": "$",
                    "paletteColors": "#26B99A,#34495E,#67809F,#3498DB,#9B59B6,#90C695,#6C7A89,#bfd3b7",
                    "bgColor": "#FCFCFC",
                    "showBorder": "0",
                    "use3DLighting": "0",
                    "showShadow": "0",

                    "enableSmartLabels": "1",
                    "smartLineColor": "#16a085",
                    "smartLineThickness": "0.5",
                    "smartLineAlpha": "75",
                    "isSmartLineSlanted": "1",

                    "startingAngle": "60",
                    "showLabels": "1",
                    "showValues": "0",
                    "showPercentValues": "0",

                    "showLegend": "1",
                    "legendShadow": "1",
                    "legendBorderAlpha": "40",

                    "defaultCenterLabel": "127.0.0.1",
                    // "centerLabel": "Revenue from $label: $value",
                    "centerLabel": "$label",
                    "centerLabelBold": "1",
                    "centerLabelFontSize": "100%",
                    "centerLabelColor": "#2ecc71",

                    "showTooltip": "0",
                    "decimals": "1",

                    "toolTipColor": "#000",
                    "toolTipBorderThickness": "0",
                    "toolTipBgColor": "#2ecc71",
                    "toolTipBgAlpha": "80",
                    "toolTipBorderRadius": "20",
                    "toolTipPadding": "7",

                    "theme": "fint"
                },
                "data": [{
                    "label": "HTML-HTML5",
                    "value": "1"
                }, {
                    "label": "Wordpress",
                    "value": "1"
                }, {
                    "label": "Laravel",
                    "value": "1"
                }, {
                    "label": "PHP",
                    "value": "1"
                }, {
                    "label": "Mysql",
                    "value": "1"
                }, {
                    "label": "Javascript-Jquery-Ajax",
                    "value": "1"
                }, {
                    "label": "CSS-CSS3-Bootstrap",
                    "value": "1"
                }]
            }
        }).render();
    });

}

// // Language Skills
// var lang_canvas = document.getElementById('lang-skills');
// var context = lang_canvas.getContext('2d');

//             // Xác đinh tâm dài hơn đường line 1
//             var x = 300; //bằng điểm bắt đầu line 1 cộng độ dài line1
//             var y = 70; //chiều cao so với top, để cùng 1 số cho các đường thẳng

//             // bán kính 10px
//             var radius = 10;

//             // Góc bắt đầu là PI
//             var startAngle = 1 * Math.PI;

//             // Góc kết thúc là 4PI
//             var endAngle = 4 * Math.PI;

//             // Cùng chiều kim đồng hồ
//             var counterClockwise = false;

//             context.beginPath();
//             context.moveTo(30,70); //điểm bắt đầu line 1
//             context.lineTo(270,70); //điểm kết thúc line 1
//             context.arc(x, y, radius, startAngle, endAngle, counterClockwise);//vòng tròn ở giữa
//             context.moveTo(310,70); //điểm bắt đầu line2 bằng tọa độ x tâm đường tròn cộng với bán kính
//             context.lineTo(370,70); //điểm kết thúc line 2
//             context.lineWidth = 4;  // rộng
//             context.strokeStyle = '#2ecc71';
//             context.lineCap = 'round';
//             context.lineJoin = 'round';
//             context.stroke();
