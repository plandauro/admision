<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload de archivos con Ajax</title>
</head>
<body>
    
    <form enctype="multipart/form-data" id="formuploadajax" method="post">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        Nombre: <input type="text" name="nombre" placeholder="Escribe tu nombre">
        <br />
        <input  type="file" id="archivo1" name="archivo1"/>
        <br />
        <input type="submit" value="Subir archivos"/>
    </form>
    <div id="mensaje"></div>
    
    
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
    $(function(){
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo e(url('user/foto')); ?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	           processData: false
            })
            .done(function(res){
                console.log(res);
                $("#mensaje").html("Respuesta: " + res);
            });
        });
    });
    </script>
</body>
</html>