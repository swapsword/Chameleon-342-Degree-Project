var enable1 = false;
var enable2 = true;
var enable3 = true;
function load21() {
    if(enable1){
        $("#d26").load('/includes/dm1.php');
        enable1 = false;
        enable2 = true;
        enable3 = true;
    }
}
function load22(){
    if(enable2){
        $("#d26").load('/includes/dm2.php');
        enable1 = true;
        enable2 = false;
        enable3 = true;
    }
}
function load23(){
    if(enable3){
        $("#d26").load('/includes/dm3.php');
        enable1 = true;
        enable2 = true;
        enable3 = false;
    }
}
$(document).ready(function() {
    // pop up for hint input field cisco id
    $('.i1')
        .popup({
            on: 'hover',
            inline: true,
            position : 'top left',
            content : 'Hint:-Type Cisco id of Delivery Manager'
        });

    // label changing class according to values for Average Volume label
    var avg_dm = $("#d27").text();
    var avg_dm = parseInt(avg_dm.replace(/[^0-9\.]/g, ''));
    var avg_dm_total = $("#d28").text();
    var avg_dm_total = parseInt(avg_dm_total.replace(/[^0-9\.]/g, ''));
    if( avg_dm <= (avg_dm_total/2) ){
        $("#l25").addClass("red");
    }else if((avg_dm > (avg_dm_total/2)) && (avg_dm <= avg_dm_total) ){
        $("#l25").addClass("yellow");
    }else if(avg_dm > avg_dm_total){
        $("#l25").addClass("green");
    }

    // label changing class according to values for Average sum label
    var sum_dm = $("#d29").text();
    var sum_dm = parseInt(sum_dm.replace(/[^0-9\.]/g, ''));
    var sum_dm_total = $("#d30").text();
    var sum_dm_total = parseInt(sum_dm_total.replace(/[^0-9\.]/g, ''));
    if( sum_dm <= (sum_dm_total/20) ){
        $("#l27").addClass("red");
    }else if(sum_dm > (sum_dm_total/20) && sum_dm <= (sum_dm_total/10) ){
        $("#l27").addClass("yellow");
    }else if(sum_dm > (sum_dm_total/10)){
        $("#l27").addClass("green");
    }

    // label changing class according to values for average percentage
    var avg_per = $("#d31").text();
    var avg_per = parseInt(avg_per.replace(/[^0-9\.]/g, ''));
    if( avg_per <= 50 ){
        $("#l29").addClass("red");
    }else if(avg_per > 50 && avg_per <= 100 ){
        $("#l29").addClass("yellow");
    }else if(avg_per > 100){
        $("#l29").addClass("green");
    }

    // label changing class according to values for sum percentage
    var sum_per = $("#d33").text();
    var sum_per = parseInt(sum_per.replace(/[^0-9\.]/g, ''));
    if( sum_per <= 5 ){
        $("#l31").addClass("red");
    }else if(sum_per > 5 && sum_per <= 10 ){
        $("#l31").addClass("yellow");
    }else if(sum_per > 10){
        $("#l31").addClass("green");
    }

    // hiding the labels for delivery manager
    var value = $("#bb1").text();
    if(value) {
        $("#l25,#l26,#l27,#l28,#l29,#l30,#l31,#l32").hide();
    }

});

semantic = {};
// ready event
semantic.ready = function() {
    // selector cache
    var
        $buttons = $('.ui.buttons .button'),
        $toggle  = $('.main .ui.toggle.button'),
        $button  = $('.ui.button').not($buttons).not($toggle),
    // alias
        handler = {
            activate: function() {
                $(this)
                    .addClass('active')
                    .siblings()
                    .removeClass('active');
            }
        };
    $buttons.on('click', handler.activate);
};
// attach ready event
$(document).ready(semantic.ready);

