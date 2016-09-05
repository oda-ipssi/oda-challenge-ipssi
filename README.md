# Laravel oda-challenge-ipssi

- **1** make sure composer, git are installed on your machine
- **2** fork the project
- **3** follow git workflow instruction
- **4** cd to project folder, run in terminal:
    * `composer install`
- **5** make sure at the root folder of the project the `.env` exist, if not rename the file `.env.example` into **.env**
- **6** cd to project folder, run in terminal:
    * `php artisan key:generate`
    * `php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"`
- **7** then run in terminal:
    * `php artisan serve` and go to http://localhost:8000/
- **8** To install the database and everything to get the last version of the projet
    * POSTGRES install :
      *  sudo apt-get update
      *  sudo apt-get install postgresql
      *  sudo apt-get install phppgadmin

      *  sudo su postgres
      *  psql

      *  CREATE USER asYouWish WITH PASSWORD 'asYouWish';
      * ALTER USER asYouWish WITH SUPERUSER;
    * `php artisan migrate:install`
    * `php artisan migrate`
    * `php artisan db:seed`
    
*If everything is ok you'll see LARAVEL 5 title main page*


## GIT WORKFLOW (fork versionning and pull request implementation):

**Notice: we use clone method as https, not into ssh, thanks :)**

- Add the **Upstream** to your remote :
    * `git remote add upstream https://github.com/oda-ipssi/oda-challenge-ipssi.git`

- To check if it works:
    * `git remote -v`, *the output have to be :*

  ```
  $ git remote -v
  origin    https://github.com/YOUR_USERNAME/YOUR_FORK.git (fetch)
  origin    https://github.com/YOUR_USERNAME/YOUR_FORK.git (push)
  upstream  https://github.com/oda-ipssi/oda-challenge-ipssi.git (fetch)
  upstream  https://github.com/oda-ipssi/oda-challenge-ipssi.git (push)
  ```

**Warning: your master branch is always the mirror of upstream, so you have to dev on another branch, the PULL REQUEST work flow force to review code by the other on your master**

- Create a new branch always via master *(be on master, not the upstream)* :
    * `git checkout -b <feature-name>`

- Add the modifs file :
    * `git add -A`

- Commit :
    * `git commit -m "<your message>"`

- Combination of add and commit *(only if files already exist)* :
    * `git commit -am "<your message>"`

- Save on your master the branch after adding and commit file :
    * `git push origin <your-actual-feature-name>`

- Make a pull request via github interface and click on **create pull-request** BUTTON !

- Some One have to merge the pull-request *(not you it's dirty, ok ?)* !

- When the pull request has been merged delete the branch (if you have no need to keep her)
    * `git branch -d <feature-name>` (delete the branch on local, autocompletion ok in local) && `git push origin --delete <feature-name>` (delete the branch on git server, no autocompletion for git server)

- Update your own fork *(always when you are on your master branch)* :
    * `git pull upstream master` & `git push origin master`

- Merge a branch if she exists with the current master is up to date *(place your git version on the branch you would like to merge master)* :
    * `git merge master`

##Credit Card Numbers for test payments

**Warning: The CCV number can be anything (better to use 123) but the expiracy date has to be in the future otherwise the payment will fail.**

 - 4970100000000000 : Paiement accepté avec authentification 3D Secure
 - 4970100000000007 : Paiement accepté, garantie de paiement = NO
 - 4970100000000003 : Paiement accepté, marchand non enrôlé 3D Secure
 - 4970100000000001 : Paiement accepté, acheteur non enrôlé 3D Secure
 - 4970100000000097 : Paiement refusé pour cause d'authentification 3D Secure échouée, l'acheteur n'est pas parvenu à s'authentifier
 - 4970100000000098 : Paiement refusé, autorisation refusée pour cause de plafond dépassé
 - 4970100000000099 : Paiement refusé, autorisation refusée suite à erreur dans le cryptogramme visuel saisi
