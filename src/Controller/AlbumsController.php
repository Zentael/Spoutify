<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class AlbumsController extends AppController
{
    public function index(){
        $a = $this->Albums->find([
            'contain' => ['Artists']
        ]);

        $this->set(compact('a'));
    }

    public function view($id){

        $a = $this->Albums->get($id);


        $this->set(compact( 'a'));
    }

    public function edit($id){
        $editA = $this->Albums->get($id);

        if($this->request->is(['post', 'put'])){
            if(file_exists('../webroot/data/pictures/albums/'.$editA->picture)){
                unlink('../webroot/data/pictures/albums/'.$editA->picture);
            }
            $this->Albums->patchEntity($editA, $this->request->getData());

            if($this->Albums->save($editA)){
                if(in_array($this->request->getData('picture')['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

                    //recupère l'extension qui était utilisée
                    $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);

                    //Creation du nouveau nom
                    $name = 'picture-'. rand(0,999).'-'.time().'.'.$ext;

                    //reconstru ction du chemin global de fichier
                    $address = WWW_ROOT.'/data/pictures/albums/'.$name;

                    //Valeur à enregistrer dans la base
                    $new->picture = $name;

                    //on le déplace de la mémoire temporaire vers l'emplacement souhaité
                    move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);

                } else {
                    $this->Flash->error('Ce format de fichier n\'est pas autorisé.');
                }
                $this->Flash->success('Modif Ok');
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Planté');
        }

        $this->set(compact('editA'));
    }

    public function add($artist_id){
        //Crée une entité vide
        $new = $this->Albums->newEntity();

        //Si on arrive sur cette action en methode post
        if($this->request->is('post')){
            $new = $this->Albums->patchEntity($new, $this->request->getData());
            $new->artist_id = $artist_id;

            if(in_array($this->request->getData('picture')['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

                //recupère l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);

                //Creation du nouveau nom
                $name = 'picture-'. rand(0,999).'-'.time().'.'.$ext;

                //reconstruction du chemin global de fichier
                $address = WWW_ROOT.'/data/pictures/albums/'.$name;

                //Valeur à enregistrer dans la base
                $new->picture = $name;

                //on le déplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);

            } else {
                $this->Flash->error('Ce format de fichier n\'est pas autorisé.');
            }

            if($this->Albums->save($new)){
                $this->Flash->success('Ok');
                return $this->redirect(['action' => 'view', $new->id]);
            }
            $this->Flash->error('Planté');
        }

        //Envoie la variable dans la vue
        $this->set(compact('new'));
    }

    public function delete($id, $artist_id){
        if($this->request->is(['post', 'delete'])){
            //on récupère l'élément ciblé
            $delA = $this->Albums->get($id);

            if($this->Albums->delete($delA)){
                $this->Flash->success('Supprimé');
                return $this->redirect(['controller' => 'artists', 'action' => 'view', $artist_id]);
            } else {
                $this->Flash->error('Suppresion ratée');
                return $this->redirect(['controller' => 'artists', 'action' => 'view', $artist_id]);
            }
        } else {
            throw new NotFoundException('Tu te crois malin ? C\'est pas comme ça que ça marche !    ');
        }
    }

    public function deletepicture($id){
        //on récupère l'élément ciblé
        $delP = $this->Albums->get($id);
        unlink('../webroot/data/pictures/albums/'.$delP->picture);
        $delP->picture = null;

        if($this->Albums->save($delP)){
            $this->Flash->success('Ok');
        } else {
            $this->Flash->error('Suppresion de l\'affihce ratée');
        }
        return $this->redirect(['action' => 'view', $id]);
    }

    public function editpicture($id){
        $editP =  $this->Albums->get($id);
        if($this->request->is(['post', 'put'])){
            if(!empty($editP->picture) && file_exists('../webroot/data/pictures/albums/'.$editP->picture)){
                unlink('../webroot/data/pictures/albums/'.$editP->picture);
            }
            $this->Albums->patchEntity($editP, $this->request->getData());

            if(in_array($this->request->getData('picture')['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

                //recupère l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);

                //Creation du nouveau nom
                $name = 'picture-'. rand(0,999).'-'.time().'.'.$ext;

                //reconstruction du chemin global de fichier
                $address = WWW_ROOT.'/data/pictures/albums/'.$name;

                //Valeur à enregistrer dans la base
                $editP->picture = $name;

                //on le déplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);

            } else {
                $this->Flash->error('Ce format de fichier n\'est pas autorisé.');
            }

            if($this->Albums->save($editP)){
                $this->Flash->success('Modif Ok');
                return $this->redirect(['action' => 'view', $id]);
            }

            $this->Flash->error('Planté');
        }
        $this->set(compact('editP'));
    }

    public function random(){
        /*$m = $this->Albums->find();
        $m = $m->toArray();
        $randomNb = rand(0, sizeof($m) - 1);
        $randomId = $m[$randomNb]->id;
        return $this->redirect(['action' => 'view', $randomId]);*/

        $query = $this->Albums->find()->order('rand()')->limit(1)->first();
        $this->redirect(['action' => 'view', $query->id]);
    }

}