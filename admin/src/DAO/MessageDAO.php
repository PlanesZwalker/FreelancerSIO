<?php

namespace freelancerppe\DAO;

use Symfony\Component\Security\Core\Message\MessageInterface;
use Symfony\Component\Security\Core\Message\MessageProviderInterface;
use Symfony\Component\Security\Core\Exception\MessagenameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedMessageException;
use freelancerppe\Domain\Message;

class MessageDAO extends DAO
{
    public function findMessageByMessage($id)
    {
        $sql = "SELECT * FROM message WHERE id_message=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if($row){
            return $this->buildDomainObject($row);
        }
        else
        {
            throw new \Exception("No message matching id_message " . $id);
        }
    }

    //Ajout de la fonction findAll, pour rechercher tous les Messages
    public function findAll()
    {
        $sql = "SELECT * FROM message";
        $res = $this->getDb()->fetchAll($sql);
        $messages = array();
        foreach($res as $row)
        {
            $id_message = $row['id_message'];
            $messages[$id_message] = $this->buildDomainObject($row);
        }

        return $messages;
    }

   

    // fonction count a utiliser directement dans les autres fonctions
    public function countAll()
    {
        $sql = "SELECT * FROM message";
        $res = $this->getDb()->fetchAll($sql);

        $messages_total = array();
        foreach($res as $row)
        {
            $id_message = $row['id_message'];
            $messages_total[$id_message] = $this->buildDomainObject($row);
        }

        return count($messages_total);
    }
    
   
    
    // ENREGISTRE LE MESSAGE 
   public function saveMessage(Message $message)
    {     
        $msgInfo= array( 
            'id_message'      => $message->getId_message(), 
      
        );
        
        //on modifie
        if($message->getId_Message()){
            $this->getDb()->update('message',$msgInfo, array('id_message' => $message->getId_Message()));
        //on sauvegarde
        }else
        {
            $this->getDb()->insert('message',$msgInfo);   
            $id = $this->getDb()->lastInsertId();
            $message->setId_Message($id);
        }
      }

    
    // SUPPRIME LE MESSAGE 
    
    public function deleteMessage($id)
    {     
        $this->getDb()->delete('message', array(
            'id_message' => $id
        ));
    }
    
    // CRÉE NOTRE INSTANCE DE LA CLASSE MESSAGE
    protected function buildDomainObject($row)
    {
        $message = new Message();
        $message->setId_message($row['id_message']);
        $message->setContenu($row['contenu']);
        $message->setDate($row['date']);
        $message->setId_admin($row['id_admin']);
        $message->setId_freelancer($row['id_freelancer']);
        $message->setId_societe($row['id_societe']);
        $message->setSujet($row['sujet']);
        $message->setType($row['type']);
        return $message;
    }
}