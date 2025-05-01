# CPSC332-Database-Project

USERS (maybe add profile icon using links to images)
* Every user has an id, username, password, datetime 
* Every user can create multiple events
* Every user can delete their own events (every attendee has that event deleted from their list)
* Every user can update their own events (title, description, date, time, location, max_members)
* Every user can remove users from an event they created
* Every user can signup to multiple events
* Every user can create a ticket for an event
* Every user can view tickets they created and for their own events
* Every user can close tickets they created and for their own eventts


EVENTS
* Every event has a id, title, description, datetime, location, creator (user), attendees (forigen key to user), max_members


TICKETS
* Every ticket has a id, subject, comment, datetime, location, creator (user), event

At the bottom of the page, their is an editor where you input the event id and parts you want to update, this way you dont need to create a dynamic page for every event, just one page that can update any event.