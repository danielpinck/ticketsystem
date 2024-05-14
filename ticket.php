<?php 

class Ticket {
    private $tid;
    private $title;
    private $description;
    private $category;
    private $timeCreated;
    private $status;
    private $priority;
    private $created_by;
    private $db;


    public function __construct($db) {
        $this->db = $db;
        $this->created_by = $_SESSION["user_id"];
    }

    public function setTicketId($tid) {
      $this->tid = $tid;
    }

    public function getTid() {
      return $this->tid;
    }
    
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
    
    public function getCreatedBy() {
      return $this->created_by;

    }



    public function getAllTickets($status = null, $category = null, $tid = null) {
      $ticketQuery = "SELECT * FROM users_tickets_view";
      $conditions = [];
  
      // Add conditions for statusand category if provided
      if ($status !== null) {
          $conditions[] = "status = '$status'";
      }
      if ($category !== null) {
          $conditions[] = "category = '$category'";
      }
      if ($tid !== null) {
          $conditions[] = "tid = '$tid'";
      }
  
      // Add WHERE clause if conditions are provided
      if (!empty($conditions)) {
          $ticketQuery .= " WHERE " . implode(" AND ", $conditions);
      }
  
      $ticketQuery .= " ORDER BY tid DESC";
  
      $ticketArray = array();
      $ticketResult = $this->db->execute_query($ticketQuery);
  
      if ($ticketResult) {
          while ($row = $ticketResult->fetch_assoc()) {
              $customArray[] = array(
                  "Titel" => $row["title"],
                  "Ticket ID" => $row["tid"],
                  "Beschreibung" => $row["description"],
                  "Erstellt von" => $row["username"],
                  "Kategorie" => $row["category"],
                  "Erstellt am" => $row["timestamp"],
                  "Priorität" => $row["priority"],
                  "Status" => $row["status"]
              );
          }
          return $customArray;
      } else {
          // Error handling, not implemented
          return false;
      }
  }
  

    public function getAllTicketsTemp() {
      $ticketQuery = "SELECT * FROM users_tickets_view ORDER BY tid DESC";
      $ticketArray = array();

      $ticketResult = $this->db->execute_query($ticketQuery);
      // while ($row = $ticketResult->fetch_assoc()) {
      //     $ticketArray[] = $row;
      // }
      // return $ticketArray;

      if ($ticketResult) {
        // fetch & return $ticketResult
        while ($row = $ticketResult->fetch_assoc()) {
        $customArray[] = array(
          "Titel"=> $row["title"],
          "Ticket ID"=> $row["tid"],
          "Beschreibung"=> $row["description"],
          "Erstellt von" => $row["username"],
          "Kategorie" => $row["category"],
          "Erstellt am"=> $row["timestamp"],
          "Priorität"=> $row["priority"],
          "Status"=> $row["status"]
          
        );
      }
        return $customArray;
      } else {
          // for error handling. not implemented
          return false;
      }
        
      }

      public function getSingleTicket($tid) {
        // mysql statement
        $ticketQuery = "SELECT * FROM users_tickets_view WHERE tid = ?";
    
        // execute mysql query
        $ticketResult = $this->db->execute_query($ticketQuery, [$tid]);
        
        // check if query was successful
        if ($ticketResult) {
            // fetch & return $ticketResult
            $row = $ticketResult->fetch_assoc();
            $customArray = array(
              "Titel"=> $row["title"],
              "Ticket ID"=> $row["tid"],
              "Beschreibung"=> $row["description"],
              "Erstellt von" => $row["username"],
              "Kategorie" => $row["category"],
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
          
        $sqlCreateTicket = "INSERT INTO tickets (description, category, priority, title, created_by) VALUES (?, ?, ?, ?, ?)";
    
        $createTicket = $this->db->execute_query($sqlCreateTicket, [$this->description, $this->category, $this->priority, $this->title, $this->getCreatedBy()]);
        $tid = mysqli_insert_id($this->db);
        return $tid;
        
      }

      public function createNote() {

      }

      
      public function changeStatus($tid, $status) {
        $changeStatus = "UPDATE tickets SET status = ? WHERE tid = ?";
        $createTicket = $this->db->execute_query($changeStatus, [$this->status, $this->tid]);
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