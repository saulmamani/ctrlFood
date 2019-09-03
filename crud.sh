php artisan infyom:scaffold User --fromTable --tableName=users --skip=migration,model,tests
php artisan infyom:scaffold Product --fromTable --tableName=products --skip=migration,tests
php artisan infyom:scaffold Client --fromTable --tableName=clients --skip=migration,tests