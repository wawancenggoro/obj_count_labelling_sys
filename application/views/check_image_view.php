<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){ 

    var username = '<?php echo $user0 ?>';
    
    <?php if(isset($dots2)){foreach ($dots2 as $dot) {?>
        x_coordinate = Math.round(<?php echo $dot->x;?>*2.5);
        y_coordinate = Math.round(<?php echo $dot->y;?>*2.5);
        x_coordinate = x_coordinate+document.getElementById("img-container").offsetLeft+1;
        y_coordinate = y_coordinate+document.getElementById("img-container").offsetTop+1;

        $("#img-container").append(            
            $('<div class="marker-user2"></div>').css({
                position: 'absolute',
                top: (y_coordinate-7) + 'px',
                left: (x_coordinate-7) + 'px',
                width: '13px',
                height: '13px',
                background: '#00AA00',
                opacity: 1,
                borderRadius: "50%",
                cursor: 'crosshair'
            }).attr('x', <?php echo $dot->x;?>).attr('y', <?php echo $dot->y;?>)
        );     
    <?php }} ?>    

    <?php foreach ($dots1 as $dot) {?>
        x_coordinate = Math.round(<?php echo $dot->x;?>*2.5);
        y_coordinate = Math.round(<?php echo $dot->y;?>*2.5);
        x_coordinate = x_coordinate+document.getElementById("img-container").offsetLeft+1;
        y_coordinate = y_coordinate+document.getElementById("img-container").offsetTop+1;

        $("#img-container").append(            
            $('<div class="marker-user1"></div>').css({
                position: 'absolute',
                top: (y_coordinate-7) + 'px',
                left: (x_coordinate-7) + 'px',
                width: '13px',
                height: '13px',
                background: '#0000FF',
                opacity: 1,
                borderRadius: "50%",
                cursor: 'crosshair'
            }).attr('x', <?php echo $dot->x;?>).attr('y', <?php echo $dot->y;?>)
        );     
    <?php } ?> 

    <?php foreach ($dots0 as $dot) {?>
        x_coordinate = Math.round(<?php echo $dot->x;?>*2.5);
        y_coordinate = Math.round(<?php echo $dot->y;?>*2.5);
        x_coordinate = x_coordinate+document.getElementById("img-container").offsetLeft+1;
        y_coordinate = y_coordinate+document.getElementById("img-container").offsetTop+1;

        $("#img-container").append(            
            $('<div class="marker-user0"></div>').css({
                position: 'absolute',
                top: (y_coordinate-7) + 'px',
                left: (x_coordinate-7) + 'px',
                width: '13px',
                height: '13px',
                background: '#FF0000',
                opacity: 1,
                borderRadius: "50%",
                cursor: 'crosshair'
            }).attr('x', <?php echo $dot->x;?>).attr('y', <?php echo $dot->y;?>)
        );     
    <?php } ?>   

    $('#chk_user0').change(function() {
        if(this.checked) {
            var elements = document.getElementsByClassName('marker-user0');

            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = 'block';
            }
        } else {
            var elements = document.getElementsByClassName('marker-user0');

            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }       
        }
    });

    $('#chk_user1').change(function() {
        if(this.checked) {
            var elements = document.getElementsByClassName('marker-user1');

            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = 'block';
            }
        } else {
            var elements = document.getElementsByClassName('marker-user1');

            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }       
        }
    });

    $('#chk_user2').change(function() {
        if(this.checked) {
            var elements = document.getElementsByClassName('marker-user2');

            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = 'block';
            }
        } else {
            var elements = document.getElementsByClassName('marker-user2');

            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = 'none';
            }       
        }
    });
});
<?php
    $image_name = $image_info[0]->image_name;

    if(isset($user2)){
        $image_path = '../../../../../../images/'.$image_name;
    } else {
        $image_path = '../../../../../images/'.$image_name;        
    }
?>
</script>
</head>

<body>

<div style='width: 590px; height:20px; margin-bottom: 10px; background-color: lightblue; text-align: center;'></div>
<div style='float: left; width: 20px; height:560px; margin-right: 10px; background-color: lightblue; text-align: center; vertical-align: center; writing-mode: vertical-lr; text-orientation: upright;'></div>

<div id='img-container' style='float:left;width:560px;height:560px;'>
    <img src="<?php echo $image_path;?>" width="560" height="560">
</div>
<table>
    <tr >
        <td colspan="4">LEGENDS</td>       
    </tr> 
    <tr>
        <td>
            <div style="width: 13px; height: 13px; background: rgb(255, 0, 0) none repeat scroll 0% 0%; border-radius: 50%; cursor: crosshair;"></div>
        </td><td>username</td><td>:</td><td><span id='username'><?php echo $user0;?></span></td>   
        <td><input type="checkbox" id="chk_user0" value="Car" checked> Show</td>    
    </tr>  
    <tr>               
        <td>
            <div style="width: 13px; height: 13px; background: rgb(0, 0, 255) none repeat scroll 0% 0%; border-radius: 50%; cursor: crosshair;"></div>
        </td><td>other user 1</td><td>:</td><td><span id='username'><?php echo $user1;?></span></td>    
        <td><input type="checkbox" id="chk_user1" value="Car" checked> Show</td>       
    </tr> 
    <?php if(isset($dots2)){?>
    <tr>                
        <td>
            <div style="width: 13px; height: 13px; background: rgb(0, 170, 0) none repeat scroll 0% 0%; border-radius: 50%; cursor: crosshair;"></div>
        </td><td>other user 2</td><td>:</td><td><span id='username'><?php echo $user2;?></span></td>    
        <td><input type="checkbox" id="chk_user2" value="Car" checked> Show</td>            
    </tr>  
    <?php } ?>      
</table>
<br/>
<br/>
<table>
    <tr >
        <td colspan="3">IMAGE INFO</td>       
    </tr> 
    <tr>
        <td>image_id: <span id='image_id'><?php echo $image_info[0]->image_id;?></span></td>
    <tr>
    </tr>  
        <td>image_name: <?php echo $image_info[0]->image_name;?></td>  
    </tr>        
</table>
</body>


</html>