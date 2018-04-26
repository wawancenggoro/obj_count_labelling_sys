<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){ 

    var username = '<?php echo $user0 ?>';
    
    // pos_x = [146, 143]
    // pos_y = [66, 42]

    // for (i=0; i<2; i++){
    <?php foreach ($dots0 as $dot) {?>
        x_coordinate = Math.round(<?php echo $dot->x;?>*2.5);
        y_coordinate = Math.round(<?php echo $dot->y;?>*2.5);
        x_coordinate = x_coordinate+document.getElementById("img-container").offsetLeft+1;
        y_coordinate = y_coordinate+document.getElementById("img-container").offsetTop+1;

        $("#img-container").append(            
            $('<div class="marker"></div>').css({
                position: 'absolute',
                top: (y_coordinate-7) + 'px',
                left: (x_coordinate-7) + 'px',
                width: '13px',
                height: '13px',
                background: '#FF0000',
                opacity: 0.7,
                borderRadius: "50%",
                cursor: 'crosshair'
            }).attr('x', <?php echo $dot->x;?>).attr('y', <?php echo $dot->y;?>)
        );     
    <?php } ?>   

    <?php foreach ($dots1 as $dot) {?>
        x_coordinate = Math.round(<?php echo $dot->x;?>*2.5);
        y_coordinate = Math.round(<?php echo $dot->y;?>*2.5);
        x_coordinate = x_coordinate+document.getElementById("img-container").offsetLeft+1;
        y_coordinate = y_coordinate+document.getElementById("img-container").offsetTop+1;

        $("#img-container").append(            
            $('<div class="marker"></div>').css({
                position: 'absolute',
                top: (y_coordinate-7) + 'px',
                left: (x_coordinate-7) + 'px',
                width: '13px',
                height: '13px',
                background: '#0000FF',
                opacity: 0.7,
                borderRadius: "50%",
                cursor: 'crosshair'
            }).attr('x', <?php echo $dot->x;?>).attr('y', <?php echo $dot->y;?>)
        );     
    <?php } ?>    

    <?php foreach ($dots2 as $dot) {?>
        x_coordinate = Math.round(<?php echo $dot->x;?>*2.5);
        y_coordinate = Math.round(<?php echo $dot->y;?>*2.5);
        x_coordinate = x_coordinate+document.getElementById("img-container").offsetLeft+1;
        y_coordinate = y_coordinate+document.getElementById("img-container").offsetTop+1;

        $("#img-container").append(            
            $('<div class="marker"></div>').css({
                position: 'absolute',
                top: (y_coordinate-7) + 'px',
                left: (x_coordinate-7) + 'px',
                width: '13px',
                height: '13px',
                background: '#FF00FF',
                opacity: 0.7,
                borderRadius: "50%",
                cursor: 'crosshair'
            }).attr('x', <?php echo $dot->x;?>).attr('y', <?php echo $dot->y;?>)
        );     
    <?php } ?>    
    // }
});
</script>
</head>

<body>

<div style='width: 590px; height:20px; margin-bottom: 10px; background-color: lightblue; text-align: center;'>Header</div>
<div style='float: left; width: 20px; height:560px; margin-right: 10px; background-color: lightblue; text-align: center; vertical-align: center; writing-mode: vertical-lr; text-orientation: upright;'>Banner Left</div>

<?php foreach ($image_info as $image) {?>
    <div id='img-container' style='float:left;width:560px;height:560px;'>
        <img src="../../../../../../images/<?php echo $image->image_name;?>" width="560" height="560">
    </div>
    <table>
        <tr >
            <td colspan="3">LEGENDS</td>       
        </tr> 
        <tr>
            <td>
                <div style="width: 13px; height: 13px; background: rgb(255, 0, 0) none repeat scroll 0% 0%; border-radius: 50%; cursor: crosshair;"></div>
            </td><td>username</td><td>:</td><td><span id='username'><?php echo $user0;?></span></td>       
        </tr>  
        <tr>               
            <td>
                <div style="width: 13px; height: 13px; background: rgb(0, 0, 255) none repeat scroll 0% 0%; border-radius: 50%; cursor: crosshair;"></div>
            </td><td>other user 1</td><td>:</td><td><span id='username'><?php echo $user1;?></span></td>       
        </tr> 
        <tr>                
            <td>
                <div style="width: 13px; height: 13px; background: rgb(255, 0, 255) none repeat scroll 0% 0%; border-radius: 50%; cursor: crosshair;"></div>
            </td><td>other user 2</td><td>:</td><td><span id='username'><?php echo $user2;?></span></td>            
        </tr>        
    </table>
    <br/>
    <br/>
    <table>
        <tr >
            <td colspan="3">IMAGE INFO</td>       
        </tr> 
        <tr>
            <td>image_id: <span id='image_id'><?php echo $image->image_id;?></span></td>
        <tr>
        </tr>  
            <td>image_name: <?php echo $image->image_name;?></td>  
        </tr>        
    </table>
<?php } ?>
</body>


</html>