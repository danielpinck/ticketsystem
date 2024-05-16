<div class="container">
<div class="ticket-form">
    <h1>Neues Ticket erstellen</h1>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        
        <input type="text" id="title" name="title" placeholder="Titel" required>
        
        <textarea id="description" name="description" placeholder="Beschreibung" required rows="7"></textarea>
        
        <!-- <label for="category">Kategorie:</label> -->
        <select id="category" name="category" required>
        <option value="" disabled selected>Select a category</option>
            <option value="E-Mail">E-Mail</option>
            <option value="Windows">Windows</option>
            <option value="Hardware">Hardware</option>
            <option value="Citrix">Citrix</option>
            <option value="Software">Software</option>
        </select>
        
        <!-- <label for="priority">Priorität:</label> -->
        <select id="priority" name="priority" required>
        <option value="" disabled selected>Select a priority</option>
            <option value="niedrig">niedrig</option>
            <option value="mittel">mittel</option>
            <option value="hoch">hoch</option>
        </select>
        
        <button type="submit">Ticket erstellen</button>
    </form>
  </div>
  </div>