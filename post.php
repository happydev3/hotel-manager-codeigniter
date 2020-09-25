<?php
# Copy .htaccess.frb file to replace the one on the server
echo shell_exec('cp ./tpl/.htaccess.frb ./.htaccess');
echo shell_exec('cp ./tpl/.htaccess.supplier.frb ./supplier/.htaccess');
echo shell_exec('cp ./tpl/.htaccess.admin.frb ./admin/.htaccess');