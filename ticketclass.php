<?php 

class Ticket {
    private $tid;
    private $title;
    private $description;
    private $category;
    private $timeCreated;
    private $status;
    private $db;


    public function __construct($db) {
        $this->db = $db;

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

    public function setTicketTimeCreated($timeCreated) {
        $this->timeCreated = $timeCreated;
      }

    public function setTicketStatus($status) {
        $this->status = $status;
      }

      public function getTicketInfo() {
        $ticketQuery = "SELECT * FROM tickets";
        $ticketArray = array();

        $ticketResult = $this->db->execute_query($ticketQuery);
        while ($row = $ticketResult->fetch_assoc()) {
            $ticketArray[] = $row;
        }
        return $ticketArray;
        
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