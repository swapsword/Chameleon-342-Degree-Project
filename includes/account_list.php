<!DOCTYPE html>
<html>
<head>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/account_list.css">
    <!-- Custom JS for button's -->
    <script>
        var enable21 = false;
        var enable22 = true;
        function load21() {
            if(enable21){
                $("#d22").load('includes/asts14.php');
                enable21 = false;
                enable22 = true;
            }
        }
        function load22(){
            if(enable22){
                $("#d22").load('includes/asts15.php');
                enable22 = false;
                enable21 = true;
            }
        }
    </script>
</head>
<body>
<div class="ui grid">
    <!--Center of page-->
    <div id="dcenter" class="sixteen wide column">
        <div id="d21" class="ui buttons">
            <button id="b21" class="ui blue active button" onclick="load21()">FY_2014</button>
            <button id="b22" class="ui blue button" onclick="load22()">FY_2015</button>
        </div>
        <div id="d22"><?php include('asts14.php');?></div>
    </div>
</div>
</body>
</html>

