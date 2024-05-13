<?php 

class Ticket {
    private $tid;
    private $title;
    private $description;
    private $category;
    private $timeCreated;
    private $status;
    private $priority;
    private $db;


    public function __construct($db) {
        $this->db = $db;
    }

    // public function setTicketId($tid) {
    //   $this->tid = $tid;
    // }
    
    public function setTicketTitle($title) {
        $this->title = $title;
      }

    public function setTicketDescription($description) {
        $this->description = $description;
      }

    public function setTicketCategory($category) {
        $this->category = $category;
      }

    public function setTicketPriority($priority) {
        $this->priority = $priority;
      }

    public function setTicketTimeCreated($timeCreated) {
        $this->timeCreated = $timeCreated;
      }

    public function setTicketStatus($status) {
        $this->status = $status;
      }

      public function getAllTickets() {
        $ticketQuery = "SELECT * FROM tickets";
        $ticketArray = array();

        $ticketResult = $this->db->execute_query($ticketQuery);
        while ($row = $ticketResult->fetch_assoc()) {
            $ticketArray[] = $row;
        }
        return $ticketArray;
        
      }

      public function getSingleTicket($tid) {
        // mysql statement
        $ticketQuery = "SELECT * FROM tickets WHERE tid = ?";
    
        // execute mysql query
        $ticketResult = $this->db->execute_query($ticketQuery, [$tid]);
        
        // check if query was successful
        if ($ticketResult) {
            // fetch & return $ticketResult
            $row = $ticketResult->fetch_assoc();
            $customArray = array(
              "Titel"=> $row["title"],
              "Beschreibung"=> $row["description"],
              "Erstellt am"=> $row["timestamp"],
              "Priorität"=> $row["priority"],
              "Status"=> $row["status"]
            );
            return $customArray;
        } else {
            // for error handling. not implemented
            return false;
        }
            
          }

      public function createTicket() {
    
        $sqlCreateTicket = "INSERT INTO tickets (description, category, priority, title) VALUES (?, ?, ?, ?)";
    
        $createTicket = $this->db->execute_query($sqlCreateTicket, [$this->description, $this->category, $this->priority, $this->title]);
        $tid = mysqli_insert_id($this->db);
        return $tid;
        
        
        // $sqlTicketUserId = "INSERT INTO ticket_support (uid, tid) VALUES (?, ?)";
    
        // $ticketUserId = $this->db->execute_query($sqlTicketUserId, [$this->description, $this->category, $this->priority, $this->title]);
        // $result = $createTicket->fetch_assoc();


        // return $result;
        
      }

    //   public function getTicketDescription($description) {
    //     $titleQuery = "SELECT 'title' FROM tickets";
    //     $titleResult = $this->db->execute_query($titleQuery, [$this->title]);
    //     return $titleResult;
    //   }

    // public function getTicketCategory($category) {
    //     $titleQuery = "SELECT 'title' FROM tickets";
    //     $titleResult = $this->db->execute_query($titleQuery, [$this->title]);
    //     return $titleResult;
    //   }

    // public function getTicketTimeCreated($timeCreated) {
    //     $titleQuery = "SELECT 'title' FROM tickets";
    //     $titleResult = $this->db->execute_query($titleQuery, [$this->title]);
    //     return $titleResult;
    //   }

    // public function getTicketStatus($status) {
    //     $titleQuery = "SELECT 'title' FROM tickets";
    //     $titleResult = $this->db->execute_query($titleQuery, [$this->title]);
    //     return $titleResult;
    //   }

}