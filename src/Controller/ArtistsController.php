<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class ArtistsController extends AppController
{
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Artists.created' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function index(){
        $this->set('artists', $this->paginate());
        $a = $this->Artists->find();
        $artistAlbums = $this->Artists->Albums->find();
        $artistsFavourites = $this->Artists->Favourites->find();

        $singleArtistAlbum = [];
        $singleArtistFavourites = [];

        foreach($a as $artist){

            $artistId = $artist->id;

            //Dernier album de l'artiste
            $singleArtistAlbum[$artistId] = $artistAlbums->order(['created' => 'DESC'])->where(['artist_id' => $artistId])->first();
            $artistAlbums = $this->Artists->Albums->find(); //reset

            //Calcul de popularité
            $singleArtistFavourites[$artist->artistname] = $artistsFavourites->where(['artist_id' => $artistId])->count();
            $artistsFavourites = $this->Artists->Favourites->find(); //reset

        };

        array_multisort($singleArtistFavourites);

        $top4 = array_slice($singleArtistFavourites, sizeof($singleArtistFavourites) - 4, 4);
        $top4 = array_reverse($top4);
        $top4 = array_keys($top4);
        $top4Artists = [];
        foreach($top4 as $top){
            $topArtist = $a->where(['artistname' => $top])->first();
            $top4Artists[$top] = $topArtist;
            $a = $this->Artists->find(); //reset
        }

        $challengers4 = array_slice($singleArtistFavourites, 0, 4);
        $challengers4 = array_keys($challengers4);
        $challengers4Artists = [];
        foreach($challengers4 as $challenger){
            $challengerArtist = $a->where(['artistname' => $challenger])->first();
            $challengers4Artists[$challenger] = $challengerArtist;
            $a = $this->Artists->find(); //reset
        }

        $this->set(compact('a', 'singleArtistAlbum', 'top4Artists', 'challengers4Artists'));
    }

    public function view($id){
        $artist = $this->Artists->get($id, [
            'contain' => ['Albums', 'Favourites']
        ]);

        $a = $this->Artists->Albums->newEntity();


        $artistAlbums = $this->Artists->Albums->find()->where(['artist_id' => $id])->all();
        $artistFavourites = $this->Artists->Favourites->find()->where(['artist_id' => $id]);


        $this->set(compact('artist', 'a', 'artistAlbums', 'artistFavourites'));
    }

    public function edit($id){
        $editA = $this->Artists->get($id);

        if($this->request->is(['post', 'put'])){



            $this->Artists->patchEntity($editA, $this->request->getData());
            if(!empty($editA->linkspotify)){
                $editA->linkspotify = str_replace('https://open.spotify.com/artist/', '', $editA->linkspotify);
            }
            if($this->Artists->save($editA)){


                $this->Flash->success('Modif Ok');
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Planté');
        }

        $this->set(compact('editA'));
    }

    public function add($request_id = NULL){
        //Crée une entité vide
        $new = $this->Artists->newEntity();

        //Si on arrive sur cette action en methode post
        if($this->request->is('post')){
            $new = $this->Artists->patchEntity($new, $this->request->getData());

            if(in_array($this->request->getData('picture')['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

                //recupère l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);

                //Creation du nouveau nom
                $name = 'picture-'. rand(0,999).'-'.time().'.'.$ext;

                //reconstruction du chemin global de fichier
                $address = WWW_ROOT.'/data/pictures/artists/'.$name;

                //Valeur à enregistrer dans la base
                $new->picture = $name;

                //on le déplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);

            } else {
                $this->Flash->error('Ce format de fichier n\'est pas autorisé.');
            }

            if($this->Artists->save($new)){
                $this->Flash->success('Ok');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Planté');
        } else
        //Si on arrive sur cette action depuis une acceptation de requête
        if($request_id !== NULL){
            $new->artistname = $this->request->get($request_id)->artist;
        }

        //Envoie la variable dans la vue
        $this->set(compact('new'));
    }

    public function delete($id){
        if($this->request->is(['post', 'delete'])){
            //on récupère l'élément ciblé
            $delA = $this->Artists->get($id);

            if($this->Artists->delete($delA)){
                $this->Flash->success('Supprimé');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Suppresion ratée');
                return $this->redirect(['action' => 'view', $id]);
            }
        } else {
            throw new NotFoundException('Tu te crois malin ? C\'est pas comme ça que ça marche !');
        }
    }

    public function deletePicture($id){
        //on récupère l'élément ciblé
        $delP = $this->Artists->get($id);
        unlink('../webroot/data/pictures/artists/'.$delP->picture);
        $delP->picture = null;

        if($this->Artists->save($delP)){
            $this->Flash->success('Ok');
        } else {
            $this->Flash->error('Suppresion de l\'image ratée');
        }
        return $this->redirect(['action' => 'view', $id]);
    }

    public function editPicture($id){
        $editA =  $this->Artists->get($id);
        if($this->request->is(['post', 'put'])){
            if(!empty($editA->picture) && file_exists('../webroot/data/pictures/artists/'.$editA->picture)){
                unlink('../webroot/data/pictures/artists/'.$editA->picture);
            }
            $this->Artists->patchEntity($editA, $this->request->getData());

            if(in_array($this->request->getData('picture')['type'], ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])){

                //recupère l'extension qui était utilisée
                $ext = pathinfo($this->request->getData('picture')['name'], PATHINFO_EXTENSION);

                //Creation du nouveau nom
                $name = 'picture-'. rand(0,999).'-'.time().'.'.$ext;

                //reconstruction du chemin global de fichier
                $address = WWW_ROOT.'/data/pictures/artists/'.$name;

                //Valeur à enregistrer dans la base
                $editA->picture = $name;

                //on le déplace de la mémoire temporaire vers l'emplacement souhaité
                move_uploaded_file($this->request->getData('picture')['tmp_name'], $address);

            } else {
                $this->Flash->error('Ce format de fichier n\'est pas autorisé.');
            }

            if($this->Artists->save($editA)){
                $this->Flash->success('Modif Ok');
                return $this->redirect(['action' => 'view', $id]);
            }

            $this->Flash->error('Planté');
        }
        $this->set(compact('editA'));
    }

}