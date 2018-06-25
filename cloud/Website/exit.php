    <!doctype html>  
    <html>  
    <head>  
    <meta charset="UTF-8">  
    </head>  
    <body>  
    <?php  
    session_start ();//kill session  
    session_destroy ();  
    ?>  
    <script type="text/javascript">  
        window.location.href="index.html";  
    </script>  
    </body>  
    </html>  