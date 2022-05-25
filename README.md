# DOCKER FOLDER
## INSTALLATION & CONFIGURATION
`IMPORTANT` : Il est indipensable d'avoir docker et docker-compose installés sur le système

1. **Cloner le dépot distant** 
   ```bash
    git clone https://github.com/sage-otshudi-oks/cilu2.git
   ```
2. **Une fois dans le dossier du projet et selectionnez la brance du service media**
    ```bash
    git checkout dbRefactor
   ```
3. **Ensuite placez-vous dans le sous dossier** `/media.service/src`
    ```bash
    cd media.service/src
    ```  
4. ** Faites une copie du fichier `.env.exemple` puis renommer une copie en `.env`**
    

5. **Ensuite placez-vous dans le sous dossier** `/media.service`
    ```bash
    cd media.service
    ```  
6. **Construisez les images et lancez les conterneurs**
    ```bash
    sudo docker-compose up -d --build
    ``` 


7. **Installez Les dépendances laravel**
Toujours dans le dossier `/media.service`, executer la commande **composer install** adaptée à docker
    ```bash
    sudo docker-compose run --rm composer install  
    ```
8. **Tester l'installation dans le navigateur** \
<http://localhost:8080>

9. **Installez la base des données**
Toujours dans le dossier `/media.service`, executer la commande de migration de Laravel adaptée à docker
    ```bash
    sudo docker-compose run --rm artisan migrate  
    ```
10. **Préremplir la base de données avec de fausses données**

    ```bash
    sudo docker-compose run --rm artisan db:seed 
    ```
