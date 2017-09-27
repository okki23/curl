    <?php 

    if(fsockopen("smtp.gmail.com",587)) { print "port 587 terbuka"; } else { print "port 587 tertutup"; } 

    ?>