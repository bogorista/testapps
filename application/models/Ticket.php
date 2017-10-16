<?php

class Ticket extends ActiveRecord\Model {
	static $belongs_to = array(
     array('company'),
     array('client'),
     array('user'),
     array('queue'),
     array('type'),
  );

	static $has_many = array(
    array("ticket_has_articles"),
    array("ticket_has_attachments"),
    );

    public static function newTicketCount($userId, $comp_array){
        $filter = "";
        if($comp_array != FALSE)
        {
          $comp_array = ($comp_array == "") ? 0 : $comp_array;
          $filter = "(user_id = $userId 
                    OR company_id in (".$comp_array.")) AND ";
        }

            $ticketCount = Ticket::count(
                array('conditions' => 
                  $filter."
                      status = 'New'"
                    )
            );
            return $ticketCount;

    } 


}

class TicketHasArticle extends ActiveRecord\Model {
   	
    static $belongs_to = array(
     array('ticket'),
     array(
           	'client',
            'foreign_key' => 'email',
            'primary_key' => 'from',
        ),
  );
    static $has_many = array(
      array('article_has_attachments', 'foreign_key' => 'article_id')
    );
}