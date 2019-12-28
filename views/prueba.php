<html>
<head>
  <title>example</title>    
  <script type="text/javascript" src="../asset/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript">  
        $(document).ready( function(){            
      $("#attach").after("<input id='fakeAttach' type='button' value='attach a file' />");      
      $("#fakeAttach").click(function() {            
        $("#attach").click();        
        $("#maxSize").after("<div id='temporary'><span id='attachedFile'></span><input id='remove' type='button' value='remove' /></div>");        
        $('#attach').change(function(){
          $("#fakeAttach").attr("disabled","disabled");          
          $("#attachedFile").html($(this).val());
        });        
        $("#remove").click(function(e){
          e.preventDefault();
          $("#attach").replaceWith($("#attach").clone());
          $("#fakeAttach").attr("disabled","");
          $("#temporary").remove();
        });
      })
    }); 
  </script> 
</head>
<body>
  <input id="attach" type="file" /><span id="maxSize">(less than 1MB)</span>
</body>
</html>