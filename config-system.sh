#Configurando permissões e grupos
sudo usermod -a -G www-data vscode
sudo usermod -a -G vscode www-data
sudo chmod -R g+w ./
sudo chmod -R g+w /etc/apache2/sites-available/
sudo chown -R www-data:www-data -R /etc/apache2/sites-available/

#Substituição de dados para configuração do Apache
sed 's+WORKSPACE_PATH+'$PWD'+g' ./.devcontainer/apache-site.conf > /etc/apache2/sites-available/000-default.conf
