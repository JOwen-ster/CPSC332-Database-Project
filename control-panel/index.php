<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg+xml" href="/vite.svg">
  <title>Control Panel</title>
  <link rel="stylesheet" href="control.css">
</head>
<body>
    <main class="main-content">
      <section class="card form-card">
        <div class="card-header">
          <h2>Update Event</h2>
          <p class="subtitle">Fill in the fields you want to update</p>
        </div>
        
        <form id="event-form" method="post" action="update_event.php">
          <div class="form-group required">
            <label for="event_id">Event ID</label>
            <input 
              type="number" 
              name="event_id" 
              id="event_id" 
              required
              placeholder="Enter event ID"
              class="form-control">
            <span class="form-hint">Required field</span>
          </div>

          <div class="form-group">
            <label for="title">Title</label>
            <input 
              type="text" 
              name="title" 
              id="title" 
              placeholder="Enter event title"
              class="form-control">
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea 
              name="description" 
              id="description" 
              placeholder="Enter event description"
              class="form-control textarea"></textarea>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="start_datetime">Start Date & Time</label>
              <input 
                type="datetime-local" 
                name="start_datetime" 
                id="start_datetime" 
                class="form-control datetime">
              <span class="form-hint">Format: YYYY-MM-DD HH:MM</span>
            </div>

            <div class="form-group">
              <label for="end_datetime">End Date & Time</label>
              <input 
                type="datetime-local" 
                name="end_datetime" 
                id="end_datetime" 
                class="form-control datetime">
              <span class="form-hint">Format: YYYY-MM-DD HH:MM</span>
            </div>
          </div>

          <div class="form-group">
            <label for="location">Location</label>
            <input 
              type="text" 
              name="location" 
              id="location" 
              placeholder="Enter event location"
              class="form-control">
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Event</button>
          </div>
        </form>
      </section>


      <section class="card form-card">
        <div class="card-header">
          <h2>Create An Event</h2>
          <p class="subtitle">Fill in the fields you want to update</p>
        </div>
        
        <form id="event-form" method="post" action="create_event.php">

          <div class="form-group">
            <label for="title">Title</label>
            <input 
              type="text" 
              name="title" 
              id="title" 
              placeholder="Enter event title"
              class="form-control">
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea 
              name="description" 
              id="description" 
              placeholder="Enter event description"
              class="form-control textarea"></textarea>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="start_datetime">Start Date & Time</label>
              <input 
                type="datetime-local" 
                name="start_datetime" 
                id="start_datetime" 
                class="form-control datetime">
              <span class="form-hint">Format: YYYY-MM-DD HH:MM</span>
            </div>

            <div class="form-group">
              <label for="end_datetime">End Date & Time</label>
              <input 
                type="datetime-local" 
                name="end_datetime" 
                id="end_datetime" 
                class="form-control datetime">
              <span class="form-hint">Format: YYYY-MM-DD HH:MM</span>
            </div>
          </div>

          <div class="form-group">
            <label for="location">Location</label>
            <input 
              type="text" 
              name="location" 
              id="location" 
              placeholder="Enter event location"
              class="form-control">
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Event</button>
          </div>
        </form>
      </section>

      <form action="generate_ticket.php" method="POST">
        <label for="ticket_id">Join An Event:</label>
        <input class="form-control" placeholder="Enter event id" type="number" name="event_id" id="event_id" required>
        <button class="btn btn-primary" type="submit">Join Event</button>
      </form>
      <form action="delete_event.php" method="POST">
        <label for="ticket_id">Delete Your Event:</label>
        <input class="form-control" placeholder="Enter event id" type="number" name="event_id" id="event_id" required>
        <button class="btn btn-primary" type="submit">Delete Event</button>
      </form>
      <form action="delete_ticket.php" method="POST">
        <label for="ticket_id">Discard Ticket:</label>
        <input class="form-control" placeholder="Enter ticket id" type="number" name="ticket_id" id="ticket_id" required>
        <button class="btn btn-primary" type="submit">Remove Ticket</button>
      </form>
      <a class="backlink" href="../dashboard">Back to Dashboard</a>

      <div id="message" class="message success">
        <span class="message-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        </span>
        <span class="message-text"></span>

        <button class="message-close" aria-label="Close message">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </main>
<script>
  const params = new URLSearchParams(window.location.search);
  const status = params.get("status");

  if (status) {
    const message = document.getElementById("message");
    const messageText = message.querySelector(".message-text");
    messageText.textContent = decodeURIComponent(status);
    message.classList.add("visible");

    setTimeout(() => {
      message.classList.remove("visible");
      message.remove();
    }, 5000);

    document.querySelector(".message-close").addEventListener("click", () => {
      message.classList.remove("visible");
      message.remove();
    });
  }
</script>


</body>
</html>