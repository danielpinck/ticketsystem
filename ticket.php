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
    private $notiz;


    public function __construct($db) {
        $this->db = $db;
        $this->created_by = $_SESSION["user_id"];
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
    public function getTicketStatus($status) {
      return $this->created_by;
      }
    public function getCreatedBy() {
      return $this->created_by;
    }
    public function getAllTickets($status = null, $category = null, $priority = null, $tid = null, $uid = null) {
      $ticketQuery = "SELECT * FROM users_tickets_view";
      $conditions = [];
  
      // Add conditions for status and category if provided
      if ($status !== null) {
          $conditions[] = "status = '$status'";
      }
      if ($category !== null) {
          $conditions[] = "category = '$category'";
      }
      if ($priority !== null) {
          $conditions[] = "priority = '$priority'";
      }
      if ($tid !== null) {
          $conditions[] = "tid = '$tid'";
      }
      if ($uid !== null) {
          $conditions[] = "uid = '$uid'";
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
                  "Status" => $row["status"],
                  "User ID" => $row["uid"]
              );
          }
          return $customArray ?? [];
      } else {
          // Error handling, not implemented
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
              "Status"=> $row["status"],
              "User ID" => $row["uid"]
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

      public function setNotiz($notiz) {
        $this->notiz = $notiz;
        
      }

      public function getNotiz($tid) {
        $customArray = [];
        // mysql statement
        $notizQuery = "SELECT * FROM notes WHERE tid = ?";
    
        // execute mysql query
        $notizResult = $this->db->execute_query($notizQuery, [$tid]);
        
        // check if query was successful
        if ($notizResult) {
            // fetch & return $notizResult
            while ($row = $notizResult->fetch_assoc()) {
              $customArray[] = array(
                  "Ticket ID" => $row["tid"],
                  "Notiz" => $row["text"],
                  "Notiz ID" => $row["nid"],
                  "User ID" => $row["uid"]
              );
          }
            return $customArray;
        } else {
            // for error handling. not implemented
            return false;
        }
      }

      public function createNotiz($tid, $uid, $notiz) {

        $sqlCreateNotiz = "INSERT INTO notes (tid, uid, text) VALUES (?, ?, ?)";
    
        $createNotiz = $this->db->execute_query($sqlCreateNotiz, [$tid, $uid, $notiz]);
        return $createNotiz;
     
      }      
      public function changeStatus($tid, $status) {
        $changeStatus = "UPDATE tickets SET status = ? WHERE tid = ?";
        $createTicket = $this->db->execute_query($changeStatus, [$status, $tid]);
      }


}