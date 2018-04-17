<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
    if ($('input[name=tools]:checked').val()=="add"){
        $("#img-container").css('cursor','crosshair');
    }
    else if ($('input[name=tools]:checked').val()=="delete"){
        $("#marked-img").css('cursor','default');
    }

    var username = '<?php echo $_SESSION['username'] ?>';
    //var username = 'admin_proxy'
    
    $("#img-container").click(function (ev) {  
        if ($('input[name=tools]:checked').val()=="add"){
            pos_x = ev.pageX-document.getElementById("img-container").offsetLeft;
            pos_y = ev.pageY-document.getElementById("img-container").offsetTop;
            pos_x = pos_x - 1
            pos_y = pos_y - 1

            x_coordinate = Math.round(pos_x/2.5);
            y_coordinate = Math.round(pos_y/2.5);

            $("#img-container").append(            
                $('<div class="marker"></div>').css({
                    position: 'absolute',
                    top: (ev.pageY-7) + 'px',
                    left: (ev.pageX-7) + 'px',
                    width: '13px',
                    height: '13px',
                    background: '#FF0000',
                    opacity: 0.5,
                    borderRadius: "50%",
                    cursor: 'crosshair'
                }).attr('x', x_coordinate).attr('y', y_coordinate)
            ); 

            $("#x-coordinate").text(x_coordinate);     
            $("#y-coordinate").text(y_coordinate); 

            $(".marker").click(function (ev) {  
                if ($('input[name=tools]:checked').val()=="delete"){
                    $(this).remove();              
                }
            });
        }        
    });

    $("#button-save").click(function (ev) { 
        $( ".marker" ).each(function() {
            $.post("http://localhost/obj_count_labelling_sys-codeigniter/index.php/marking/insert",
            {
                image_id: $("#image_id").text(),
                x: $(this).attr('x'),
                y: $(this).attr('y'),
                userin: username
            });
        });

        alert("Success");
        location.reload(); //added by wawan
    });
        
    $('input[name=tools]').click(function (ev) {  
        if ($('input[name=tools]:checked').val()=="add"){
            $("#marked-img").css('cursor','crosshair');
            $(".marker").css('cursor','crosshair');
        }
        else if ($('input[name=tools]:checked').val()=="delete"){
            $("#marked-img").css('cursor','default');
            $(".marker").css('cursor','not-allowed');
        }
    });  
});
</script>
</head>

<body>

<div style='width: 590px; height:20px; margin-bottom: 10px; background-color: lightblue; text-align: center;'>Header</div>
<div style='float: left; width: 20px; height:560px; margin-right: 10px; background-color: lightblue; text-align: center; vertical-align: center; writing-mode: vertical-lr; text-orientation: upright;'>Banner Left</div>

<!-- ==========================================================================================-->
<!-- cleaned up by wawan -->
<!-- ==========================================================================================-->
<?php foreach ($data as $va) {?>
    <div id='img-container' style='float:left;width:560px;height:560px;'>
                <img src="../../images/<?php echo $va->image_name;?>" width="560" height="560">
    </div>
    <table>
        <tr >
            <td colspan="3">IMAGE INFO</td>       
        </tr> 
        <tr>
            <td>image_id: <span id='image_id'><?php echo $va->image_id;?></span></td>
        <tr>
        </tr>  
            <td>image_name: <?php echo $va->image_name;?></td>  
        </tr>        
    </table>
<?php } ?>
<!-- ==========================================================================================-->

<div>X: <span id='x-coordinate'></span></div>
<div>Y: <span id='y-coordinate'></span></div>
<form action="">
  <input type="radio" name="tools" value="add" checked="checked"> Add New Marker
  <br/>
  <input type="radio" name="tools" value="delete"> Delete Marker
  <br/>
  <button id="button-save" type="button">Save</button> 
</form>
</body>


</html>